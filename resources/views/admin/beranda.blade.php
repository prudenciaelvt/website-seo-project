@extends('layouts.layout')

@section('content')
<div class="beranda-container"> <!-- Tambahkan class container -->

    <div class="inner-container"> <!-- Tambahan agar struktur mirip invoice -->
        <h2>Selamat Datang, Admin</h2>

        <div class="search-section">
            <label for="search">Search</label>
            <input type="text" id="search" placeholder="Masukkan Kata Kunci">
            <button class="btn-cari">Cari</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>NAMA</th>
                    <th>KONTAK</th>
                    <th>PAKET</th>
                    <th>STATUS INVOICE</th>
                    <th>STATUS PEMBAYARAN</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>PRUDENCIA PUTRI</td>
                    <td>089518394088</td>
                    <td>PAKET SEO</td>
                    <td>INV-0001</td>
                    <td>Sudah Dibayar</td>
                    <td><a href="#">[Lihat Detail]</a></td>
                </tr>
            </tbody>
        </table>

        <div class="button-group">
            <button class="btn-pdf">Generate PDF</button>
            <button class="btn-excel">Generate Excel</button>
        </div>
    </div>
</div>
@endsection
