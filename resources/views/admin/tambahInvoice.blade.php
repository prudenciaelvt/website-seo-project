@extends('layouts.layout')

@section('content')
<div class="invoice-container">
    <h2>Tambah Invoice Baru</h2>

    <form class="invoice-form" id="invoice-form" method="POST" action="{{ route('admin.invoice.store') }}">
        @csrf

        {{-- Email --}}
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" placeholder="Masukkan Email" id="email" name="email" required>
        </div>

        {{-- Penerima Invoice --}}
        <div class="form-group">
            <label for="client">Penerima Invoice</label>
            <textarea id="client" name="client" placeholder="Ex. PT Allena Corporindo, Jl Mangkubumi No. 11, Kota Yogyakarta, DIY 55231" required></textarea>
        </div>

        {{-- Paket Pertama --}}
        <div class="form-group">
            <label>Produk atau jasa yang diambil (Kesatu)</label>
            <div class="option-group produk1-options">
                <button type="button" data-value="Paket SEO">Paket SEO</button>
                <button type="button" data-value="Paket Leads">Paket Leads</button>
                <button type="button" data-value="Paket Iklan">Paket Iklan</button>
                <button type="button" data-value="Paket Website">Paket Website</button>
                <button type="button" data-value="Facebook Marketplace">Facebook Marketplace</button>
            </div>
            <input type="hidden" name="paket1_produk" id="paket1_produk" required>
        </div>

        <div class="form-group">
            <label>Jumlah dari paket pertama</label>
            <div class="option-group jumlah1-options">
                <button type="button" data-value="1">1</button>
                <button type="button" data-value="2">2</button>
                <button type="button" data-value="3">3</button>
                <button type="button" data-value="4">4</button>
                <input type="number" placeholder="Lainnya" class="custom-input" id="paket1_qty_custom">
            </div>
            <input type="hidden" name="paket1_qty" id="paket1_qty" required>
        </div>

        <div class="form-group">
            <label for="harga-paket-1">Harga paket pertama</label>
            <input type="text" id="harga-paket-1" name="paket1_harga" placeholder="Contoh: 100000" required>
        </div>

        <div class="form-group">
            <label for="total-paket-1">Total harga paket pertama</label>
            <input type="text" id="total-paket-1" name="paket1_total" placeholder="Contoh: 100000" required>
        </div>

        {{-- Paket Tambahan --}}
        <div id="paket-container"></div>
        <div class="form-group">
            <button type="button" class="btn-add-paket">+ Tambah Paket</button>
        </div>

        {{-- Total --}}
        <div class="form-group">
            <label for="total-sebelum">Total sebelum pajak</label>
            <input type="text" id="total-sebelum" name="total_sebelum" readonly style="background:#f7f7f7;">
        </div>

        <div class="form-group">
            <label for="grand-total">Grand Total (termasuk PPN 11%)</label>
            <input type="text" id="grand-total" name="grand_total" readonly style="background:#f7f7f7;">
        </div>

        <button type="submit" class="btn-save">Simpan Invoice</button>
    </form>
</div>

