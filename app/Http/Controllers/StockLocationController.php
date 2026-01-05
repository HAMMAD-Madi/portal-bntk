<?php

namespace App\Http\Controllers;

use App\Models\StockLocation;
use Illuminate\Http\Request;

class StockLocationController extends Controller
{
    public function index()
    {
        return response()->json(StockLocation::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:stock_locations',
            'description' => 'nullable|string'
        ]);

        $location = StockLocation::create($request->all());
        return response()->json($location, 201);
    }

    public function update(Request $request, $id)
    {
        $location = StockLocation::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:stock_locations,code,' . $id,
            'description' => 'nullable|string'
        ]);

        $location->update($request->all());
        return response()->json($location);
    }

    public function destroy($id)
    {
        $location = StockLocation::findOrFail($id);
        $location->delete();
        return response()->json(null, 204);
    }
}