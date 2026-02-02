<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\Postnl\Options\StandardOption;
use App\Services\Postnl\Options\InsuredOption;
use App\Services\Postnl\Options\MailboxOption;
use App\Services\Postnl\ShippingService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            $orders = Order::with('contact')->where('order_id', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'DESC')->paginate(20);
        } else {
            $orders = Order::with('contact')->orderBy('created_at', 'DESC')->paginate(20);
        }
        return Response()->json($orders);
    }

    public function show($orderId, Request $request)
    {
        $order = Order::with('contact')->where('order_id', $orderId)->first();
        return Response()->json($order);
    }

    public function shippinglabel(Request $request, ShippingService $shipping)
    {
        $orderId = $request->input('order.order_id');
        $order = Order::with('contact')->where('order_id', $orderId)->first();
        if ($order) {
            $shipping->setStoreName('BNTK');
            $shippingOption = new StandardOption();
            $shipping->setOption($shippingOption);
            $shipping->setReceiverAddress([
                "AddressType" => "01",
                "City" => $order->contact['shipping_city'],
                "Countrycode" => $order->contact['shipping_country'],
                "HouseNr" => $order->contact['shipping_house_number'],
                "HouseNrExt" => $order->contact['shipping_house_number_extension'],
                "FirstName" => $order->contact['shipping_firstname'],
                "Name" => $order->contact['shipping_lastname'],
                "Street" => $order->contact['shipping_street_name'],
                "Zipcode" => $order->contact['shipping_postalcode'],
                "CompanyName" => $order->contact['shipping_company_name'],
                //"Department" => $order->contact['']
            ]);


            $label = $shipping->processShipping();
            $shipping->setPrinterType("GraphicFile|GIF");
            $image = $shipping->processShipping();
            dd($image);
            $outputPath2 = storage_path('/app/shipping_labels/' . $order->order_id . '_' . date('Y-m-d-His') . '.gif');
            file_put_contents($outputPath2, base64_decode($image['pdf']));

            $outputPath = storage_path('/app/shipping_labels/' . $order->order_id . '_' . date('Y-m-d-His') . '.pdf');
            file_put_contents($outputPath, base64_decode($label['pdf']));
            return Response()->json($label);
        }
    }

    public function orders()
    {
        $all_orders = DB::table('marketplaces_orders')->get();
        $order_this_month = DB::table('marketplaces_orders')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $revenue_this_month = DB::table('marketplaces_orders')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('total_amount');
        $items_sold_this_month = DB::table('marketplaces_order_items')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        // Get number of days passed so far (including today)
        $daysSoFar = Carbon::now()->day;
        // Calculate average
        $averageDailyRevenue = $daysSoFar > 0 ? ($revenue_this_month / $daysSoFar) : 0;

        $waiting_for_payment_orders = DB::table('marketplaces_orders')->where('order_group', 'waiting_payment')->get();
        $waiting_invoice_orders = DB::table('marketplaces_orders')->where('order_group', 'waiting_invoice')->get();
        $to_be_picked_orders = DB::table('marketplaces_orders')->where('order_group', 'to_be_picked')->get();
        $ready_to_packed_orders = DB::table('marketplaces_orders')->where('order_group', 'ready_to_pack')->get();

        return view('orders/index', compact(
            'all_orders',
            'order_this_month',
            'revenue_this_month',
            'averageDailyRevenue',
            'items_sold_this_month',
            'waiting_invoice_orders',
            'to_be_picked_orders',
            'ready_to_packed_orders',
            'waiting_for_payment_orders'
        ));
    }

    public function order_detail($OrderId)
    {
        $order = DB::table('marketplaces_orders')->where('marketplace_order_id', $OrderId)->get();
        // $orderItems = DB::table('marketplaces_order_items')->where('marketplace_order_id', $OrderId)->get();
        $orderItems = DB::table('marketplaces_order_items')
            ->where('marketplace_order_id', $OrderId)
            ->orderBy('condition_type', 'asc')
            ->orderBy('color_name', 'asc')
            ->get();
        return view('orders/detail', compact('order', 'orderItems'));
    }

    public function mark_as_next_status($orderId, Request $request)
    {
        if ($request->order_group == "waiting_payment") {
            $group_to_be_updated_in_db = "waiting_invoice";
        } else if ($request->order_group == "waiting_invoice") {
            $group_to_be_updated_in_db = "to_be_picked";
        } else if ($request->order_group == "to_be_picked") {
            $group_to_be_updated_in_db = "ready_to_pack";
        } else if ($request->order_group == "ready_to_pack") {
            $group_to_be_updated_in_db = "shipped";
        }

        $exists = DB::table('marketplaces_orders')->where('id', $orderId)->exists();

        if (!$exists) {
            return redirect()->back()->with('error', 'Order not found!');
        }

        DB::table('marketplaces_orders')
            ->where('id', $orderId)
            ->update([
                'order_group' => $group_to_be_updated_in_db,
                'payment_status' => 'PAID',
                'paid_at' => now(),
            ]);


        $order_detail = DB::table('marketplaces_orders')
            ->where('id', $orderId)
            ->first(); // returns single row

        // print_r($order_detail->marketplace_order_id.' / '.$group_to_be_updated_in_db);die;
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://v2.bntk.eu/webhook/order-status-changed', [
            'orderid' => $order_detail->marketplace_order_id,
            'status'  => $group_to_be_updated_in_db,
            'fullOrderData' => (array) $order_detail
        ]);

        return redirect()->back()->with('success', 'Order successfully marked as paid!');
    }

    // public function change_status(Request $request)
    // {
    //     $orderIds = $request->input('orders', []);
    //     // print_r($orderIds);die;
    //     // echo $request->status;die;
    //     if (!empty($orderIds)) {
    //         DB::table('marketplaces_orders')
    //             ->whereIn('id', $orderIds)
    //             ->update(['order_group' => $request->status]);

    //         return back()->with('success', 'Selected orders marked as picked.');
    //     }

    //     return back()->with('error', 'No orders selected.');
    // }
    public function change_status(Request $request)
    {
        $orderIds = $request->input('orders', []);
        $newStatus = $request->status;

        if (!empty($orderIds)) {

            foreach ($orderIds as $id) {
                DB::table('marketplaces_orders')
                    ->where('id', $id)
                    ->update([
                        'order_group' => $newStatus
                    ]);

                $order_detail = DB::table('marketplaces_orders')
                    ->where('id', $id)
                    ->first(); // returns single row

                // print_r($order_detail->marketplace_order_id.' / '.$group_to_be_updated_in_db);die;
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://v2.bntk.eu/webhook/order-status-changed', [
                    'orderid' => $order_detail->marketplace_order_id,
                    'status'  => $newStatus,
                    'fullOrderData' => (array) $order_detail
                ]);
            }

            return back()->with('success', 'Selected orders updated one by one.');
        }

        return back()->with('error', 'No orders selected.');
    }

    public function update_track_or_trace_code_order(Request $request)
    {
        $request->validate([
            'marketplace_order_id' => 'required|integer',
            'field' => 'required|string|in:track_code,trace_code',
            'value' => 'nullable|string',
        ]);

        $updated = DB::table('marketplaces_orders')
            ->where('marketplace_order_id', $request->marketplace_order_id)
            ->update([$request->field => $request->value]);

        return response()->json([
            'success' => true,
            'message' => 'Updated successfully!',
        ]);
    }
}
