<?php 
namespace App\Services\Postnl\Options;

use App\Services\Postnl\ShippingOption;

class InsuredOption extends ShippingOption {
    // ... createShippingLabel implementation ...
    public $productCode;
    public $country;
    public $amount;

    public function setInsurrance() {
        $template = $this->baseTemplate;
        $template['Shipments'][0]['Amounts'] = [
            'AmountType' => '02',
            'Value' => $this->amount
        ];
        $this->baseTemplate = $template;
    }

    public function createShippingLabel() {
        $this->setInsurrance();
        if($this->country == 'NL') {
            $this->productCode  = '3087';
        } elseif($this->country == 'BE') {
            $this->productCode  = '4914';
        } else {

        }
    }
}