<?php

namespace App\Http\Controllers;

use App\Models\ShippingPackage;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShippingPackageController extends Controller
{
    public function index(Request $request)
    {
        $query = ShippingPackage::with(['items.product']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        return response()->json($query->paginate($request->per_page ?? 15));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.gtin' => 'required|exists:products,gtin',
            'items.*.quantity' => 'required|integer|min:1',
            // 'items.*.condition' => 'required|in:new,used',
            'notes' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            $package = ShippingPackage::create([
                'package_id' => 'PKG-' . uniqid(),
                'status' => 'pending',
                'notes' => $request->notes
            ]);

            foreach ($request->items as $item) {
                // Check if enough stock is available
                $product = Product::where('gtin', $item['gtin'])->first();
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Insufficient stock for product {$product->title}");
                }

                // Reduce main inventory stock
                $product->decrement('stock', $item['quantity']);

                // Add item to package
                $package->items()->create([
                    'gtin' => $item['gtin'],
                    'quantity' => $item['quantity'],
                    // 'condition' => $item['condition']
                ]);
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Package created successfully',
                'data' => $package->load('items.product')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,ready,shipped'
        ]);

        $package = ShippingPackage::findOrFail($id);
        $package->status = $request->status;
        $package->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'data' => $package
        ]);
    }

    public function returnToInventory(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $package = ShippingPackage::findOrFail($id);
            
            foreach ($package->items as $item) {
                // Return quantity to main inventory
                Product::where('gtin', $item->gtin)
                      ->increment('stock', $item->quantity);
            }

            // Delete the package
            $package->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Items returned to inventory'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
