<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SupplierProduct;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'billing_firstname',
        'billing_affix',
        'billing_lastname',
        'billing_company_name',
        'billing_street_name',
        'billing_house_number',
        'billing_house_number_extension',
        'billing_postalcode', 
        'billing_city',
        'billing_country',
        'shipping_firstname',
        'shipping_affix',
        'shipping_lastname',
        'shipping_company_name',
        'shipping_street_name',
        'shipping_house_number',
        'shipping_house_number_extension',
        'shipping_postalcode',
        'shipping_city',
        'shipping_country',
        'reference',
        'language',
        'phone',
        'mobile',
        'email',
        'kvk',
        'vat'
    ];   

    public function getFullNameAttribute() { 
         $fullname  = $this->firstname . ' ' . $this->affix .  ' ' .  $this->lastname;
         return preg_replace('/\s+/', ' ', $fullname);

    }

    protected $appends = ['full_name'];

    protected $casts = [
        'country' => 'array',
        'shipping_country' => 'array',           
    ];

}
