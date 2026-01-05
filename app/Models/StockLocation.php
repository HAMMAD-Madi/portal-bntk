<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockLocation extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description'
    ];

    /**
     * Get the products in this location
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'location_id');
    }
}