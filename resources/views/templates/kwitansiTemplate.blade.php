<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kwitansi</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 15px 25px;
            box-sizing: border-box;
        }
        /* HEADER */
        .header-top {
            text-align: right;
            margin-bottom: 5px;
        }
        .title-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .title-section h1 {
            font-size: 26px;
            margin: 0;
            color: #28a745;
        }
        /* CONTACT INFO */
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
        }
        /* TABLE PRODUK */
        table.products {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: fixed;
        }
        table.products th {
            background: #28a745;
            color: white;
            font-weight: bold;
            padding: 5px;
            text-align: left;
            border: 1px solid #ccc;
        }
        table.products td {
            padding: 5px;
            border: 1px solid #ccc;
            word-wrap: break-word;
        }
        /* TOTAL */
        .bottom-section {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .terms {
            flex: 1;
            max-width: 65%;
        }
        .totals {
            border-collapse: collapse;
        }
        .totals td {
            border: 1px solid #ccc;
            padding: 5px 10px;
            text-align: right;
        }
        .totals td:first-child {
            text-align: left;
        }
        .totals .total-row {
            background: #28a745;
            color: white;
            font-weight: bold;
        }
        /* FOOTER */
        .footer-strip {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 30px;
        }
        .footer-strip span {
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="container">

    <!-- HEADER STRIP -->
    <div class="header-top">
        <img src="{{ public_path('assets/picture/pic_headerTop.png') }}" alt="Header Top" style="width:70%; height: 25px;">
    </div>

    <!-- TITLE & LOGO -->
    <div class="title-section">
        <div>
            @if($logo)
                <img src="{{ $logo }}" alt="Logo" style="height:40px;">
            @endif
            <h1>KWITANSI</h1>
        </div>
        <div style="text-align:right;">
            <span style="font-size:22px; font-weight:bold; color:#28a745;">PAID</span>
        </div>
    </div>

    <!-- CLIENT INFO -->
    <div style="display: flex; justify-content: space-between; margin-top: 10px;">
        <div>
            Telah diterima dari:<br>
            <strong>{!! nl2br(e($client)) !!}</strong>
        </div>
        <div style="text-align:right;">
            No Kwitansi: {{ $no_kwitansi }}<br>
            Tanggal: {{ $tanggal }}
        </div>
    </div>

    <hr style="border: none; border-top: 2px solid #28a745; margin: 8px 0;">

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

    <!-- ITEM TABLE -->
    <table class="products">
        <thead>
            <tr>
                <th style="width:55%;">Keterangan</th>
                <th style="width:15%;">Qty</th>
                <th style="width:15%;">Harga Satuan</th>
                <th style="width:15%;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>{{ number_format($item['harga_satuan'], 0, ',', '.') }}</td>
                    <td>{{ number_format($item['jumlah'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>

    <!-- TOTAL & KETERANGAN -->
    <div class="bottom-section">
        <div class="terms">
            <b>Keterangan:</b><br>
            {!! nl2br(e($keterangan)) !!}
        </div>
        <div>
            <table class="totals">
                <tr>
                    <td>Sub-total</td>
                    <td>{{ number_format($subtotal,0,',','.') }}</td>
                </tr>
                <tr>
                    <td>Pajak</td>
                    <td>0</td>
                </tr>
                <tr class="total-row">
                    <td>Total</td>
                    <td>{{ number_format($total,0,',','.') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer-strip">
        <img src="{{ public_path('assets/picture/pic_headerBottom.png') }}" style="height: 20px; width:70%;">
        <img src="{{ public_path('assets/picture/pic_logoInstagram.png') }}" style="width: 18px; height: 18px;">
        <img src="{{ public_path('assets/picture/pic_logoTiktok.png') }}" style="width: 18px; height: 18px;">
        <span>@imersa.co.id</span>
    </div>

</div>
</body>
</html>
