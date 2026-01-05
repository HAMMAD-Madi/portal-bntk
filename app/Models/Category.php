<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Product; 

class Category extends Model
{
    protected $fillable = ['title', 'image', 'image_url', 'position', 'parent_id'];

    // Relationship to children categories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Relationship to parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Relationship to products
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Recursive function to get product count including children
    public function productCount()
    {
        $count = $this->products()->count();
        foreach ($this->children as $child) {
            $count += $child->productCount(); // recursively include children's product count
        }

        return $count;
    }

    // Scope for ordering categories
    public function scopeOrdered($query)
    {
        return $query->orderBy('position', 'asc');
    }

    // Function to get nested categories with product count
    public static function getCategoriesWithProductCount()
    {
        return self::with('children')->get()->map(function ($category) {
            $category->product_count = $category->productCount();
            return $category;
        });
    }
}