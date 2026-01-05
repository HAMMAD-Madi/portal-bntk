<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

class CategoryController extends Controller
{
    // Fetch categories with their product counts
    public function index()
    {
        $categories = Category::whereNull('parent_id')->orderBy('position')->get()->map(function ($category) {
            $category->product_count = $category->productCount();
            return $category;
        });

        return response()->json($categories);
    }

    // Fetch a single category along with its children, including product counts for all
    public function show($id)
    {
        $category = Category::with(['children', 'products'])->findOrFail($id);
        // Calculate product counts for the category and its children recursively
        $this->addProductCounts($category);
        
        return response()->json($category->toArray());
    }

    // Helper function to recursively calculate product counts for a category and its children
    private function addProductCounts($category)
    {
        $category->product_count = $category->productCount(); // Calculate product count for this category

        // Recursively calculate for all children
        foreach ($category->children as $child) {
            $this->addProductCounts($child);
        }
    }

    public function list() {
        return Response()->json(Category::all());
    }

    public function listchildren() {
        $categories = Category::all();

        return Response()->json($categories);
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|string', // assuming image is stored as a string (e.g., URL or file path)
            'image_url' => 'nullable|string', // assuming image is stored as a string (e.g., URL or file path)
            'position' => 'nullable|integer',
            //'parent_id' => 'nullable|exists:categories,id', // Ensure parent_id is valid if provided
        ]);

        // Create the category using the validated data
        $category = Category::create([
            'title' => $validated['title'],
            'image' => $validated['image'] ?? null,
            'image_url' => $validated['image_url'] ?? null,
            'position' => $validated['position'] ?? 0, // default to 0 if not provided
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        return response()->json([
            'message' => 'Category created successfully',
            'category' => $category
        ], 201); // return a 201 status code for successful creation
    }


    public function create() {
        
    }
}
