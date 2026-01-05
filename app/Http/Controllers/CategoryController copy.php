<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use \Illuminate\Database\Eloquent\ModelNotFoundException;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $id = $request->input('id');

        if($id) {
            $categories = Category::with('products')->where('id', $id)->first();
            if($categories->has('products') && count($categories->products) > 0) {
                return Response()->json($categories);  
            } 
            $categories = $categories->children;
        } else {
            $categories = Category::withDepth()->having('depth', '=', 0)->get();

        }
        return Response()->json($categories);  


    }

    public function store(Request $request) {
        
        //$categories = Category::whereIsLeaf()->get(['id', 'name']);
        return Response()->json($request->all());
    }

    public function list() {
        $categories = Category::whereIsLeaf()->get(['id', 'name']);
        return Response()->json($categories);
    }

    public function getcategories() {
        
        //$categories = Category::all();
        $categories = Category::get()->toTree();

        return Response()->json($categories);
    }
}
