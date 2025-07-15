<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>SEO Imersa</title>    
    <link rel="stylesheet" href="{{ asset('css/paketSeoGaransi.css') }}">
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('assets/picture/pic_logoImersa.png') }}" alt="Logo Imersa">
        </a>
    </nav>
    <main>
        <section class="ketentuan-garansi">
            <div class="sub-judul">
                <h2>Ketentuan Garansi</h2>
            </div>
            <div class="garansi">
                <ol>
                    <li>Kami menjamin 3 keyword akan muncul di halaman 1 Google dalam waktu 6 bulan.</li>
                    <li>Kami menargetkan 100an keyword untuk meningkatkan peluang ranking.</li>
                    <li>Keyword yang naik tidak bisa ditentukan oleh pelanggan, karena sistem kami bekerja secara menyeluruh.</li>
                    <li>Jika 3 dari 100an keyword yang kami targetkan sudah naik ke halaman 1 Google, maka masa garansi dianggap selesai.</li>
                </ol>          
            </div>
        </section>
        <div class="button-container">
            <a href="{{ route('form.paket.seo') }}" class="btn-next">Lanjutkan</a>
        </div>


    </main>
</body>
</html>
