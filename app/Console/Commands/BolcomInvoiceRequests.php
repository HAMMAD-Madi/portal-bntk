<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BolcomService; 
use App\Facades\PDF; 
use App\Models\BolcomInvoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BolcomInvoiceRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bntk:bolcom-invoice-requests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store invoice requests from Bol.com';

    /**
     * Execute the console command.
     */
    public function handle(BolcomService $bolcom)
    {

        $proxima = file_get_contents('https://web.pcman.nl/fonts/proxima.ttf');
        $proximaBold = file_get_contents('https://web.pcman.nl/fonts/proxima-bold.ttf');
        $proximaConBold = file_get_contents('https://web.pcman.nl/fonts/proxima-con-bold.ttf');
        $proximaItalic =  file_get_contents('https://web.pcman.nl/fonts/proxima-italic.ttf');

        $invoices = $bolcom->getInvoiceRequests();

        foreach ($invoices['invoiceRequests'] as $_invoice) {
            $invoice = BolcomInvoice::where('order_id', $_invoice['orderId'])->first();

            if($invoice) {
                $invoice->status = $_invoice['status'];
                $invoice->status_transitions = $_invoice['statusTransitions'];
                $invoice->save();
                continue;
            } else {
                $invoice = new BolcomInvoice;
            }

            $order = $bolcom->getOrder($_invoice['orderId']);
            
            if($order) {
                $orderDate = Carbon::parse(optional($order)['orderPlacedDateTime'] ?? now());
                $invoice->orderdata = $order;
            }

            $products = [];
            foreach ($order['orderItems'] as $orderItem) {
             $products[] = [
                'orderItemId' => $orderItem['orderItemId'],
                'unitPrice' => $orderItem['unitPrice'],
                'quantity' => $orderItem['quantity'],
                'ean' => $orderItem['product']['ean'],
                'title' => $orderItem['product']['title']

             ];
            }

            $invoice->order_id = $_invoice['orderId'];
            $invoice->status = $_invoice['status'];
            $invoice->status_transitions = $_invoice['statusTransitions'];
            $invoice->customer_account_number = $_invoice['customerAccountNumber'];
            $invoice->invoice_number = BolcomInvoice::getNextInvoiceNumber();
            $invoice->billing_details = $_invoice['billingDetails'];
            $invoice->products = $products;
            $invoice->tax = 21;
            $invoice->order_date = $orderDate;
            $invoice->request_date = new Carbon();
            $invoice->shipment_id = $_invoice['shipmentId'];
            $invoice->website_shop = 'www.bntk.eu';
            $invoice->phone_shop = '+31618304708';
            $invoice->email_shop = 'info@bntk.eu';

            $tempPath = __DIR__.'/temp.pdf';
            $pdf = PDF::view('pdf.bolcominvoice', [
                'invoice' => $invoice,
                'proximaItalic' => base64_encode($proximaItalic),
                'proximaConBold' => base64_encode($proximaConBold),
                'proximaBold' => base64_encode($proximaBold),
                'proxima' => base64_encode($proxima)
                ])
                ->showBackground()
                ->addChromiumArguments([
                    'disable-gpu', 
                    'disable-dev-shm-usage', 
                    'disable-setuid-sandbox', 
                    'no-first-run', 'no-sandbox', 
                    'no-zygote', 'deterministic-fetch', 
                    'disable-features=IsolateOrigins', 
                    'disable-site-isolation-trials'])
                ->save($tempPath);

            $customerName = $invoice->billing_details['firstName']  . '_' . $invoice->billing_details['surname'];
            $customerName = Str::of($customerName)->trim()->replaceMatches('/\s+/', '_')->lower();

            $outputPath = storage_path('/app/bolcom_invoices/factuur_' . $customerName . '_' . $invoice->order_id . '.pdf');
            
            try {
                $this->convertToPDFA($tempPath, $outputPath);
            } catch (\Exception $error) {
                echo 'Error occured when converting PDF for order: '. $_invoice['orderId'];
                unlink($tempPath);
                continue;
            }

            unlink($tempPath);
            $invoice->pdf_path = $outputPath;

            $invoice->save();
        }
    }


    public function convertToPDFA($inputPath, $outputPath)
    {
        $command = "gs -dPDFA=1 -dBATCH -dNOPAUSE -dNOOUTERSAVE -sProcessColorModel=DeviceRGB -sDEVICE=pdfwrite -sOutputFile=$outputPath -dPDFACompatibilityPolicy=1 $inputPath";
    
        exec($command, $output, $return_var);
    
        if ($return_var !== 0) {
            throw new \Exception("Error converting PDF to PDF/A format: " . implode("\n", $output));
        }
    }
}
