<?php 
namespace App\Services\Postnl\Options;

use App\Services\Postnl\ShippingOption;

class MailboxOption extends ShippingOption {

    public $productCode = '';
    
    public function createShippingLabel() {
        if($this->country == 'NL') {
            $this->productCode  = '2928';
        } elseif($this->country = 'BE') {
            
            throw new \Exception('Mailbox package for Belgium is not supported');
            //$this->productCode  = '4960';
        } else {

        }
    }
}

