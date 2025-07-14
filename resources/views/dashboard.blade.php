<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>SEO Imersa</title>    
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('assets/picture/pic_logoImersa.png') }}" alt="Logo Imersa">
        </a>
        <div class="nav-links">
            <a>Beranda</a>
            <a>Tentang Kami</a>
            <a>Hubungi Kami</a>
        </div>
    </nav>
    <header class="header-first">
        <div class="image-background">
            <img src="{{ asset('assets/picture/picture_background.png') }}" alt="Header Image">
            <div class="header-overlay">
                <h1>TINGKATKAN BISNIS ANDA KE PERINGKAT ATAS GOOGLE!</h1>
                <p>Website Modern + SEO Optimal = Penjualan Naik!</p>
                <a href="#pesan" class="cta-button">Pesan Paket SEO</a>
            </div>
        </div>
    </header>
    <main>
    {{-- Konten utama --}}
    <section class="sub-title">
        <h2>Kenapa Memilih Imersa SEO?</h2>
        <p>Kami hadir untuk membantu bisnis Anda tumbuh secara digital dengan strategi SEO yang terbukti efektif</p>
    </section>
    <section class="imersa-seo-views" aria-labelledby="sample-api-reponses-heading"> <br>
        <div class="imersa-news">
            <div class="imersa-text">
                <p>
                    IMERSA SEO adalah strategi pemasaran diggial yang dirancang khusus untuk membantu bisnis anda tampil di halaman pertama Google. Kami menggabungkan optimasi teknis, riset kata kunci, dan konten berkualitas untuk meningkatkan visibilitass, trafik, dan penjualan Anda secara berkelanjutan.
                </p>
            </div>
            <div class="imersa-pic">
                <img src="{{ asset('assets/picture/test1.png') }}" alt="Header Image">
            </div>
        </div>
    </section>
    <section class="sub-title">
        <h2>Apa yang bisa dilakukan IMERSA SEO untuk bisanis Anda?</h2>
        <p>
            Solusi menyeluruh untuk meningkatkan visibilitas dan performa bisnis Anda di Google
        </p>
    </section>
    <section class="imersa-seo-benefits" aria-labelledby="sample-api-reponses-heading"> <br>
        <!-- BOX benefits 1 -->
        <div class="imersa-box">
            <div class="imersa-benefit-pic">
                <img src="{{ asset('assets/picture/pic_desain.png') }}" alt="sub Image">
            </div>
            <div class="benefit-text">
                <div class="imersa-sub-title">
                    <h3>Desain Menarik</h3>
                </div>
                <div class="imersa-sub-text">
                    <p>Website Modern dan Profesional sesuai dengan bisnis Anda</p>
                </div>
            </div>
        </div>
        <!-- BOX benefits 2 -->
        <div class="imersa-box">
            <div class="imersa-benefit-pic">
                <img src="{{ asset('assets/picture/pic_optimasiSEO.png') }}" alt="sub Image">
            </div>
            <div class="benefit-text">
                <div class="imersa-sub-title">
                    <h3>Optimasi SEO Terbaik</h3>
                </div>
                <div class="imersa-sub-text">
                    <p>Meningkatkan visibilitas di Google dengan strategi tepat</p>
                </div>
            </div>
        </div>
        <!-- BOX benefits 3 -->
        <div class="imersa-box">
            <div class="imersa-benefit-pic">
                <img src="{{ asset('assets/picture/pic_harga.png') }}" alt="sub Image">
            </div>
            <div class="benefit-text">
                <div class="imersa-sub-title">
                    <h3>Harga Terjangkau</h3>
                </div>
                <div class="imersa-sub-text">
                    <p>Layanan berkualitas tanpa menguras anggaran Anda</p>
                </div>
            </div>
        </div>
        <!-- BOX benefits 4 -->
        <div class="imersa-box">
            <div class="imersa-benefit-pic">
                <img src="{{ asset('assets/picture/pic_manajemen.png') }}" alt="sub Image">
            </div>
            <div class="benefit-text">
                <div class="imersa-sub-title">
                    <h3>Manajemen mudah untuk klien</h3>
                </div>
                <div class="imersa-sub-text">
                    <p>Formulir, Invoce, dan informasi proyek mudah diakses dan dipantau</p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <section class="sub-title">
            <h2>Bagaimana Cara kerja Layanan IMERSA SEO?</h2>
            <p>
                Proses kerja cepat dan mudah dipahami untuk hasil SEO terbaik
            </p>
        </section>
        <section class="alur-layanan">
            <div class="step">Pilih Paket & Isi Form</div>
            <div class="arrow">→</div>
            <div class="step">Terima Invoice Pembayaran</div>
            <div class="arrow">→</div>
            <div class="step">Lakukan Pembayaran</div>
            <div class="arrow">→</div>
            <div class="step">Layanan Dimulai</div>
        </section>
    </section>
    <section class="sub-title">
        <h2>Layanan SEO yang kami tawarkan</h2>
        <p>
           Kami menyediakan dua jenis paket layanan yang dirancang khusus untuk bisnis Anda
        </p>
    </section>
    <section class="imersa-paket-seo">
        <div class="paket-seo">

        </div>
        <div class="paket-leads">
            
        </div>

    </section>

    </main>

    <footer>
        {{-- Footer --}}
    </footer>
</body>
</html>
