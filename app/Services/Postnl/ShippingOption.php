<?php 
namespace App\Services\Postnl;

abstract class ShippingOption {
    protected $address;
    public $country;
    public $baseTemplate;
    public function setAddress($address) {
        $this->address = $address;
    }

    public function createShippingLabel() {
        // Default implementation, can be overridden
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function serialize() {
        $baseTemplate = $this->baseTemplate;
        $baseTemplate['Shipments'][0]['ProductCodeDelivery'] = $this->productCode;
        return $baseTemplate;
    }
}