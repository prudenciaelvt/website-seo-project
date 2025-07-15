<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Paket Leads Imersa</title>
  <link rel="stylesheet" href="{{ asset('css/formPaketLeads.css') }}">
</head>
<body>
  <nav class="navbar">
    <a href="{{ route('home') }}" class="logo">
      <img src="{{ asset('assets/picture/pic_logoImersa.png') }}" alt="Logo Imersa">
    </a>
  </nav>

  <main class="main-content">
    <section class="left-info">
      <h2>Daftar Partner<br>Paket Leads Imersa</h2>
      <p>Mohon isi data berikut dengan akurat dan lengkap sesuai dengan pertanyaan yang tertera</p>
    </section>

    <section class="form-wrapper">
      <form>
        <div class="form-group">
          <label>Nama (usaha/perusahaan)<span>*</span></label>
          <input type="text" placeholder="Contoh: PT Imersa Solusi Teknologi" required>
        </div>

        <div class="form-group">
          <label>Alamat (usaha/perusahaan)<span>*</span></label>
          <input type="text" placeholder="Contoh: RT 001 / RW 005 Lobseser Timur, Baron, Nganjuk, Jawa Timur 64394" required>
        </div>

        <div class="form-group">
          <label>Alamat email<span>*</span></label>
          <input type="email" placeholder="Contoh: mail@imersa.co.id" required>
        </div>

        <div class="form-group">
          <label>Nama (pemilik usaha)<span>*</span></label>
          <input type="text" placeholder="Contoh: Miftahur Roziqin" required>
        </div>

        <div class="form-group">
          <label>Nomor telepon (pemilik usaha)<span>*</span></label>
          <input type="text" placeholder="Contoh: 085755896233" required>
        </div>

        <div class="form-group">
          <label>Produk/Jasa yang dioptimasi</label>
          <input type="text" placeholder="Contoh: Jasa Konsultasi Finansial">
        </div>

        <div class="form-group">
          <label>Bagi hasil dan/atau komisi penjualan bagi Imersa<span>*</span></label>
          <small>Silakan isi nominal besaran komisi dan/atau pembagian persenan bagi hasil untuk Imersa dari leads yang closing sesuai kesepakatan</small>
          <input type="text" placeholder="Contoh: 25%" required>
        </div>

        <div class="form-group">
          <p class="agreement-text">
            Dengan mengirimkan formulir ini, menyatakan telah membaca, memahami, dan menyetujui semua syarat dan ketentuan tertera. Oleh karena itu, saya bersedia memenuhi dan menerimanya dengan penuh tanggung jawab.<span>*</span>
          </p>
          <div class="radio-group">
            <label><input type="radio" name="persetujuan" required> Ya, Saya Setuju.</label>
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
