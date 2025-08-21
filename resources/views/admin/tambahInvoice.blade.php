@extends('layouts.layout')

@section('content')
<div class="invoice-container">
    <h2>Tambah Invoice Baru</h2>

    <form class="invoice-form" method="POST" action="{{ route('admin.invoice.store') }}">
        @csrf

        {{-- Email --}}
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" placeholder="Masukkan Email" id="email" name="email">
        </div>

        {{-- Penerima Invoice --}}
        <div class="form-group">
            <label for="client">Penerima Invoice</label>
            <textarea id="client" name="client" placeholder="Ex. PT Allena Corporindo, Jl Mangkubumi No. 11, Kota Yogyakarta, DIY 55231"></textarea>
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
            <input type="hidden" name="paket1_produk" id="paket1_produk">
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
            <input type="hidden" name="paket1_qty" id="paket1_qty">
        </div>

        <div class="form-group">
            <label for="harga-paket-1">Harga paket pertama</label>
            <input type="text" id="harga-paket-1" name="paket1_harga">
        </div>

        <div class="form-group">
            <label for="total-paket-1">Total harga paket pertama</label>
            <input type="text" id="total-paket-1" name="paket1_total">
        </div>

        {{-- Paket Tambahan --}}
        <div id="paket-container"></div>
        <div class="form-group">
            <button type="button" class="btn-add-paket">+ Tambah Paket</button>
        </div>

        {{-- Total --}}
        <div class="form-group">
            <label for="total-sebelum">Total sebelum pajak</label>
            <input type="text" id="total-sebelum" name="total_sebelum">
        </div>

        <div class="form-group">
            <label for="grand-total">Grand Total</label>
            <input type="text" id="grand-total" name="grand_total">
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
    // --- Fungsi pilih satu (paket utama) ---
    function handleSingleSelection(containerSelector, hiddenInputSelector, customInputSelector = null) {
        const container = document.querySelector(containerSelector);
        const hiddenInput = document.querySelector(hiddenInputSelector);
        const customInput = customInputSelector ? document.querySelector(customInputSelector) : null;

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

    handleSingleSelection('.produk1-options', '#paket1_produk');
    handleSingleSelection('.jumlah1-options', '#paket1_qty', '#paket1_qty_custom');

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
                <input type="hidden" name="paket_produk[]">
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
                <input type="hidden" name="paket_qty[]">
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="text" name="paket_harga[]" placeholder="Masukkan Harga Paket">
            </div>

            <div class="form-group">
                <label>Total Harga</label>
                <input type="text" name="paket_total[]" placeholder="Masukkan Total Harga">
            </div>
        </div>
        `;
        document.querySelector('#paket-container').insertAdjacentHTML('beforeend', paketHTML);
    });

    // Delegasi event untuk paket tambahan
    document.getElementById('paket-container').addEventListener('click', function (e) {
        const wrapper = e.target.closest('.paket-wrapper');
        if (!wrapper) return;

        // Produk pilih satu
        if (e.target.tagName === 'BUTTON' && e.target.closest('.produk-options')) {
            const group = e.target.closest('.produk-options');
            group.querySelectorAll('button').forEach(b => b.classList.remove('active'));
            e.target.classList.add('active');
            wrapper.querySelector('input[name="paket_produk[]"]').value = e.target.dataset.value;
        }

        // Jumlah pilih satu
        if (e.target.tagName === 'BUTTON' && e.target.closest('.jumlah-options')) {
            const group = e.target.closest('.jumlah-options');
            group.querySelectorAll('button').forEach(b => b.classList.remove('active'));
            group.querySelector('input.custom-input').value = '';
            e.target.classList.add('active');
            wrapper.querySelector('input[name="paket_qty[]"]').value = e.target.dataset.value;
        }

        // Hapus paket
        if (e.target.classList.contains('btn-hapus-paket')) {
            wrapper.remove();
        }
    });

    // Input manual jumlah paket tambahan
    document.getElementById('paket-container').addEventListener('input', function (e) {
        if (e.target.classList.contains('custom-input') && e.target.closest('.jumlah-options')) {
            const group = e.target.closest('.jumlah-options');
            group.querySelectorAll('button').forEach(b => b.classList.remove('active'));
            e.target.closest('.paket-wrapper').querySelector('input[name="paket_qty[]"]').value = e.target.value;
        }
    });
});
</script>

<style>
.option-group button.active {
    background:#4CAF50;
    color:#fff;
}
</style>
@endsection
