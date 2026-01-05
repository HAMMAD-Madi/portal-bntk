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
use Illuminate\Support\Facades\Log;

class ShippingController extends Controller
{

    public function index(Request $request)
    {
        if($request->has('search')) {
            $search = $request->input('search');
            $orders = Order::with('contact')->where('order_id', 'LIKE', '%'. $search . '%' )->orderBy('created_at', 'DESC')->paginate(20);

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

    public function shippinglabel(Request $request, ShippingService $shipping) {
        $orderId = $request->input('order.order_id');
        $order = Order::with('contact')->where('order_id', $orderId)->first();
        if($order) {
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
            $outputPath2 = storage_path('/app/shipping_labels/'. $order->order_id . '_'. date('Y-m-d-His') .'.gif' );
            file_put_contents($outputPath2, base64_decode($image['pdf']));

            $outputPath = storage_path('/app/shipping_labels/'. $order->order_id . '_'. date('Y-m-d-His') .'.pdf' );
            file_put_contents($outputPath, base64_decode($label['pdf']));
            return Response()->json($label);

        }


    }
    
    public function shippings(){
        $all_orders = DB::table('marketplaces_orders')->get();
        $order_this_month = DB::table('marketplaces_orders')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $revenue_this_month = DB::table('marketplaces_orders')->whereBetween('created_at', [Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->sum('total_amount');
        $items_sold_this_month = DB::table('marketplaces_order_items')->whereBetween('created_at', [Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->count();
        // Get number of days passed so far (including today)
        $daysSoFar = Carbon::now()->day;
        // Calculate average
        $averageDailyRevenue = $daysSoFar > 0 ? ($revenue_this_month / $daysSoFar) : 0;
        
        $waiting_invoice_orders = DB::table('marketplaces_orders')->where('order_group', 'waiting_invoice')->get();
        $to_be_picked_orders = DB::table('marketplaces_orders')->where('order_group', 'to_be_picked')->get();
        $ready_to_packed_orders = DB::table('marketplaces_orders')->where('order_group', 'ready_to_pack')->get();
        
        $packed_orders = DB::table('marketplaces_orders')->where('order_group', 'waiting_payment')->get();
        $shipped_orders = DB::table('marketplaces_orders')->where('order_group', 'shipped')->get();
        $completed_orders = DB::table('marketplaces_orders')->where('order_group', 'completed')->get();
        
        $pending_returns = DB::table('marketplaces_returns')->where('return_status', 'requested')->count();
        $approved_returns = DB::table('marketplaces_returns')->where('return_status', 'approved')->count();
        $rejected_returns = DB::table('marketplaces_returns')->where('return_status', 'rejected')->count();
        $processed_returns_this_month = DB::table('marketplaces_returns')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
            
        $top_return_reasons = DB::table('marketplaces_returns')
            ->select('return_reason', DB::raw('COUNT(*) as total'))
            ->groupBy('return_reason')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
        
        // Calculate total for percentage
        $total_returns = $top_return_reasons->sum('total');
        // Add percentage to each item
        $top_return_reasons = $top_return_reasons->map(function($item) use ($total_returns) {
            $item->percentage = $total_returns > 0 
                ? round(($item->total / $total_returns) * 100, 2) 
                : 0;
            return $item;
        });

        
        $return_orders = DB::table('marketplaces_returns')
            ->leftJoin(
                'marketplaces_orders',
                'marketplaces_orders.marketplace_order_id',
                '=',
                'marketplaces_returns.marketplace_order_id'
            )
            ->select(
                'marketplaces_returns.*',
                'marketplaces_orders.customer_name',
                'marketplaces_orders.total_amount',
                'marketplaces_orders.subtotal'
            )->where('return_status', '=', 'requested')->get();

        
        return view('shipping/index', compact(
            'all_orders', 'order_this_month', 'revenue_this_month', 'averageDailyRevenue', 'items_sold_this_month',
            'waiting_invoice_orders', 'to_be_picked_orders', 'ready_to_packed_orders', 'packed_orders', 'shipped_orders', 'completed_orders', 'return_orders',
            'pending_returns', 'approved_returns', 'rejected_returns', 'processed_returns_this_month', 'top_return_reasons'
        ));
    }
    
    public function shipping_detail($OrderId){
        $order = DB::table('marketplaces_orders')->where('marketplace_order_id', $OrderId)->first();
        // $orderItems = DB::table('marketplaces_order_items')->where('marketplace_order_id', $OrderId)->get();
        $orderItems = DB::table('marketplaces_order_items')
            ->where('marketplace_order_id', $OrderId)
            ->orderBy('condition_type', 'asc')
            ->orderBy('color_name', 'asc')
            ->get();
        return view('shipping/detail', compact('order', 'orderItems'));
    }
        
    public function mark_as_next_status($orderId, Request $request){
        if($request->order_group == "waiting_payment"){
            $group_to_be_updated_in_db = "waiting_invoice";
        }else if($request->order_group == "waiting_invoice"){
            $group_to_be_updated_in_db = "to_be_picked";
        }else if($request->order_group == "to_be_picked"){
            $group_to_be_updated_in_db = "ready_to_pack";
        }else if($request->order_group == "ready_to_pack"){
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
        ])->post('https://n8n.bntk.eu/webhook/order-status-changed', [
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
                ])->post('https://n8n.bntk.eu/webhook/order-status-changed', [
                    'orderid' => $order_detail->marketplace_order_id,
                    'status'  => $newStatus,
                    'fullOrderData' => (array) $order_detail
                ]);
            }
    
            return back()->with('success', 'Selected orders updated one by one.');
        }
    
        return back()->with('error', 'No orders selected.');
    }

    public function approveReturn(Request $request){
        // echo $request->return_id;die;
        DB::table('marketplaces_returns')
            ->where('id', $request->return_id)
            ->update([
                'return_status' => 'approved',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            
        return true;
    }
    
    public function rejectReturn(Request $request){
        // echo $request->return_id;die;
        DB::table('marketplaces_returns')
            ->where('id', $request->return_id)
            ->update([
                'return_status' => 'rejected',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            
        return true;
            
    }
    
   public function get_shipping_options(Request $request)
    {
        try {
            $payload = [
                'order_id'          => $request->order_id,
                'order_number'      => $request->order_number,
                'weight'            => $request->weight,
                'postcode'          => $request->postcode,
                'country'           => $request->country,
                'address'           => $request->address,
                'city'              => $request->city,
                'name'              => $request->name,
            ];
        
            $response = Http::timeout(30)->post(
                'https://n8n.bntk.eu/webhook/sendcloud-shipping-options',
                $payload
            );
        
            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json()
                ], 200);
            }
        
            return response()->json([
                'success' => false,
                'status' => $response->status(),
                'body' => $response->body()
            ], $response->status());
        
        } catch (\Exception $e) {
            Log::error('Shipping Options Error', [
                'error' => $e->getMessage()
            ]);
        
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }

    }
    
    public function create_shipping_label(Request $request){
        try {
            $payload = [
                'order_id'          => $request->order_id,
                'marketplace_order_id'      => $request->marketplace_order_id,
                'marketplace_type'            => $request->marketplace_type,
                'customer_name'            => $request->customer_name,
                'customer_email'            => $request->customer_email,
                'address_line_1'            => $request->address_line_1,
                'address_line_2'            => $request->address_line_2,
                'city'              => $request->city,
                'postal_code'          => $request->postal_code,
                'country_code'           => $request->country_code,
                'weight'           => $request->weight,
                'shipping_method_id'              => $request->shipping_method_id,
                'carrier'              => $request->carrier,
            ];
        
            $response = Http::timeout(30)->post(
                'https://n8n.bntk.eu/webhook/create-shipping-label',
                $payload
            );
        
            if ($response->successful()) {
                
                $labelPrinterUrl = $response->json()['data']['parcel']['label']['label_printer'];
                $pdf_url = route('download-sendcloud-pdf', encrypt($labelPrinterUrl));
                // download_sendcloud_pdf($pdf_url);
                
                return response()->json([
                    'success' => true,
                    'pdf_url' => $pdf_url,
                    'data' => $response->json()
                ], 200);
            }
        
            return response()->json([
                'success' => false,
                'status' => $response->status(),
                'body' => $response->body()
            ], $response->status());
        
        } catch (\Exception $e) {
            Log::error('Shipping Options Error', [
                'error' => $e->getMessage()
            ]);
        
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
public function download_sendcloud_pdf($encryptedUrl)
{
    $apiKey    = '15bf2650-5129-4307-aec2-4975b37a307e';
    $apiSecret = '7b834d40f14e46c4bf5571f7b3fc6dfe';

    // $url = 'https://panel.sendcloud.sc/api/v2/labels/label_printer/594736326';
    $url = decrypt($encryptedUrl);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERPWD        => $apiKey . ":" . $apiSecret, // ✅ BOTH
        CURLOPT_HTTPAUTH       => CURLAUTH_BASIC,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HEADER         => true,
    ]);

    $response   = curl_exec($ch);
    $httpCode   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    curl_close($ch);

    $headers = substr($response, 0, $headerSize);
    $body    = substr($response, $headerSize);

    if ($httpCode !== 200 || !str_contains($headers, 'application/pdf')) {
        return response()->json([
            'error' => 'Sendcloud did not return a PDF',
            'status_code' => $httpCode,
            'response' => substr($body, 0, 500)
        ], 500);
    }

    return response($body, 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="shipping-label.pdf"');
}



}
