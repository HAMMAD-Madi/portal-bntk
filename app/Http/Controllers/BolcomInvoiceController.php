<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use VerumConsilium\Browsershot\Facades\PDF;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;
use App\Models\BolcomInvoice;

use Symfony\Component\HttpFoundation\Response;

class BolcomInvoiceController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {


        return Response()->json(BolcomInvoice::orderByRaw(
                "CASE 
                    WHEN status = 'INVOICE_REQUESTED' THEN 1
                    WHEN status = 'INVOICE_VIRUS_DETECTED' THEN 2
                    WHEN status = 'INVOICE_INCORRECT' THEN 3
                    WHEN status = 'INVOICE_UPLOADED' THEN 4
                    WHEN status = 'FINISHED' THEN 5
                    ELSE 6
                END"
            )->orderBy('request_date', 'DESC')->get());
        
        

    }

    public function bntkIndex(Request $request)
    {
        return Response()->json(BolcomInvoice::with('shop')->whereHas('shop', function ($query)  {
            $query->where('name', 'BNTK');
        })->orderByRaw(
            "CASE 
                WHEN status = 'INVOICE_REQUESTED' THEN 1
                WHEN status = 'INVOICE_VIRUS_DETECTED' THEN 2
                WHEN status = 'INVOICE_INCORRECT' THEN 3
                WHEN status = 'INVOICE_UPLOADED' THEN 4
                WHEN status = 'FINISHED' THEN 5
                ELSE 6
            END"
        )->orderBy('request_date', 'DESC')->paginate());
    

    }


    public function show($id, Request $request)
    {
        return Response()->json(BolcomInvoice::where('order_id', $id)->first());
    }

    public function submit($id, Request $request)
    {
        $invoice = BolcomInvoice::with('shop')->where('bolcom_order_id', $id)->first();

        if(!isset($invoice->shop->name)) {
            return Response()->json(['status' => 'failed'], 400);
        }
        $filename = 'bolcom-factuur-' . $invoice->bolcom_order_id . '-'. $invoice->created_at->format('Y-m-d') . '.pdf';
        $pdf = $this->generatePDF($invoice);


        $response = Http::withHeaders(
            [
                'Authorization' => 'Bearer ' . $this->getBolcomToken($invoice->shop->name, $invoice->shop->token), 
                'Accept' => 'application/vnd.retailer.v10+json',
            ])->attach(
                'invoice', // Name of the form field
                $pdf, // Content of the file
                $filename // Name of the file
            )->post('https://api.bol.com/retailer/shipments/invoices/' . $invoice->shipment_id);

        if($response->successful()) {
            $invoice->status = 'FINISHED';
            $invoice->save();
            return Response(['status' => 'success']);
        }
        //dd($response->body());

        return Response(['status' => 'failed']);
    }

    public function download($id, Request $request)
    {
        $invoice = BolcomInvoice::where('order_id', $id)->first();
        $pdf = base64_encode(file_get_contents($invoice->pdf_path));
        return Response()->json(['pdf' => $pdf]);

    }

    public function createpdf($id, Request $request) {
        $manual = $request->input('manual') ?? false;
        if($manual) {
   

            $response = Http::withHeaders(
                [
                    'Authorization' => 'Bearer ' . $this->getBolcomToken($shop->name, $shop->token), 
                    'Accept' => 'application/vnd.retailer.v10+json',
                ])
                ->get('https://api.bol.com/retailer/orders/' . $id);
            if(!$response->successful()) {
                $order = null;
                $orderDate = null;
                if($response->status() == 404) {
                    return Response()->json(['status' => 'Bestelling niet gevonden'], 404);
                } else {
                    return Response()->json(['status' => 'Onbekend probleem'], 400);
                }

            } else {
                $order = $response->json() ?? null;
                $orderDate = Carbon::parse($order['orderPlacedDateTime'] ?? date('c'));
            }



            $products = [];
            foreach ($order['orderItems'] as $orderItem) {
                $product['description'] = $orderItem['product']['title'];
                $product['quantity'] = $orderItem['quantity'];
                $product['unitPrice'] = $orderItem['unitPrice'];

                $products[] = $product; 
            }


            if(!isset($order['billingDetails'] )) {
                $order['billingDetails'] = $order['shipmentDetails'];

            } 

            if($request->has('company_name') && !empty($request->input('company_name'))) {
                $order['billingDetails']['company'] = $request->input('company_name');
            }

            if($request->has('company_btw') && !empty($request->input('company_btw'))) {
                $order['billingDetails']['vatNumber'] = $request->input('company_btw');
            }
            
            if($request->has('company_kvk') && !empty($request->input('company_kvk'))) {
                $order['billingDetails']['kvkNumber'] = $request->input('company_kvk');
            }



            $bolInvoice = BolcomInvoice::updateOrCreate(
            [
                'bolcom_order_id' => $order['orderId']
            ], 
            [
                'bolcom_order_id' => $order['orderId'],
                'invoice_number' => BolcomInvoice::getNextInvoiceNumber(),
                'tax' => (int) $shop->tax,
                'shipment_id' => '',
                'shop_id' => $shop->id,
                'customer_account_number' => '',
                'billing_details' => $order['billingDetails'],
                'products' => $products,
                'status' => '',
                'status_transitions' => [],
                'order_date' => $orderDate,
                'orderdata' => $order,
            ]);
            $bolInvoice->load('shop');

            $pdf = $this->generatePDF($bolInvoice);
            return Response()->json(['pdf' => base64_encode($pdf)]);
        }
        
        
        $invoice = BolcomInvoice::with('shop')->where('bolcom_order_id', $id)->first();
        if(!$invoice) {
            return;
        }
        $pdf = $this->generatePDF($invoice);
        return Response()->json(['pdf' => base64_encode($pdf)]);

    }

    private function generatePDF($invoice) {
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode($invoice->invoice_number, $generator::TYPE_CODE_93, 2, 20));

        $proxima = file_get_contents('https://web.pcman.nl/fonts/proxima.ttf');
        $proximaBold = file_get_contents('https://web.pcman.nl/fonts/proxima-bold.ttf');
        $proximaConBold = file_get_contents('https://web.pcman.nl/fonts/proxima-con-bold.ttf');
        $proximaItalic =  file_get_contents('https://web.pcman.nl/fonts/proxima-italic.ttf');
        $pdf = PDF::loadView('pdf_bolcom_invoice', [
            'invoice' => $invoice, 
            'barcode' => $barcode,
            'proximaItalic' => base64_encode($proximaItalic),
            'proximaConBold' => base64_encode($proximaConBold),
            'proximaBold' => base64_encode($proximaBold),
            'proxima' => base64_encode($proxima)])
        ->setNodeBinary('/opt/plesk/node/16/bin/node')
        ->setNpmBinary('/opt/plesk/node/16/bin/npm') 
        ->waitUntilNetworkIdle()
        ->showBackground()
        ->addChromiumArguments(['disable-gpu', 'disable-dev-shm-usage', 'disable-setuid-sandbox', 'no-first-run', 'no-sandbox', 'no-zygote', 'deterministic-fetch', 'disable-features=IsolateOrigins', 'disable-site-isolation-trials'])
        ->format('A4')
        ->margins(3, 15, 5, 15)->inline(); 

        $inputPath = __DIR__.'/temp-bolcom-invoice.pdf';
        $outputPath = __DIR__.'/temp-bolcom-invoice-finished.pdf';

        file_put_contents($inputPath, $pdf);
        $logFile = __DIR__.'/logfile_bolcom_invoice_pdf.log';

        //$command = "gs -dPDFA=1 -dBATCH -dNOPAUSE -dNOOUTERSAVE -sProcessColorModel=DeviceRGB -sDEVICE=pdfwrite -sOutputFile=$outputPath -dPDFACompatibilityPolicy=1 $inputPath";
        $command = "gs -dPDFA=1 -dPDFACompatibilityPolicy=1 -dBATCH -dNOPAUSE -dNOOUTERSAVE -sProcessColorModel=DeviceRGB -sDEVICE=pdfwrite -sOutputFile=$outputPath $inputPath > $logFile 2>&1";

        exec($command, $output, $return_var);

        $pdf = file_get_contents($outputPath);

        unlink($inputPath);
        unlink($outputPath);
        
        return $pdf;
    }

}
