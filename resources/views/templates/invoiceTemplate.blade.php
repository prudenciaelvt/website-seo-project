<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 15px 25px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .logo {
            max-height: 40px;
        }
        .invoice-to {
            margin-top: 3px;
            font-size: 12px;
        }
        .invoice-title {
            font-size: 22px;
            font-weight: bold;
            color: #0072BC; /* sesuai warna di template */
        }
        .invoice-details {
            font-size: 11px;
            margin-top: 5px;
            line-height: 1.4;
        }
        hr {
            border: none;
            border-top: 1px solid #999;
            margin: 8px 0;
        }
        .contact-info {
            font-size: 11px;
            line-height: 1.5;
        }
        .contact-info td {
            vertical-align: top;
        }
        table.products {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table.products th {
            background: #0072BC;
            color: white;
            font-size: 11px;
            font-weight: bold;
            padding: 5px;
            text-align: left;
            border: 1px solid #ccc;
        }
        table.products td {
            font-size: 11px;
            padding: 5px;
            border: 1px solid #ccc;
        }
        .bottom-section {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            display: flex;
        }
        .terms {
            font-size: 11px;
            max-width: 60%;
        }
        .totals {
            border-collapse: collapse;
            font-size: 11px;
            min-width: 180px;
        }
        .totals td {
            border: 1px solid #ccc;
            padding: 5px;
        }
        .totals .total-row {
            background: #0072BC;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="header">
        <div>
            @if($logo)
                <img src="{{ $logo }}" alt="Logo" style="height: 60px;">
            @endif

            <div class="invoice-to">Invoice To:<br>{!! nl2br(e($client)) !!}</div>
        </div>
        <div style="text-align: right;">
            <div class="invoice-title">INVOICE</div>
            <div class="invoice-details">
                Invoice No: {{ $invoice_no }}<br>
                Invoice Date: {{ $invoice_date }}
            </div>
        </div>
    </div>

    <hr>

    <table class="contact-info" style="width:100%; margin-top:3px;">
        <tr>
            <td>📞 +62 851-5545-9633</td>
            <td>🌐 https://imersa.co.id/</td>
        </tr>
        <tr>
            <td>✉️ mail@imersa.co.id</td>
            <td>🏠 Jl. Puntodewo No. 2 Baron, Nganjuk, Jawa Timur 64394</td>
        </tr>
        <tr>
            <td>🏦 BCA 8465460594 an Rias Solikha</td>
            <td></td>
        </tr>
    </table>

    <table class="products">
        <thead>
            <tr>
                <th style="width:55%;">Product/Service</th>
                <th style="width:15%;">Qty</th>
                <th style="width:15%;">Unit Price</th>
                <th style="width:15%;">Line Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paket as $p)
            <tr>
                <td>{{ $p['nama'] }}</td>
                <td>{{ $p['qty'] }}</td>
                <td>{{ number_format($p['unit_price'],0,',','.') }}</td>
                <td>{{ number_format($p['line_total'],0,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="bottom-section">
        <div class="terms">
            <b>TERM AND CONDITIONS</b><br>
            Please send payment within 10 days of receiving this invoice.<br><br>
            THANK YOU FOR YOUR BUSINESS
        </div>
        <table class="totals">
            <tr>
                <td>Sub-total</td>
                <td>{{ number_format($subtotal,0,',','.') }}</td>
            </tr>
            <tr>
                <td>Sales Tax</td>
                <td>0</td>
            </tr>
            <tr class="total-row">
                <td>Total</td>
                <td>{{ number_format($total,0,',','.') }}</td>
            </tr>
        </table>
    </div>

</div>
</body>
</html>
