<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Paket SEO Imersa</title>
  <link rel="stylesheet" href="{{ asset('css/formPaketSEO.css') }}">
</head>
<body>
  <nav class="navbar">
    <a href="#" class="logo">
      <img src="{{ asset('assets/picture/pic_logoImersa.png') }}" alt="Logo Imersa">
    </a>
  </nav>

  <main class="main-content">
    <section class="left-info">
      <h2>Daftar Partner<br>Paket SEO Imersa</h2>
      <p>Mohon isi data berikut dengan akurat dan lengkap sesuai dengan pertanyaan yang tertera</p>

      @if(session('success'))
        <div style="color: green; margin-top: 10px;">
          {{ session('success') }}
        </div>
      @endif
    </section>

    <section class="form-wrapper">
      <form action="{{ route('seo-package.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label>Nama (usaha/perusahaan)<span>*</span></label>
          <input type="text" name="nama_usaha" placeholder="Contoh: PT Imersa Solusi Teknologi" required>
        </div>

        <div class="form-group">
          <label>Website (usaha/perusahaan)<span>*</span></label>
          <input type="text" name="website_usaha" placeholder="Contoh: imersa.co.id" required>
        </div>

        <div class="form-group">
          <label>Nama (pemilik usaha)<span>*</span></label>
          <small>Isi data berikut sesuai KTP</small>
          <input type="text" name="nama_pemilik" placeholder="Contoh: Miftahur Roziqin" required>
        </div>

        <div class="form-group">
          <label>Nomor telepon (pemilik usaha)</label>
          <input type="text" name="nomor_telepon" placeholder="Contoh: 085755896233">
        </div>

        <div class="form-group">
          <label>Jangka waktu Paket SEO yang diambil<span>*</span></label>
          <div class="radio-group">
            <label><input type="radio" name="jangka_waktu" value="6 Bulan" required> 6 Bulan</label>
          </div>
        </div>

        <div class="form-group">
          <label>Produk yang dipromosikan</label>
          <input type="text" name="produk" placeholder="Contoh: Jasa Konsultasi Finansial">
        </div>

        <div class="form-group">
          <label>Target market</label>
          <small>Silakan isi semua target market potensial atau target market yang diharapkan</small>
          <input type="text" name="target_market" placeholder="Contoh: Masyarakat, Pegawai Korporat, dsb">
        </div>

        <div class="form-group">
          <p class="agreement-text">
            Dengan mengirimkan formulir ini, menyatakan telah membaca, memahami, dan menyetujui semua syarat dan ketentuan tertera.<span>*</span>
          </p>
          <div class="radio-group">
            <label><input type="radio" name="setuju" value="1" required> Ya, Saya Setuju.</label>
          </div>
        </div>

        <div class="form-submit">
          <button type="submit">Submit</button>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
