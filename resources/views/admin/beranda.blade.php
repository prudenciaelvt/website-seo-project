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
                    <th>Nama</th>
                    <th>Kontak</th>
                    <th>Paket</th>
                    <th>Produk / Jasa</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
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
                    {{-- Format tanggal masuk --}}
                    <td>{{ $c->tanggal_masuk ? \Carbon\Carbon::parse($c->tanggal_masuk)->format('d-m-Y H:i') : '-' }}</td>
                    <td class="aksi-column">
                        {{-- Tombol Lihat Detail --}}
                        <a href="#" class="lihat-detail" data-id="{{ $c->id }}" data-type="{{ $c->type }}">Lihat Detail</a>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('customers.destroy', ['type' => $c->type, 'id' => $c->id]) }}" 
                            method="POST" 
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>

                    </td>            
                </tr>
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

{{-- Modal untuk menampilkan detail customer --}}
<div class="detail-overlay" id="detailOverlay" style="display:none;">
    <div class="detail-box">
        <div class="detail-header">
            <span>Preview</span>
            <button type="button" class="close-btn">×</button>
        </div>

        {{-- Informasi Klien --}}
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

        {{-- Informasi Paket --}}
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // --- Tombol Lihat Detail ---
  document.querySelectorAll('.lihat-detail').forEach(function(el) {
    el.addEventListener('click', function(e) {
      e.preventDefault();

      const id = this.dataset.id;
      const type = this.dataset.type;
      if (!type || !id) return alert('Data id/type tidak lengkap');

      fetch(`/admin/customer/${type}/${id}`)
        .then(response => {
          if (!response.ok) throw new Error('Gagal mengambil data');
          return response.json();
        })
        .then(data => {
          document.getElementById('nama_usaha').textContent = data.nama_usaha || '-';
          document.getElementById('website_usaha').textContent = data.website_usaha || '-';
          document.getElementById('nama_pemilik').textContent = data.nama_pemilik || '-';
          document.getElementById('nomor_telepon').textContent = data.nomor_telepon || '-';
          document.getElementById('email').textContent = data.email || '-';
          document.getElementById('alamat_usaha').textContent = data.alamat_usaha || '-';

          document.getElementById('produk').textContent = data.produk || '-';
          document.getElementById('komisi').textContent = data.komisi || '-';
          document.getElementById('paket').textContent = type.toUpperCase();
          document.getElementById('jangka_waktu').textContent = data.jangka_waktu || '-';
          document.getElementById('target_market').textContent = data.target_market || '-';

          document.getElementById('detailOverlay').style.display = 'flex';
        })
        .catch(err => {
          console.error(err);
          alert('Gagal memuat data detail. Cek console atau network.');
        });
    });
  });

  // --- Tombol Tutup Modal Detail ---
  document.querySelectorAll('.close-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      document.getElementById('detailOverlay').style.display = 'none';
    });
  });

  // --- SweetAlert Konfirmasi Hapus ---
  document.querySelectorAll('.form-hapus').forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault();

      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit(); // lanjut hapus jika dikonfirmasi
        }
      });
    });
  });
});
</script>

@endsection
