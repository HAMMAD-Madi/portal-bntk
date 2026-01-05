<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingPackage extends Model
{
    protected $fillable = [
        'package_id',
        'status',
        'notes'
    ];

    public function items()
    {
        return $this->hasMany(ShippingPackageItem::class);
    }
}
