<?php 
namespace App\Services\Postnl\Options;

use App\Services\Postnl\ShippingOption;

class StandardOption extends ShippingOption {

    public $productCode = '';
    
    public function createShippingLabel() {
        if($this->country == 'NL') {
            $this->productCode  = '3085';
        } elseif($this->country = 'BE') {
            $this->productCode  = '4946';
        } else {

        }
    }
}

