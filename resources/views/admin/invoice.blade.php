@extends('layouts.layout')

@section('content')
<div class="invoice-container">
    <h2>Generate Invoice</h2>

    <form class="invoice-form">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" placeholder="Masukkan Email" id="email">
        </div>

        <div class="form-group">
            <label for="client">Penerima Invoice</label>
            <textarea id="client" placeholder="Ex. PT Allena Corporindo, Jl Mangkubumi No. 11, Kota Yogyakarta, DIY 55231"></textarea>
        </div>

        <div class="form-group">
            <label>Produk atau jasa yang diambil (Kesatu)</label>
            <div class="option-group">
                <button type="button">Paket SEO</button>
                <button type="button">Paket Leads</button>
                <button type="button">Paket Iklan</button>
                <button type="button">Paket Website</button>
                <button type="button">Facebook Marketplace</button>
            </div>
        </div>

        <div class="form-group">
            <label>Jumlah dari paket pertama</label>
            <div class="option-group">
                <button type="button">1</button>
                <button type="button">2</button>
                <button type="button">3</button>
                <button type="button">4</button>
                <input type="number" placeholder="Lainnya" class="custom-input">
            </div>
        </div>

        <div class="form-group">
            <label for="harga-paket-1">Harga paket pertama</label>
            <input type="text" id="harga-paket-1" placeholder="Masukkan Harga Paket">
        </div>

        <div class="form-group">
            <label for="total-paket-1">Total harga paket pertama</label>
            <input type="text" id="total-paket-1" placeholder="Masukkan Total Harga">
        </div>

        <div id="paket-container"></div>

        <div class="form-group">
            <button type="button" class="btn-add-paket">+ Tambah Paket</button>
        </div>

        <div class="form-group">
            <label for="total-sebelum">Total sebelum pajak</label>
            <input type="text" id="total-sebelum" placeholder="Masukkan Total Harga">
        </div>

        <div class="form-group">
            <label for="grand-total">Grand Total</label>
            <input type="text" id="grand-total" placeholder="Masukkan Total Akhir">
        </div>

        <button type="submit" class="btn-generate">Generate Invoice</button>
    </form>
</div>

<script>
    function updatePaketNumbering() {
        const paketWrappers = document.querySelectorAll('.paket-wrapper');
        paketWrappers.forEach((el, index) => {
            el.querySelector('.paket-title').textContent = `Paket ke-${index + 2}`; // Paket ke-1 sudah tetap, jadi mulai dari 2
        });
    }

    document.querySelector('.btn-add-paket').addEventListener('click', function () {
        const paketHTML = `
        <div class="paket-wrapper" style="border: 1px solid #ddd; padding: 15px; border-radius: 6px; margin-top: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <strong class="paket-title"></strong>
                <button type="button" class="btn-hapus-paket" style="background-color: #ff4d4d; color: white; border: none; padding: 5px 10px; border-radius: 4px;">Hapus</button>
            </div>

            <div class="form-group">
                <label>Produk atau jasa</label>
                <div class="option-group">
                    <button type="button">Paket SEO</button>
                    <button type="button">Paket Leads</button>
                    <button type="button">Paket Iklan</button>
                    <button type="button">Paket Website</button>
                    <button type="button">Facebook Marketplace</button>
                </div>
            </div>

            <div class="form-group">
                <label>Jumlah</label>
                <div class="option-group">
                    <button type="button">1</button>
                    <button type="button">2</button>
                    <button type="button">3</button>
                    <button type="button">4</button>
                    <input type="number" placeholder="Lainnya" class="custom-input">
                </div>
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="text" placeholder="Masukkan Harga Paket">
            </div>

            <div class="form-group">
                <label>Total Harga</label>
                <input type="text" placeholder="Masukkan Total Harga">
            </div>
        </div>`;

        document.getElementById('paket-container').insertAdjacentHTML('beforeend', paketHTML);
        updatePaketNumbering();
    });

    document.getElementById('paket-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-hapus-paket')) {
            e.target.closest('.paket-wrapper').remove();
            updatePaketNumbering();
        }
    });
</script>
@endsection
