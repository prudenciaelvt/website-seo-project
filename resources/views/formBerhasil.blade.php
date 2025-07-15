<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Form Berhasil</title>
  <link rel="stylesheet" href="{{ asset('css/formBerhasil.css') }}">
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">
        <img src="{{ asset('assets/picture/pic_logoImersa.png') }}" alt="Logo Imersa">
        </a>
    </nav>
    <div class="success-container">
        <img src="{{ asset('assets/picture/pic_berhasil.png') }}" alt="Berhasil" class="success-icon">
        <h2>Pengisian Formulir Berhasil!</h2>
        <p>Tunggu konfirmasi selanjutnya dari kami</p>
        <a href="{{ route('home') }}" class="btn-kembali">Kembali ke Beranda</a>
    </div>
</body>
</html>
