<!-- @extends('layouts.layout')

@section('content')
<div class="detail-overlay">
    <div class="detail-box">
        {{-- Header --}}
        <div class="detail-header">
            <span>Preview</span>
            <button type="button" class="close-btn" onclick="closeDetail()">×</button>
        </div>

        {{-- Informasi Klien --}}
        <div class="detail-section">
            <h4>Informasi Klien</h4>
            <table class="detail-table">
                <tr>
                    <td>Nama (Usaha/Perusahaan)</td>
                    <td>: {{ $data->nama_usaha ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Website (Usaha/Perusahaan)</td>
                    <td>: {{ $data->website_usaha ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Nama Pemilik</td>
                    <td>: {{ $data->nama_pemilik ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Nomor Telepon</td>
                    <td>: {{ $data->nomor_telepon ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Alamat Email</td>
                    <td>: {{ $data->email ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: {{ $data->alamat_usaha ?? '-' }}</td>
                </tr>
            </table>
        </div>

        {{-- Informasi Paket --}}
        <div class="detail-section">
            <h4>Informasi Paket</h4>
            <table class="detail-table">
                <tr>
                    <td>Produk/Jasa yang Dioptimasi</td>
                    <td>: {{ $data->produk ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Bagi Hasil / Komisi</td>
                    <td>: {{ $data->komisi ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Paket</td>
                    <td>: {{ $data->paket ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Durasi</td>
                    <td>: {{ $data->jangka_waktu ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Target Market</td>
                    <td>: {{ $data->target_market ?? '-' }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

{{-- Script untuk close detail --}}
<script>
    function closeDetail() {
        document.querySelector('.detail-overlay').style.display = 'none';
    }
</script>

@endsection -->