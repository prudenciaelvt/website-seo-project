<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        @page {
            size: A5;
            margin: 10mm; /* Margin lebih kecil, seimbang */
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        /* === CONTAINER UTAMA === */
        .container {
            width: 90%; /* Biar lebih ke tengah */
            max-width: 128mm; /* A5 lebar: 148mm - margin */
            margin: 0 auto; /* Tengah horizontal */
            padding: 10px 15px;
            box-sizing: border-box;
        }

        /* === HEADER === */
        .layout-header {
            margin-bottom: 15px;
            margin-top: 10px;
        }

        .layout-header table {
            width: 100%;
        }

        .layout-header td {
            vertical-align: middle;
        }

        /* === CONTACT INFO === */
        .contact-info {
            line-height: 1.5;
            width: 100%;
            border-collapse: collapse;
        }

        .contact-info td {
            vertical-align: middle;
            padding: 2px 10px 2px 0;
        }

        .contact-info img {
            height: 16px;
            vertical-align: middle;
            margin-right: 6px;
            display: inline-block;
            filter: brightness(0) saturate(100%) invert(34%) sepia(89%) saturate(1736%) hue-rotate(182deg) brightness(95%) contrast(93%);
        }

        .contact-info span {
            display: inline-block;
            vertical-align: middle;
            font-size: 11px;
        }

        /* === PRODUK TABLE === */
        table.products {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: fixed;
        }

        table.products th {
            background: #0072BC;
            color: white;
            font-weight: bold;
            padding: 4px;
            text-align: left;
            border: 1px solid #ccc;
        }

        table.products td {
            padding: 4px;
            border: 1px solid #ccc;
            word-wrap: break-word;
            font-size: 11px;
        }

        /* === TOTAL SECTION === */
        .bottom-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            margin-top: 15px;
        }

        .terms {
            flex: 1;
            max-width: 60%;
            line-height: 1.4;
            font-size: 11px;
        }

        .totals-wrapper {
            flex: none;
        }

        .totals {
            border-collapse: collapse;
            width: auto;
            font-size: 11px;
        }

        .totals td {
            border: 1px solid #ccc;
            padding: 4px 8px;
            text-align: right;
        }

        .totals td:first-child {
            text-align: left;
        }

        .totals .total-row {
            background: #0072BC;
            color: white;
            font-weight: bold;
        }

        /* === FOOTER === */
        .footer-strip {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            margin-top: 20px;
        }

        .footer-strip img {
            display: block;
        }

        .footer-strip span {
            font-size: 11px;
            font-family: Arial, sans-serif;
            line-height: 1;
        }

        /* === LINE SEPARATOR === */
        hr {
            border: none;
            border-top: 2px solid #0072BC;
            margin: 6px 0;
        }

        /* === PRINT MEDIA === */
        @media print {
            body {
                width: 148mm;
                height: 210mm;
            }
        }
    </style>
</head>
<body>
<div class="container">

    <!-- HEADER STRIP -->
    <div style="text-align:right;">
        <img src="{{ public_path('assets/picture/pic_headerTop.png') }}" alt="Header Top" style="width:70%; height: 20px;">
    </div>

    <!-- LOGO & TITLE -->
    <div class="layout-header">
        <table>
            <tr>
                <td>
                    @if($logo)
                        <img src="{{ $logo }}" alt="Logo" style="height:35px;">
                    @endif
                </td>
                <td style="text-align:right;">
                    <span style="font-size:24px; font-weight:bold; color:#0072BC;">INVOICE</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- CLIENT & INVOICE DETAILS -->
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 5px;">
        <div class="invoice-to">
            Invoice To:<br>{!! nl2br(e($client)) !!}
        </div>
        <div class="invoice-details" style="text-align: right;">
            No Invoice: {{ $invoice_no }}<br>
            Invoice Date: {{ $invoice_date }}
        </div>
    </div>

    <hr>

    <!-- CONTACT INFO -->
    <table class="contact-info">
        <tr>
            <td><img src="{{ public_path('assets/picture/pic_logoTelp.png') }}"> <span>+62 851-5545-9633</span></td>
            <td><img src="{{ public_path('assets/picture/pic_logoInternet.png') }}"> <span>https://imersa.co.id/</span></td>
        </tr>
        <tr>
            <td><img src="{{ public_path('assets/picture/pic_logoEmail.png') }}"> <span>mail@imersa.co.id</span></td>
            <td><img src="{{ public_path('assets/picture/pic_logoKartu.png') }}"> <span>BCA 8465460594 an Rias Solikha</span></td>
        </tr>
        <tr>
            <td colspan="2"><img src="{{ public_path('assets/picture/pic_logoAlamat.png') }}"> <span>Jl. Puntodewo No. 2 Baron, Nganjuk, Jawa Timur 64394</span></td>
        </tr>
    </table>

    <!-- PRODUCTS -->
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

    <!-- TOTAL SECTION -->
    <div class="bottom-section">
        <div class="terms">
            <b>TERM AND CONDITIONS</b><br>
            Please send payment within 10 days of receiving this invoice.<br><br>
            <b>THANK YOU FOR YOUR BUSINESS</b>
        </div>
        <div class="totals-wrapper">
            <table class="totals">
                <tr>
                    <td>Sub-total</td>
                    <td>{{ number_format($subtotal,0,',','.') }}</td>
                </tr>
                <tr>
                    <td>Pajak (11%)</td>
                    <td>{{ number_format($subtotal * 0.11, 0, ',', '.') }}</td>
                </tr>
                <tr class="total-row">
                    <td>Total</td>
                    <td>{{ number_format($subtotal * 1.11, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer-strip">
        <img src="{{ public_path('assets/picture/pic_headerBottom.png') }}" alt="Header Bottom" style="height: 20px; width:65%;">
        <img src="{{ public_path('assets/picture/pic_logoInstagram.png') }}" alt="Instagram" style="width: 16px; height: 16px;">
        <img src="{{ public_path('assets/picture/pic_logoTiktok.png') }}" alt="TikTok" style="width: 16px; height: 16px;">
        <span>@imersa.co.id</span>
    </div>

</div>
</body>
</html>
