<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

class ProductQuantityChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'old_stock',
        'new_stock',
        'difference',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }  

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }

    protected $appends = ['created_at_timestamp'];

    public function getCreatedAtTimestampAttribute()
    {
        return $this->created_at->timestamp * 1000;
    }

}
