<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'license_number',
        'car_model',
        'payment_term',
        'ismargin',
        'items',
        'contact_id',
        'date',
    ];   

    protected $casts = [
        'items' => 'array',         
    ];
   



  

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
