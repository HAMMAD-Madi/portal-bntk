<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use VerumConsilium\Browsershot\Facades\PDF;
use Carbon\Carbon; 
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invoices = Invoice::with('contact')->orderBy('created_at', 'desc')->paginate();
        return Response()->json($invoices);  
    }

    public function show($number, Request $request)
    {
        $invoice = Invoice::with('contact')->where('number', $number)->first();
        return Response()->json($invoice);  
    }

    public function store(Request $request)
    {
        $isMargin = $request->input('ismargin') ?? false;

        $contact = $request->input('contactSelectedField.value') ?? $request->input('contactSelectedField');
        $items = $request->input('items');
        $invoice = new Invoice();
        $paymentTerm = $request->input('paymentTermField') ?? false;
        $licenseNumber = $request->input('licenseNumberField') ?? false;
        $carModel = $request->input('carModelField') ?? false;
        $invoice->license_number = $licenseNumber;
        $invoice->car_model = $carModel;

        $invoice->user_id = Auth::user()->id;
        $invoice->items = $items;
        $invoice->ismargin = $isMargin;

        if(isset($contact['id'])) {
            $invoice->contact_id = $contact['id'];

        } else {
            $invoice->contact_id = $contact;

        }
        $invoice->number = Invoice::max('number') + 1;


        $saved = $invoice->save();

        if($saved) {
            return Response()->json(['status' => 'success', 'invoice_number' => $invoice->number]);  
        } else {
            return Response()->json(['status' => 'error']);  
        }
    }


    public function update($number, Request $request)
    {
        $isMargin = $request->input('ismargin') ?? false;
        $paymentTerm = $request->input('paymentTermField') ?? false;
        $licenseNumber = $request->input('licenseNumberField') ?? false;
        $carModel = $request->input('carModelField') ?? false;

        $contactId = $request->input('contactSelectedField.value') ?? $request->input('contactSelectedField');
        if(is_array($contactId )) {
            $contactId = $contactId['id'];
        }
        $items = $request->input('items');
        $invoice = Invoice::where('number', $number)->first();
        $invoice->update([
            'contact_id' =>  $contactId,
            'items' => $items,
            'ismargin' => $isMargin,
            'payment_term' => $paymentTerm,
            'license_number' => $licenseNumber,
            'car_model' => $carModel
        ]);

        return Response()->json(['status' => 'invoice updated']);  
    }


    public function countries() {
        $countries = require_once(__DIR__.'/countries.php');
        return Response()->json($countries);
    }

    public function downloadpdf(Request $request, $number) {

        $invoice = Invoice::with('contact')->where('number', $number)->first();
        $filename = 'factuur_'. Str::slug($invoice->contact->lastname ) . '_INV' . $invoice->number . '_'. date('d-m-y-His') . '.pdf';
        
        $tax_total = 0;
        $subtotal = 0;
        $total = 0;


        // const subtotal = computed(() => {
        //     
//return fields.value.reduce((sum, item) => sum + (item.value.price - (item.value.price * (item.value.discount / 100))) * item.value.quantity, 0);
        //     });
            
        //     const tax = computed(() => {
        //     return fields.value.reduce((sum, item) => {
        //       const priceAfterDiscount = item.value.price - (item.value.price * (item.value.discount / 100));
        //       return sum + (priceAfterDiscount * item.value.quantity * (item.value.taxRate / 100));
        //     }, 0);
        //     });
            
        //     const total = computed(() => {
        //     return subtotal.value + tax.value;
            
        //     });
            


        foreach ($invoice->items as $product) {
            //$priceAfterDiscount = $product['price'] - ( $product['price'] * ($product['discount'] / 100));
            $priceAfterMargin = $product['price'] * ((($product['margin'] ?? 0) / 100) + 1);
            if(!$invoice->ismargin) {
                $tax_total += ($priceAfterMargin * $product['quantity'] * ($product['taxRate'] / 100));     
            } else {
                $tax_total = 0;
            }
            $price = $product['price'] * ((($product['margin'] ?? 0) / 100) + 1);
            $price = ($price - ($price * (($product['discount'] ?? 0) / 100 )));
            $subtotal += $price * $product['quantity'];

        }

        $total = $subtotal + $tax_total;

        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode($invoice->number, $generator::TYPE_CODE_93, 2, 20));

        $proxima = file_get_contents('https://web.saabservice.nl/fonts/proxima.ttf');
        $proximaBold = file_get_contents('https://web.saabservice.nl/fonts/proxima-bold.ttf');
        $proximaConBold = file_get_contents('https://web.saabservice.nl/fonts/proxima-con-bold.ttf');
        $proximaItalic =  file_get_contents('https://web.saabservice.nl/fonts/proxima-italic.ttf');

        PDF::loadView('pdf.invoice', [
            'invoice' => $invoice, 
            'products' => $invoice->items,
            'invoice_number' => $invoice->number,
            'payment_method' => 'Factuurbetaling',
            'subtotal' => $subtotal,
            'taxtotal' => $tax_total,
            'customerNumber' => '12345',
            'total' => $total,
            'shipping_price' => 0,
            'shipping_rate' => 21,
            'barcode' => $barcode,
            'proximaItalic' => base64_encode($proximaItalic),
            'proximaConBold' => base64_encode($proximaConBold),
            'proximaBold' => base64_encode($proximaBold),
            'proxima' => base64_encode($proxima)])
        ->setNodeBinary('/opt/plesk/node/20/bin/node')
        ->setNpmBinary('/opt/plesk/node/20/bin/npm') 
        ->waitUntilNetworkIdle()
        ->showBackground()
        ->addChromiumArguments(['disable-gpu', 'disable-dev-shm-usage', 'disable-setuid-sandbox', 'no-first-run', 'no-sandbox', 'no-zygote', 'deterministic-fetch', 'disable-features=IsolateOrigins', 'disable-site-isolation-trials'])
        ->format('A4')
        ->margins(3, 15, 5, 15)
        ->storeAs('pdf_invoices/', $filename);

        $invoice->pdf_file = storage_path() . '/app/pdf_invoices/'.$filename;
        $invoice->save();

        $pdf = file_get_contents($invoice->pdf_file);
        return Response()->json(['pdf' => base64_encode($pdf)]);
    }

    public function delete($id)
    {
        $invoice = Invoice::find($id);
        if($invoice) {
            $invoice->delete();
            return Response()->json(['status' => 'deleted']);  
        } else {
            return Response()->json(['status' => 'failed']);  
        }
    }
}
