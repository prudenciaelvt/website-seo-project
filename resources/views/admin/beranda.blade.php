@extends('layouts.layout')

@section('content')
<div class="beranda-container">
    <div class="inner-container">
        <h2>Selamat Datang, Admin</h2>

        {{-- Bagian Pencarian --}}
        <div class="search-section">
            <form method="GET" action="{{ url()->current() }}">
                <label for="search">Search</label>
                <input type="text" id="search" name="search" placeholder="Masukkan Kata Kunci" value="{{ request('search') }}">
                <button type="submit" class="btn-cari">Cari</button>
            </form>
        </div>

        {{-- Tabel menampilkan data customer --}}
        <table>
            <thead>
                <tr>
                    <th>NAMA</th>
                    <th>KONTAK</th>
                    <th>PAKET</th>
                    <th>PRODUK / JASA</th>
                    <th>TANGGAL MASUK</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop data customer --}}
                @foreach($customers as $c)
                <tr>
                    <td>{{ $c->nama }}</td>
                    <td>{{ $c->kontak }}</td>
                    <td>{{ $c->paket }}</td>
                    <td>{{ $c->produk_jasa }}</td>
                    {{-- Format tanggal masuk, kalau kosong tampil tanda '-' --}}
                    <td>{{ $c->tanggal_masuk ? \Carbon\Carbon::parse($c->tanggal_masuk)->format('d-m-Y H:i') : '-' }}</td>
                    <td>
                    <a href="#" class="lihat-detail" data-id="{{ $c->id }}" data-type="{{ $c->type }}">[Lihat Detail]</a>
                    </td>                </tr>
                @endforeach
            </tbody>
        </table>

         {{-- Tombol export Excel dan PDF --}}
        <div class="button-group">
            <a href="{{ route('customers.excel') }}" class="btn-excel">Generate Excel</a>
            <a href="{{ route('customers.pdf') }}" class="btn-pdf">Generate PDF</a>
        </div>
    </div>
</div>

{{-- Model untuk menampilkan detail customer --}}
<div class="detail-overlay" id="detailOverlay" style="display:none;">
    <div class="detail-box">
        <div class="detail-header">
            <span>Preview</span>
            <button type="button" class="close-btn">×</button>
        </div>

        {{-- Bagian informasi klien --}}

        <div class="detail-section">
            <h4>Informasi Klien</h4>
            <table class="detail-table">
                <tr><td>Nama (Usaha/Perusahaan)</td><td>: <span id="nama_usaha"></span></td></tr>
                <tr><td>Website</td><td>: <span id="website_usaha"></span></td></tr>
                <tr><td>Nama Pemilik</td><td>: <span id="nama_pemilik"></span></td></tr>
                <tr><td>Nomor Telepon</td><td>: <span id="nomor_telepon"></span></td></tr>
                <tr><td>Alamat Email</td><td>: <span id="email"></span></td></tr>
                <tr><td>Alamat</td><td>: <span id="alamat_usaha"></span></td></tr>
            </table>
        </div>

         {{-- Bagian informasi paket --}}

        <div class="detail-section">
            <h4>Informasi Paket</h4>
            <table class="detail-table">
                <tr><td>Produk/Jasa</td><td>: <span id="produk"></span></td></tr>
                <tr><td>Komisi</td><td>: <span id="komisi"></span></td></tr>
                <tr><td>Paket</td><td>: <span id="paket"></span></td></tr>
                <tr><td>Durasi</td><td>: <span id="jangka_waktu"></span></td></tr>
                <tr><td>Target Market</td><td>: <span id="target_market"></span></td></tr>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.lihat-detail').forEach(function(el) {
    el.addEventListener('click', function(e) {
      e.preventDefault();

       // Ambil data id dan type dari atribut data
      const id = this.dataset.id;
      const type = this.dataset.type; // 'seo' atau 'leads'
      if (!type || !id) return alert('Data id/type tidak lengkap');

      // Ambil data detail dari server via fetch API
      fetch(`/admin/customer/${type}/${id}`)
        .then(response => {
          if (!response.ok) throw new Error('Gagal mengambil data');
          return response.json();
        })
        .then(data => {

        // Isi detail informasi klien, jika tidak ada data tampil '-'
        document.getElementById('nama_usaha').textContent = data.nama_usaha || '-';
        document.getElementById('website_usaha').textContent = data.website_usaha || '-';
        document.getElementById('nama_pemilik').textContent = data.nama_pemilik || '-';
        document.getElementById('nomor_telepon').textContent = data.nomor_telepon || '-';
        document.getElementById('email').textContent = data.email || '-';
        document.getElementById('alamat_usaha').textContent = data.alamat_usaha || '-';

        // Isi informasi paket, perhatikan ada field khusus tiap tipe paket          document.getElementById('produk').textContent = data.produk || '-';
        document.getElementById('komisi').textContent = data.komisi || '-';
        document.getElementById('paket').textContent = type.toUpperCase();
        document.getElementById('jangka_waktu').textContent = data.jangka_waktu || '-';
        document.getElementById('target_market').textContent = data.target_market || '-';

        // tampilkan modal
        document.getElementById('detailOverlay').style.display = 'flex';
        })
        .catch(err => {
          console.error(err);
          alert('Gagal memuat data detail. Cek console atau network.');
        });
    });
  });

  // close button
  document.querySelectorAll('.close-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      document.getElementById('detailOverlay').style.display = 'none';
    });
  });
});
</script>

@endsection
