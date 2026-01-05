<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\Postnl\Options\StandardOption;
use App\Services\Postnl\Options\InsuredOption;
use App\Services\Postnl\Options\MailboxOption;
use App\Services\Postnl\ShippingService;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OverviewController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::get();
        $colors = DB::table('colors')->where('bricklink_name', '!=', NULL)->get();
        $query = Product::query();
    
        // General search
        if ($request->filled('general_search')) {
            $search = $request->input('general_search');
            $query->where(function($q) use ($search) {
                $q->where('item_no', 'like', "%{$search}%")
                  ->orWhere('gtin', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('color_name', 'like', "%{$search}%")
                  ->orWhere('condition', 'like', "%{$search}%");
            });
        }
    
        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }
        
        if ($request->filled('item_type')) {
            $query->where('item_type', $request->input('item_type'));
        }
        
        if ($request->filled('location')) {
            $query->where('location_id', $request->input('location'));
        }
        
        // Color filter
        if ($request->filled('color')) {
            $query->where('color_name', $request->input('color'));
        }
    
        // Condition filter
        if ($request->filled('condition')) {
            $query->where('condition', $request->input('condition'));
        }
    
        // Stock filter (example: low, out, in-stock)
        if ($request->filled('stock')) {
            if ($request->input('stock') === 'low') {
                $query->where('stock', '<', 2);
            } elseif ($request->input('stock') === 'out') {
                $query->where('stock', '<=', 0);
            } elseif ($request->input('stock') === 'in') {
                $query->where('stock', '>', 0);
            }
        }
        
        if($request->desc_products == 1){
            $products = $query->orderBy('created_at', 'desc')->paginate(12)->appends($request->query());    
        }else{
            $products = $query->paginate(12)->appends($request->query());
        }
        
        $products_in_stock = DB::table('products')->sum('stock');
    
        // Stats
        $product_count = Product::count();
        // $product_total_value = Product::sum('price');
        $product_total_value = Product::sum(DB::raw('price * stock'));
        $product_with_low_stock = Product::where('stock', '<', 2)->count();
        $product_out_of_stock = Product::where('stock', '<=', 0)->count();
    
        $average_margin = Product::selectRaw("
            AVG(
                CASE 
                    WHEN sell_price > 0 
                    THEN ((sell_price - price) / sell_price) * 100
                    ELSE 0 
                END
            ) as avg_margin
        ")->value('avg_margin');
    
        return view('overview/index', compact(
            'products', 'categories', 'colors', 'product_count', 'product_total_value',
            'product_with_low_stock', 'product_out_of_stock', 'average_margin', 'products_in_stock'
        ));
    }

}