{{-- Popup sukses --}}
@if(session('success'))
<div id="popup-success" class="popup-success">
    <div class="popup-content">
        <img src="{{ asset('assets/picture/pic_berhasil.png') }}" alt="Berhasil" style="width:100px;margin-bottom:10px;">
        <p>{{ session('success') }}</p>
        <button onclick="document.getElementById('popup-success').style.display='none'">OK</button>
    </div>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function () {

    // --- Fungsi pilih satu (universal) ---
    function handleSingleSelection(container, hiddenInput, customInput = null) {
        container.addEventListener('click', function (e) {
            if (e.target.tagName === 'BUTTON') {
                container.querySelectorAll('button').forEach(b => b.classList.remove('active'));
                e.target.classList.add('active');
                hiddenInput.value = e.target.dataset.value;
                if (customInput) customInput.value = '';
            }
        });

        if (customInput) {
            customInput.addEventListener('input', function () {
                container.querySelectorAll('button').forEach(b => b.classList.remove('active'));
                hiddenInput.value = customInput.value;
            });
        }
    }

    // --- Fungsi perhitungan otomatis ---
    function parseNumber(value) {
        return parseFloat(value.replace(/[^0-9]/g, '')) || 0;
    }

    function formatNumber(num) {
        return num.toLocaleString('id-ID');
    }

    function updateTotals() {
        let total = 0;

        total += parseNumber(document.getElementById('total-paket-1').value);

        document.querySelectorAll('input[name="paket_total[]"]').forEach(el => {
            total += parseNumber(el.value);
        });

        const pajak = total * 0.11; // 11%
        const grandTotal = total + pajak;

        // tampilkan ke user (berformat)
        document.getElementById('total-sebelum').value = formatNumber(total);
        document.getElementById('grand-total').value = formatNumber(grandTotal);

        // simpan nilai mentah agar server tidak bingung
        document.getElementById('total-sebelum').dataset.raw = total;
        document.getElementById('grand-total').dataset.raw = grandTotal;
    }


    // --- Tambah Paket ---
    document.querySelector('.btn-add-paket').addEventListener('click', function () {
        const paketIndex = document.querySelectorAll('#paket-container .paket-wrapper').length + 2;
        const paketHTML = `
        <div class="paket-wrapper" style="border:1px solid #ddd;padding:15px;border-radius:6px;margin-top:20px;">
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <strong>Paket ${paketIndex}</strong>
                <button type="button" class="btn-hapus-paket" style="background:#ff4d4d;color:white;border:none;padding:5px 10px;border-radius:4px;">Hapus</button>
            </div>

            <div class="form-group">
                <label>Produk atau jasa</label>
                <div class="option-group produk-options">
                    <button type="button" data-value="Paket SEO">Paket SEO</button>
                    <button type="button" data-value="Paket Leads">Paket Leads</button>
                    <button type="button" data-value="Paket Iklan">Paket Iklan</button>
                    <button type="button" data-value="Paket Website">Paket Website</button>
                    <button type="button" data-value="Facebook Marketplace">Facebook Marketplace</button>
                </div>
                <input type="hidden" name="paket_produk[]" required>
            </div>

            <div class="form-group">
                <label>Jumlah</label>
                <div class="option-group jumlah-options">
                    <button type="button" data-value="1">1</button>
                    <button type="button" data-value="2">2</button>
                    <button type="button" data-value="3">3</button>
                    <button type="button" data-value="4">4</button>
                    <input type="number" placeholder="Lainnya" class="custom-input">
                </div>
                <input type="hidden" name="paket_qty[]" required>
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="text" name="paket_harga[]" class="harga-input" placeholder="Masukkan Harga Paket. Contoh: 100000" required>
            </div>

            <div class="form-group">
                <label>Total Harga</label>
                <input type="text" name="paket_total[]" class="total-input" placeholder="Masukkan Total Harga. Contoh: 100000" required>
            </div>
        </div>`;

        const container = document.createElement('div');
        container.innerHTML = paketHTML.trim();
        const newPaket = container.firstChild;
        document.getElementById('paket-container').appendChild(newPaket);

        // aktifkan fungsi pilih tombol dan hitung otomatis di paket baru
        const produkGroup = newPaket.querySelector('.produk-options');
        const jumlahGroup = newPaket.querySelector('.jumlah-options');
        const produkInput = newPaket.querySelector('input[name="paket_produk[]"]');
        const jumlahInput = newPaket.querySelector('input[name="paket_qty[]"]');
        const jumlahCustom = jumlahGroup.querySelector('.custom-input');

        handleSingleSelection(produkGroup, produkInput);
        handleSingleSelection(jumlahGroup, jumlahInput, jumlahCustom);
        attachAutoCalculation(newPaket);
    });

        document.getElementById('invoice-form').addEventListener('submit', function() {
        // ubah kembali ke nilai numerik mentah sebelum dikirim
        const totalSebelum = document.getElementById('total-sebelum');
        const grandTotal = document.getElementById('grand-total');

        totalSebelum.value = totalSebelum.dataset.raw || 0;
        grandTotal.value = grandTotal.dataset.raw || 0;
    });

    // --- Fungsi untuk attach auto kalkulasi pada semua input harga & total ---
function attachAutoCalculation(context = document) {
    const hargaInputs = context.querySelectorAll('.harga-input, #harga-paket-1');
    const totalInputs = context.querySelectorAll('.total-input, #total-paket-1');

    // Kalau harga berubah, coba hitung ulang total
    hargaInputs.forEach(input => {
        input.addEventListener('input', updateTotals);
    });

    // Kalau total berubah manual, tetap hitung total keseluruhan
    totalInputs.forEach(input => {
        input.addEventListener('input', updateTotals);
    });
}



    // Hapus paket
    document.getElementById('paket-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-hapus-paket')) {
            e.target.closest('.paket-wrapper').remove();
            updateTotals();
        }
    });

    // --- Aktifkan default ---
    handleSingleSelection(document.querySelector('.produk1-options'), document.getElementById('paket1_produk'));
    handleSingleSelection(document.querySelector('.jumlah1-options'), document.getElementById('paket1_qty'), document.getElementById('paket1_qty_custom'));
    attachAutoCalculation();

});
</script>

<style>
.option-group button.active {
    background:#4CAF50;
    color:#fff;
}
</style>
@endsection
