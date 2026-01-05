<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BolcomInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'invoice_number',
        'shop',
        'shop_id',
        'logo_shop',
        'phone_shop',
        'email_shop',
        'website_shop',
        'request_date',
        'shipment_id',
        'customer_account_number',
        'billing_details',
        'company',
        'products',
        'tax',
        'status',
        'status_transitions',
        'order_date',
        'orderdata',
        'pdf_path'
    ];
    
    protected $casts = [
        'products' => 'json',
        'billing_details' => 'json',
        'status_transitions' => 'json',
        'orderdata' => 'json',
        'order_date' => 'datetime',
        'request_date' => 'datetime',
        'company' => 'json',
        'address' => 'json'
    ];
    
    protected $appends = [
        'country'
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s'); // Customize the format as needed
    }

    public function getCountryAttribute() {
        $countries = include(app_path('Libraries/countries.php'));
        return $countries[$this->billing_details['countryCode']];
    }

    public function getStatusAttribute($value) {
        switch ($value) {
            case 'FINISHED':
                return 'Gesloten';
                break;
            case 'INVOICE_INCORRECT':
                return 'Factuur incorrect';
                break;
            case 'INVOICE_REQUESTED':
                return 'Open';
                break;
            case 'INVOICE_VIRUS_DETECTED':
                return 'Virus';
                break;
            case 'INVOICE_UPLOADED':
                return 'Geüpload';
                break;                
            default:
                return 'Open';
                break;
        }

    }

    public static function getNextInvoiceNumber()
    {
        $lastInvoice = self::lockForUpdate()->max('invoice_number');
        return $lastInvoice ? $lastInvoice + 1 : 345201; 
    }
}