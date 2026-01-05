<?php 
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BolcomService;
use App\Models\Order;
use App\Models\Contact;

use Carbon\Carbon;

class OrderBolcomSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:bolcom-sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync orders from WooCommerce';

    /**
     * Execute the console command.
     */
    public function handle(BolcomService $bol)
    {
        $orders = $bol->getOrders('OPEN');
        //dd($orders);
        foreach ($orders['orders'] as $order) {
            $_order = Order::where('order_id', $order['orderId'])->first();
            $products = [];


            // $shipment = $bol->getShipments($order['orderId']);
            // if(!$shipment) {
            //     continue;
            // } else {
            //     $shipment = $bol->getShipment(1481553109);
            //     dd($shipment);
            //     dd($shipment);
            // }
            $status = null;
            if($_order) {
                $shipment = $bol->getShipments($order['orderId']);
                if($shipment) {
                    $shipment = $bol->getShipment($shipment['shipments'][0]['shipmentId']);
                    if(isset( $shipment['transport']['transportEvents'])) {
                        $_order->transport_events = $shipment['transport']['transportEvents'];
                        $status = null;
                        if(is_array($_order->transport_events )) {
                            foreach ($_order->transport_events  as $event) {
                                if($event['eventCode'] == 'DELIVERED_AT_CUSTOMER') {
                                    $status = 'Bezorgd';
                                } else if ($event['eventCode'] == 'AT_TRANSPORTER') {
                                    $status = 'Gesorteerd';
                                } else if ($event['eventCode'] == 'INBOUND_COLLECT') {
                                    $status = 'Ontvangen door PostNL';
                                } else if ($event['eventCode'] == 'IN_TRANSIT') {
                                    $status = 'Onderweg';
                                } else if ($event['eventCode'] == 'PRE_ANNOUNCED') {
                                    $status = 'Aangemeld';
                                }
                            }
                        }
                        $order->status = $status;
                        $_order->save();
                    }
                }
                continue;
            }
            
            // if($_order) {
            //     $_order->status = $status ?? 'Open';
            //     $_order->save();
            //     continue;
            // }


            $_order = new Order();


            $orderDetail = $bol->getOrder($order['orderId']);
            $delivery_codes = [];
            $orderItemIds = [];

            foreach ($orderDetail['orderItems'] as $product) {

                $offer = $bol->getOffer($product['offer']['offerId']);
                $deliveryCode = $offer['fulfilment']['deliveryCode'];

                $delivery_codes[] = $deliveryCode;

                $assets = $bol->getAssets($offer['ean'], ['usage' => 'PRIMARY'])['assets'] ?? [];
                if(is_array($assets) && count($assets) > 0) {
                    $images = [];
                    foreach($assets[0]['variants'] as $image) {

                        $ext = pathinfo($image['url'], PATHINFO_EXTENSION);
                        $filename =  $offer['ean'] . '_'. $image['size']  .'_'. date('Y-m-d-His') .'.' . $ext;
                        $fileUrl = '/storage/product_images/'. $filename;
                        $fileLocation = storage_path(). '/app/public/product_images/' . $filename;
                        file_put_contents($fileLocation, file_get_contents($image['url']));
                        $image['filepath'] =  $fileLocation;
                        $image['fileurl'] =  $fileUrl;

                        $images[$image['size']] = $image;
                    }

                }


                $orderItemIds[] = ['orderItemId' => $product['orderItemId'], 'quantity' => $product['quantity']];

                $_product = [
                    'title' => $product['product']['title'],
                    'ean' => $product['product']['ean'],
                    'orderItemId' => $product['orderItemId'],
                    'delivery_code' => $deliveryCode,
                    'price' => $product['unitPrice'],
                    'quantity' => $product['quantity'],
                    'canceled' => $product['cancellationRequest'],
                    'images' => $images
                ];

                $products[] = $_product;
                # code...
            }


            $deliveryOptions = $bol->getDeliveryOptions($orderItemIds);
            $latestHandoverDateTime = null;
            if(isset($deliveryOptions['deliveryOptions'])) {
                foreach ($deliveryOptions['deliveryOptions'] as $deliveryOption) {
                    $latestHandoverDateTime = $deliveryOption['handoverDetails']['latestHandoverDateTime'] ?? null;
                }
            }
            if(!empty($latestHandoverDateTime)) {
                $datetime = \Carbon\Carbon::parse($latestHandoverDateTime);
                $latestHandoverDateTime = $datetime->setTimezone('UTC');
            }


            $_order->latest_handover_datetime = $latestHandoverDateTime;
            $shippingAddress = $orderDetail['shipmentDetails'];
            $billingAddress = $orderDetail['billingDetails'];

            $contact = Contact::where('email', $billingAddress['email'])->first();
            if(!$contact) {

                $contact = new Contact();
                $contact->billing_firstname = $billingAddress['firstName'] ?? '';
                $contact->billing_lastname = $billingAddress['surname'] ?? '';
                $contact->billing_street_name = $billingAddress['streetName'] ?? '';
                $contact->billing_company_name = $billingAddress['company'] ?? '';
                $contact->billing_house_number = $billingAddress['houseNumber'];
                $contact->billing_house_number_extension = trim(($billingAddress['househouseNumberExtension'] ?? '') . ' ' . ($billingAddress['extraAddressInformation'] ?? ''));  
                $contact->billing_postalcode = $billingAddress['zipCode'] ?? '';
                $contact->billing_city = $billingAddress['city'] ?? '';
                $contact->billing_country = $billingAddress['countryCode'] ?? '';
                $contact->shipping_firstname = $shippingAddress['firstName'] ?? '';
                $contact->shipping_lastname = $shippingAddress['surname'] ?? '';
                $contact->shipping_street_name = $shippingAddress['streetName'] ?? ''; 
                $contact->shipping_house_number = $shippingAddress['houseNumber'] ?? '';
                $contact->shipping_house_number_extension = trim(($billingAddress['househouseNumberExtension'] ?? '') . ' ' . ($billingAddress['extraAddressInformation'] ?? '')); 
                $contact->shipping_postalcode = $shippingAddress['zipCode'] ?? '';
                $contact->shipping_city = $shippingAddress['city'] ?? '';
                $contact->shipping_country = $shippingAddress['countryCode'] ?? '';
                $contact->phone = $shippingAddress['deliveryPhoneNumber'] ?? '';
                $contact->shipping_company_name = $shippingAddress['company'] ?? '';
                $contact->email = $billingAddress['email'] ?? '';
                $contact->language = $billingAddress['language'] ?? '';
                $contact->vat = $billingAddress['vatNumber'] ?? '';
                $contact->kvk = $billingAddress['kvkNumber'] ?? '';
                $contact->reference = $billingAddress['orderReference'] ?? '';
            } else {
                $_order->contact_id = $contact->id;
            }

            
            $contact->save();

            $_order->contact_id = $contact->id;


            $_order->order_id = $order['orderId'];
            $_order->order_date = Carbon::parse($order['orderPlacedDateTime']);
            $_order->delivery_codes = $delivery_codes;
            $_order->products = $products;
            $_order->status = $status ?? 'Open';
            $_order->site = 'Bol.com';

            $_order->save();
        }
    }

}