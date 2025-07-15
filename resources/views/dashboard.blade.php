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
            <img src="{{ asset('assets/picture/pic_paketLEADS.png') }}" alt="sub Image">
            <h3>PAKET SEO</h3>
            <div class="btn-wrapper">
                <a href="{{ route('paket.seo.garansi') }}" class="btn-daftar">Daftar Sekarang</a>
            </div>             
            <h4>Syarat dan Ketentuan</h4>
            <ol>
                <li>Paket SEO Imersa merupakan program pengelolaan dan optimasi performa website mitra yang dilakukan oleh tim Imersa.</li>
                <li>Mitra wajib menyediakan akses web serta menyerahkan akses cPanel kepada Imersa untuk keperluan pengelolaan.</li>
                <li>Mitra memberikan wewenang penuh dan kebebasan kepada Imersa untuk mengelola situs web, termasuk desain, penulisan konten, dan perubahan lain selama tidak melanggar aturan perundang-undangan dan demi kebutuhan teknis optimasi sesuai program.</li>
                <li>Biaya perpanjangan domain, hosting, pembaharuan template premium, dan biaya perawatan situs selama kerja sama berlangsung tidak ditanggung dalam biaya jasa Imersa.</li>
                <li>Pengelolaan situs web akan dikembalikan kepada mitra setelah masa program selesai.</li>
                <li>Imersa akan melakukan riset kata kunci (keyword) terkait produk atau jasa mitra menggunakan mesin pencari Google.</li>
                <li>Imersa akan membuat konten orisinal sesuai kebutuhan berdasarkan hasil riset, dengan estimasi maksimal 100 landing page selama masa enam bulan.</li>
                <li>Setiap bulan, Imersa akan melakukan optimasi kata kunci dengan estimasi sebanyak 21 hingga 25 hasil riset.</li>
                <li>Laporan perkembangan dan hasil optimasi akan dikirimkan setiap tanggal 15 dan 28 setiap bulan.</li>
                <li>Hasil optimasi SEO umumnya mulai terlihat setelah enam bulan masa pengerjaan.</li>
                <li>Imersa akan melakukan riset dan optimasi terhadap kata kunci utama, mulai dari puluhan hingga ratusan sesuai riset dan potensi performa organik.</li>
                <li>Kata kunci yang tidak ditarget tidak dapat dimasukkan ke dalam daftar optimasi, karena pemilihan kata kunci dilakukan berdasarkan hasil riset dan potensi performa secara organik di mesin pencari.</li>
                <li>Kata kunci yang tidak menyerap hasil riset akan digantikan dan diupayakan untuk meningkatkan posisi mitra pada mesin pencari Google tanpa pengeluaran.</li>
                <li>Garansi diberikan terhadap kata kunci utama yang disepakati bersama selama enam bulan ke depan. Namun, Imersa tidak menjamin kata kunci mana yang akan muncul pada halaman pertama Google.</li>
                <li>Apabila ada kata kunci utama, nama brand, atau kata kunci yang digaransi tidak berhasil muncul pada halaman pertama Google, Imersa akan mengembalikan biaya layanan sebesar Rp 6.000.000 secara penuh kepada mitra.</li>
                <li>Biaya layanan sebesar Rp 6.000.000 harus dibayarkan secara penuh di awal sebelum program dimulai dan dapat dikonfirmasi oleh tim Imersa.</li>
                <li>Setelah periode enam bulan berakhir dan mitra ingin melanjutkan layanan, biaya perpanjangan adalah Rp 500.000 per bulan yang dibayarkan di awal bulan.</li>
                <li>Jika pembayaran biaya perpanjangan tidak dilakukan paling lambat tanggal 25 setiap bulan, maka layanan dianggap selesai.</li>
                <li>Semua konten yang dibuat oleh tim Imersa tidak diperjualbelikan dan dilarang keras disalin atau disebarluaskan tanpa izin.</li>
                <li>Imersa tidak bertanggung jawab atas kerusakan teknis dan kehilangan data yang disebabkan oleh pihak ketiga yang menggunakan sistem atau plugin tambahan.</li>
                <li>Setelah program berakhir dalam 6 bulan, tim Imersa akan menghentikan hasil riset, pembuatan konten, dan optimasi untuk kata kunci mitra.</li>
                <li>Halaman pertama Google didefinisikan sebagai peringkat 1–10 di hasil pencarian Google.co.id pada Mode penyamaran (incognito).</li>
            </ol>
        </div>

        <div class="paket-leads">
            <img src="{{ asset('assets/picture/pic_paketLEADS.png') }}" alt="sub Image">
            <h3>PAKET LEADS</h3>
            <div class="btn-wrapper">
                <a href="{{ route('form.paket.leads') }}" class="btn-daftar">Daftar Sekarang</a>
            </div> 
            <h4>Syarat dan Ketentuan</h4>
            <ol>
                <li>Paket Leads adalah program pemasaran melalui SEO.</li>
                <li>Goalnya adalah mendatangkan leads.</li>
                <li>Rate closing yang ditargetkan dari leads masuk sebesar 30%.</li>
                <li>Komisi diberikan jika terdapat closing dari lead Imersa, baik nomor baru maupun nomor lama yang repeat order.</li>
                <li>Jangka waktu kerja sama selama 1 tahun.</li>
                <li>Apabila rate closing tidak mencapai 30%, maka kerja sama akan dirembuk kembali.</li>
                <li>Komisi diberikan setiap akhir bulan.</li>
                <li>Biaya berlangganan selama 6 bulan yaitu Rp 6.000.000.</li>
                <li>Pada bulan ke-7 dan seterusnya biaya berlangganan hanya Rp 500.000 per bulannya.</li>
                <li>Segala bentuk pembayaran kepada Imersa tidak dapat dikembalikan.</li>
            </ol>
            <h4>Kewajiban dan Hak Imersa & Partner</h4>
            <ol>
                <li>Imersa akan menyediakan nomor untuk keperluan closing leads.</li>
                <li>Nomor tersebut adalah hak milik Imersa.</li>
                <li>Imersa akan memberikan laporan setiap minggu tanggal 15 dan 28 pada masa 6 bulan awal kerjasama.</li>
                <li>Imersa dapat memutus kerjasama sebelum habis jangka waktunya, apabila partner melanggar isi bisnis yang melanggar peraturan negara, melakukan penipuan, atau pelayanan lain yang bertentangan dengan etika/produk.</li>
                <li>Partner menyediakan product knowledge, logo dan foto/video produk.</li>
                <li>Partner menyediakan HP khusus untuk menerima leads masuk dari Imersa.</li>
                <li>Imersa tidak bertanggung jawab dari resiko terkait produk/jasa.</li>
            </ol>
        </div>
    </section>

    </main>

    <footer class="imersa-footer">
        <div class="footer-top">
            <div class="footer-left">
            <img src="{{ asset('assets/picture/pic_logoImersa.png') }}" alt="Imersa Logo" class="footer-logo">
            <h3>IMERSA SEO SERVICE</h3>
            <p>Jl. Mastrip Lambang Kuning Kec. Kertosono Kab. Nganjuk 64315<br>
                Contact: +62 857-5589-6233</p>
            </div>

            <div class="footer-links">
            <ul>
                <li><strong>&#9658; Layanan</strong></li>
                <li><strong>&#9658; Portofolio</strong></li>
                <li><strong>&#9658; Testimoni</strong></li>
            </ul>
            <ul>
                <li><strong>&#9658; Hosting</strong></li>
                <li><strong>&#9658; Domain</strong></li>
                <li><strong>&#9658; Client Area</strong></li>
            </ul>
            </div>

            <div class="footer-description">
            <p>
                Jasa Pembuatan Website Imersa dengan keunggulan Desain Eksklusif, Harga Terjangkau, 
                Mengedepankan Fungsi dan Manfaat Sesuai Tujuan Pemesanan Anda
            </p>
            </div>
        </div>

        <div class="footer-middle">
            <div class="social-icons">
                <a href="#"><img src="{{ asset('assets/picture/pic_facebook.png') }}" alt="Facebook"></a>
                <a href="#"><img src="{{ asset('assets/picture/pic_x.png') }}" alt="X"></a>
                <a href="#"><img src="{{ asset('assets/picture/pic_google.png') }}" alt="Google"></a>
                <a href="#"><img src="{{ asset('assets/picture/pic_instagram.png') }}" alt="Instagram"></a>
                <a href="#"><img src="{{ asset('assets/picture/pic_linkedn.png') }}" alt="LinkedIn"></a>
                <a href="#"><img src="{{ asset('assets/picture/pic_github.png') }}" alt="GitHub"></a>
            </div>
        </div>


        <div class="footer-bottom">
            <p>&copy; 2023 Copyright: Layanan ImersaWeb.com | Jasa Pembuatan Website Profesional</p>
        </div>
    </footer>

</body>
</html>
