<?php 
namespace App\Services\Postnl;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use App\Services\AuthTokenService;
use VerumConsilium\Browsershot\Facades\PDF;
use App\Services\Postnl\ShippingContext;
use App\Models\Shop;
use Ramsey\Uuid\Uuid;

class ShippingService{
    protected $storeName;
    protected $auth;
    protected $debug = true;
    protected $baseUrl = 'https://api-sandbox.postnl.nl/v1';
    public $shippingOption;
    public $senderAddress;
    public $receiverAddress;
    public $printerType = "GraphicFile|PDF|MergeA";
    public $contactInfo;
    private $apikey = '2a2f1c51-2407-41fa-af1c-512407b1fa42';

    public function __construct() {
        $this->shippingContext = new ShippingContext(); 

        $this->baseTemplate = [
            "Customer" => [
                "Address" => [],
                "CollectionLocation" => "100548",
                "ContactPerson" => "Senna Nijhuis",
                "CustomerCode" => "LTEX",
                "CustomerNumber" => "10905604",
            ],
            "Message" => [
                "MessageID" => (string) Uuid::uuid4(),
                "MessageTimeStamp" => date('d-m-Y H:i:s'),
                "Printertype" => $this->printerType
            ],
            "Shipments" => [
                [
                    "Addresses" => [],
                    "Contacts" => [],
                ]
            ]
        ];
    }
    public function debug() {
        $this->apikey = '2a2f1c51-2407-41fa-af1c-512407b1fa42';  
        $this->baseUrl = 'https://api-sandbox.postnl.nl/v1';
    }

    public function setPrinterType($type) {
        $this->printerType = $type;
        $this->baseTemplate['Message']['Printertype'] = $type;
    }

    public function setStoreName($storeName) {
        $this->storeName = $storeName;
        $this->setSender($storeName);
    }

    public function setOption($shippingOption) {
        $this->shippingOption = $shippingOption;
    }

    public function setSender($storeName) {
        //$shop = Shop::where('name', 'LIKE', '%'.$storeName.'%')->first();
        
        $this->baseTemplate['Customer']['Address'] = [
            "AddressType" => "02",
            "City" => "Almelo",
            "CompanyName" => 'BNTK',
            "Countrycode" => "NL",
            "HouseNr" => "61",
            "Street" => "Beekstraat",
            "Zipcode" => "7606CB"
        ];
        $this->baseTemplate['Customer']['Email'] = 'info@bntk.eu';
        $this->baseTemplate['Customer']['Name'] = 'BNTK';
        
    }


    public function setReceiverAddress($address, $contact = null) {
        $this->baseTemplate['Shipments'][0]['Addresses'][0] = $address;
        
        if($contact) {
            $this->baseTemplate['Shipments'][0]['Contacts'][] = $contact;
        }

        if ($this->shippingOption) {
            $this->shippingOption->setCountry($address['Countrycode']);
        }
    }

    
    public function processShipping() {
        // Set the shipping option based on user input or other logic
        
        $this->shippingContext->setTemplate($this->baseTemplate);
        $this->shippingContext->setShippingOption($this->shippingOption);

        // Create shipping label (or other relevant actions)
        //label = $this->shippingContext->createShippingLabel();

        // Serialize the shipping data for the HTTP request
        $serializedData = $this->shippingContext->serializeShippingOption();
        //dd($this->apikey);
        $response = $this->makeRequest('post', '/shipment?confirm=true', $serializedData);

        if($this->printerType == 'GraphicFile|GIF') {
            dd($response);
        }

        $label = [
            'barcode' => $response['MergedLabels'][0]['Barcodes'][0],
            'pdf' => $response['MergedLabels'][0]['Labels'][0]['Content']];  
        
        return $label;

        // Use Laravel HTTP Client to send the request
        //$response = Http::post('your-api-endpoint', $serializedData);

        // Handle the response...
        //return $response;
    }


    public function makeRequest($method, $uri, $data = []) {
        
        
        $response = Http::withHeaders(['apikey' => $this->apikey])->withBody(json_encode($data), 'application/json')->{$method}($this->baseUrl . $uri);


        if (!$response->successful()) {
            dd($response->body());
            // Handle errors or throw an exception
        }
        
        return $response->json();
    }

    // Additional methods for token management can be added here
    // For example, a method to refresh the token if it's expired
}