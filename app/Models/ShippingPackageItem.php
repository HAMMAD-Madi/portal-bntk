<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingPackageItem extends Model
{
    protected $fillable = [
        'shipping_package_id',
        'gtin',
        'quantity',
        'condition'
    ];

    public function package()
    {
        return $this->belongsTo(ShippingPackage::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'gtin', 'gtin');
    }
}
