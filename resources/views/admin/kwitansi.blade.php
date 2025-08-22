@extends('layouts.layout')

@section('content')
<div class="kwitansi-container">
    <div class="inner-container">
        <h2 class="title-page">Generate Kwitansi</h2>

        {{-- Bagian Pencarian --}}
        <div class="search-section">
            <form method="GET" action="{{ route('admin.kwitansi') }}">
                <label for="search" class="search-label">Search</label>
                <input type="text" id="search" name="search" placeholder="Masukkan Kata Kunci" value="{{ request('search') }}">
                <button type="submit" class="btn btn-cari">Cari</button>
            </form>
        </div>

        

        {{-- Tabel menampilkan data kwitansi --}}
        <div class="table-wrapper">
            <table class="table-kwitansi">
                <thead>
                    <tr>
                        <th>Nama </th>
                        <th>Kontak</th>
                        <th>Paket</th>
                        <th>Tanggal Masuk</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices as $inv)
                        <tr>
                            <td>{{ $inv->client }}</td>
                            <td>{{ $inv->email }}</td>
                            <td>
                                {{-- Tampilkan paket utama --}}
                                {{ $inv->paket1_produk }}

                                {{-- Cek apakah ada paket tambahan --}}
                                @if(!empty($inv->paket_tambahan))
                                    @php
                                        // Jika string JSON, decode dulu
                                        $tambahan = is_string($inv->paket_tambahan) ? json_decode($inv->paket_tambahan, true) : $inv->paket_tambahan;
                                    @endphp

                                    @if(is_array($tambahan))
                                        @foreach($tambahan as $paket)
                                            <br>{{ $paket['nama'] ?? '' }}
                                        @endforeach
                                    @endif
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($inv->created_at)->format('d-m-Y H:i') }}</td>
                            <td>Rp {{ number_format($inv->grand_total, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('kwitansi.generate', $inv->id) }}" class="btn btn-warning">
                                    Generate Kwitansi
                                </a>


                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">Tidak ada data kwitansi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/kwitansi.css') }}">
@endpush
