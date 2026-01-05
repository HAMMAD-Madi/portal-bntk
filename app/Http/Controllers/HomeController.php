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
use Carbon\Carbon;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $revenue_today = DB::table('marketplaces_orders')
            ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
            ->sum('total_amount');
            
        $all_orders = DB::table('marketplaces_orders')->where('status', '!=', 'completed')->count();
        
        $revenue_this_week = DB::table('marketplaces_orders')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('total_amount');
            
        // $products_in_stock = DB::table('products')
        //     ->where('stock', '>', 0)
        //     ->count();
            $products_in_stock = DB::table('products')->sum('stock');

            
        $ready_to_ship_orders = DB::table('marketplaces_orders')->where('order_group', 'waiting_payment')->count();


        $total_orders = DB::table('marketplaces_orders')
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->count();
        $completed_orders = DB::table('marketplaces_orders')
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->where('status', 'completed')
            ->count();
        $completed_percentage = $total_orders > 0 ? ($completed_orders / $total_orders) * 100 : 0;

        $pending_payment_orders = DB::table('marketplaces_orders')
            ->where('payment_status', 'unpaid')
            ->where('status', '!=', 'cancelled')
            ->limit(10)->get();
            
        $total_inventory_Stock = DB::table('products')->count();
            
        $products_in_low_stock = DB::table('products')
            ->where('stock', '<=', 1)
            ->limit(10)->get();
        
        
        $performance = [];
        $marketplaces = [
            ['name' => 'Shopify', 'icon' => '🛍️', 'type' => 'shopify'],
            ['name' => 'Bricklink', 'icon' => '🧱', 'type' => 'bricklink'],
            ['name' => 'Bol.com', 'icon' => '📦', 'type' => 'bolcom'],
        ];
        foreach ($marketplaces as $marketplace) {
            $orders_week = DB::table('marketplaces_orders')
                ->where('marketplace_type', $marketplace['type'])
                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->count();
            $revenue_week = DB::table('marketplaces_orders')
                ->where('marketplace_type', $marketplace['type'])
                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->sum('total_amount');
            $revenue_last = DB::table('marketplaces_orders')
                ->where('marketplace_type', $marketplace['type'])
                ->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
                ->sum('total_amount');
            $growth = $revenue_last > 0
                ? (($revenue_week - $revenue_last) / $revenue_last) * 100
                : 0;
            $performance[] = [
                'marketplace' => $marketplace['name'],
                'icon' => $marketplace['icon'],
                'orders' => $orders_week,
                'revenue' => round($revenue_week, 2),
                'growth' => round($growth, 1),
            ];
        }


        $recent_orders = DB::table('marketplaces_orders')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();



        return view('home/index', compact('revenue_today', 'all_orders', 'revenue_this_week', 'products_in_stock', 'ready_to_ship_orders', 'completed_percentage',
        'pending_payment_orders', 'products_in_low_stock', 'performance', 'recent_orders', 'total_inventory_Stock'));
    }
    
}
