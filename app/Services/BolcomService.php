<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BolcomService {

    protected $shopName = 'BNTK';
    protected $auth;
    protected static $apiLevel = 'v10';
    protected static $baseUrl = 'https://api.bol.com/retailer';

    public function __construct(AuthTokenService $auth) {
        $this->auth = $auth;
    }

    public function getInvoiceRequests() {
        return $this->makeRequest('GET', '/shipments/invoices/requests');
    }

    public function getOrder($orderId) {
        return $this->makeRequest('GET', '/orders/' . $orderId);
    }

    public function getOrders($status) {
        return $this->makeRequest('GET', '/orders', ['status' => $status]);
    }

    public function getShipments($orderId) {
        return $this->makeRequest('GET', '/shipments', ['order-id' => $orderId]);
    }

    public function getShipment($shipmentId) {
        return $this->makeRequest('GET', '/shipments/' . $shipmentId);
    }

    public function getDeliveryOptions($orderItems) {
        return $this->makeRequest('POST', '/shipping-labels/delivery-options', ['orderItems' => $orderItems]);
    }
    public function getAssets($ean, $usage = [], $primary = true) {
        return $this->makeRequest('GET', '/products/' . $ean.'/assets', $usage);
    }

    public function getOffer($offerId) {
        return $this->makeRequest('GET', '/offers/'. $offerId);
    }

    public function makeRequest($method, $uri, $data = [], $mediaType = 'json') {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '. $this->auth->getToken($this->shopName), 
            'Content-Type' => 'application/vnd.retailer.'. self::$apiLevel.'+' . $mediaType, 
            'Accept' => 'application/vnd.retailer.'. self::$apiLevel.'+' . $mediaType])->{$method}(self::$baseUrl . $uri, $data);
        if (!$response->successful()) {
            $message = [
                'method' => $method, 
                'uri' => $uri, 
                'request data' => $data, 
                'mediaType' => $mediaType, 
                'body' => $response->body()
            ];
            Log::error($message);
        }

        if($mediaType == 'pdf') {
            return $response->body();
        } else {
            return $response->json();
        }
    }

}