@extends('layouts.layout')

@section('content')
<div class="invoice-container">
    <h2>Generate Kwitansi</h2>

    <form>
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Masukkan Email" required>
        </div>

        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" placeholder="Masukkan Nama Lengkap" required>
        </div>

        <div class="form-group">
            <label for="jumlah">Banyaknya Uang Pembayaran</label>
            <input type="text" name="jumlah" id="jumlah" placeholder="Ex. Seratus Ribu Rupiah" required>
        </div>

        <div class="form-group paket-wrapper">
            <label>Tujuan Pembayaran</label>
            <div class="option-group">
                <button type="button" class="paket-btn" data-value="Paket SEO">Paket SEO</button>
                <button type="button" class="paket-btn" data-value="Paket Leads">Paket Leads</button>
                <button type="button" class="paket-btn" data-value="Paket Iklan">Paket Iklan</button>
                <button type="button" class="paket-btn" data-value="Facebook Marketplace">Facebook Marketplace</button>
                <input type="text" name="tujuan_lain" class="custom-input" placeholder=".............">
            </div>
            <input type="hidden" name="tujuan" id="tujuan">
        </div>

        <div class="form-group">
            <label>Metode Pembayaran atau Keterangan Lain</label>
            <small>Pilih salah satu metode pembayaran saja dan isi opsi lainnya apabila ada keterangan tambahan</small>
            <div class="option-group">
                <button type="button" class="metode-btn" data-value="Cash">Cash</button>
                <button type="button" class="metode-btn" data-value="Transfer">Transfer</button>
                <button type="button" class="metode-btn" data-value="QRIS">QRIS</button>
                <button type="button" class="metode-btn" data-value="E-Wallet">E-Wallet</button>
                <input type="text" name="metode_lain" class="custom-input" placeholder=".............">
            </div>
            <input type="hidden" name="metode" id="metode">
        </div>

        <button type="submit" class="btn-generate">Generate Kwitansi</button>
    </form>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/adminKwitansi.css') }}">
@endpush

@push('scripts')
<script>
    // Pemilihan tombol Tujuan
    document.querySelectorAll('.paket-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.paket-btn').forEach(b => b.classList.remove('selected'));
            this.classList.add('selected');
            document.getElementById('tujuan').value = this.getAttribute('data-value');
        });
    });

    // Pemilihan tombol Metode
    document.querySelectorAll('.metode-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.metode-btn').forEach(b => b.classList.remove('selected'));
            this.classList.add('selected');
            document.getElementById('metode').value = this.getAttribute('data-value');
        });
    });
</script>
@endpush
