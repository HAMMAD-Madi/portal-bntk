<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory, NodeTrait;


    protected $fillable = [
        'id',
        'parent_id',
        'name',
        'order',
        'image_path',
        'image_url'
    ];   

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected $with = ['products'];

}
