<?php 
namespace App\Services\Postnl;
use App\Services\Postnl\ShippingOption;
use App\Models\Shop;

class ShippingContext {
    private $shippingOption;
    private $baseTemplate;

    public function __construct() {

    }

    public function setTemplate($template) {
        $this->baseTemplate = $template;
    }

    public function setShippingOption(ShippingOption $option) {
        $this->shippingOption = $option;
        $this->shippingOption->baseTemplate = $this->baseTemplate; 
        $this->shippingOption->createShippingLabel();
    }

    public function serializeShippingOption() {
        return $this->shippingOption->serialize();
    }

    // ... Other methods ...
}