<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'order_date',
        'shipping_labels',
        'contact_id',
        'products',
        'site',
        'transport_events',
        'latest_handover_datetime',
        'delivery_codes',
    ];   

    protected $casts = [
        'products' => 'array',
        'shipping_labels' => 'array',
        'order_date' => 'datetime',
        'latest_handover_datetime' => 'datetime',
        'delivery_codes' => 'array'
    ];
   
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
