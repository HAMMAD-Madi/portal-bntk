<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>{{ $invoice->order_id }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style> 

        @font-face {
          font-family: 'proxima';
          font-style: normal;
          font-weight: 500;
          src: url(data:font/truetype;charset=utf-8;base64,{{$proxima}}) format('truetype');;
        }

        @font-face {
          font-family: 'proxima';
          font-style: bold;
          font-weight: 700;
          src: url(data:font/truetype;charset=utf-8;base64,{{$proximaBold}}) format('truetype');;
        }

        @font-face {
          font-family: 'proximacon';
          font-style: normal;
          font-weight: 500;
          src: url(data:font/truetype;charset=utf-8;base64,{{$proximaConBold}}) format('truetype');;
        }

        @font-face {
          font-family: 'proxima';
          font-style: italic;
          font-weight: 500;
          src: url(data:font/truetype;charset=utf-8;base64,{{$proximaItalic}}) format('truetype');;
        }
        

        * {
            font-family: 'proxima';
            font-size: 11px;
            box-sizing: border-box;
            line-height: 16px;
            word-wrap: break-all;
        }

        .wrapper {
            display: flex;
            flex-wrap: wrap;
        }
          .col-6 {
              flex: 0 0 50%;
              padding-right: 5px;
          }

          .col-3 {
              flex: 0 0 33%;
          }    

          .col-4 {
              flex: 0 0 18%;
              padding-right: 5px;
          }    
          


        .title {
            font-family: 'proxima';
            font-size: 28px;
            margin-top: 50px;
            line-height:1.4em;
        }

        .logo {
            margin-top: 55px;
            margin-left:0px;
            width: 200px;
        }

        .text-logo {
            margin-left:0px;
            font-size: 38px
        }

        .right-align {
            text-align: right
        }

        .bold {
          font-family: 'proxima';
          font-weight: bold;
        }

        .italic {
          font-family: 'proxima';
          font-style: italic;
        }

        .products {
          width: 100%;
          border: none;
          border-collapse: collapse;
          margin-top: 30px;
        }


        th {
          text-align: right;
          color: white;
          font-weight: 500;
          padding: 2px 0px 2px 0px;
        }
        th:nth-child(1) { text-align: left; }

        td {
          vertical-align: top;
          padding-left: 3px;
          padding-top: 3px;
          
          background-color: #eeeeee;
          text-align: right;

        }

        td:last-child {
          padding-right: 3px; 
        }
        th:last-child {
          padding-right: 3px; 

        }

        .desc {
          max-width: 300px;
          font-size: 10px;
          text-align: left;
        }

        .desc::first-line {
          font-weight: 700;
        }

        tr { border-top: solid 1px #dddddd; }
        tr:nth-child(1) { border: none }

        thead {
          background-color: #999999;
          border-bottom: 2px solid #dddddd;
         
        }

        .total {
          font-size: 13px;
        }
    </style>
  </head>
  <body>
    <div style="width:100%; text-align:right;">
  <!-- <img src="data:image/png;base64," /> -->
      </div>

  <div class="wrapper">
    <div class="col-6"><span  style="display: block; margin-top: 60px !important;" class="text-logo">BNTK</span></div>
    <div class="col-6 right-align title">Factuur INVB{{$invoice->invoice_number }}<br></div>
  </div>
  <div class="wrapper" style="margin-top:50px">                
    <div class="col-6">@if(isset($invoice->billing_details['company'])){{ $invoice->billing_details['company'] }}<br>@endif{{ $invoice->billing_details['firstName'] }} {{ $invoice->billing_details['surname'] }}<br>{{ $invoice->billing_details['streetName'] }} {{ $invoice->billing_details['houseNumber'] }} {{ $invoice->billing_details['houseNumberExtension'] ?? '' }}<br>{{ $invoice->billing_details['zipCode'] }} {{ $invoice->billing_details['city'] }}<br>{{ $invoice->country }}@if(!empty($invoice->billing_details['kvkNumber']))<br>@if($invoice->country == 'België') ON: @else KVK:@endif {{ $invoice->billing_details['kvkNumber'] ?? '' }} @endif @if(!empty($invoice->billing_details['vatNumber']))<br>Btw-nummer: {{ $invoice->billing_details['vatNumber'] ?? ''}} @endif</div>
    <div class="col-6 right-align">
        <span class="bold">BNTK</span><br>Beekstraat 61<br>7606CB Almelo<br>Nederland<br>Tel +31618304708
    </div>
  </div>
  <div class="wrapper" style="margin-top:30px">
    <div class="col-4"><span class="bold">Bestelnummer</span><br>{{$invoice->order_id }}</div>
    {{app()->getLocale()}}
    <!-- <div class="col-4" style="width:250px"><span class="bold">Klantnummer</span><br>{{ $invoice->customer_account_number }}</div> -->
    <div class="col-4" style="width:250px"><span class="bold">Platform</span><br>Bol.com</div>
    <div class="col-4" style="flex: 0 0 25%;margin-left: auto"><span class="bold">Datum</span><br>{!! ucfirst(Carbon\Carbon::parse($invoice->order_date)->translatedFormat('l j F Y')) !!}</div>
  </div>
  <table cellspacing="0" cellpadding="0" class="products">
    <thead>
    <tr>
       <th style="padding-left: 3px;">Omschrijving</th>
       <th>Aantal</th>
       <th>Item prijs</th>
       <th>Subtotaal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoice->products as $product)
    <tr>
        <td class="desc">{!! $product['title'] !!}</td>
        <td>{{ $product['quantity']}}x</td>
        <td>&euro;{{number_format($product['unitPrice'],  2, ',', '.')}}</td>
        <td>&euro;{{number_format($product['unitPrice'] * $product['quantity']  ,  2, ',', '.')  }}</td>
      </tr>
    @endforeach
      <tr>
        <td class="desc"><span class="bold">Verzending & Afhandeling</span><br>{{$invoice->shipping_method }}</td>
        <td>1x</td>
        <td>&euro;0,00</td>
        <td>&euro;0,00</td>
      </tr>
 
    </tbody>
  </table>
        @php
          $tax = 0;
          $total = 0;
          $subtotal = 0;
          foreach($invoice->products as $product) {
            $total += $product['unitPrice'] * $product['quantity'];
          }
          $subtotal = $total / (1 + $invoice->tax / 100);
          $tax = $total - $subtotal;
        @endphp
  <div class="wrapper" style="margin-top: 20px; justify-content:flex-end">
    <div style=" text-align: right; width: 150px;">Totaal excl. BTW<br>BTW {{ $invoice->tax }}%<br><br><span class="bold total">Totaal incl. BTW</span></div>
    <div style="text-align: right; width: 100px; padding-right: 0px;">&euro;{{ number_format($subtotal, 2, ',', '.')}}<br>&euro;{{ number_format($tax, 2, ',', '.')}}<br><br><span class="bold total">&euro;{{ number_format($total, 2, ',', '.')}}</span></div>
  
  </div>

  <div class="wrapper" style="margin-top: 60px;">
  <div class="col-3"><span class="bold">Bedrijfsgegevens</span><br>
      KvK-nummer 89273575<br>
      Geregistreerd te Almelo<br>
      Btw-nummer NL004711451B79<br>
    </div>
    <div class="col-3"><span class="bold">Betaalmethode</span><br>
      Bol.com Payments
    </div>
  </div>
  

  </body>
</html>