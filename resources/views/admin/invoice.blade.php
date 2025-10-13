@extends('layouts.layout')

@section('content')
<div class="invoice-container">
    <h2>Data Invoice</h2>

    {{-- Tombol Export Semua Invoice --}}
    <div style="margin-top:20px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px;">
        
        {{-- Bagian Pencarian --}}
        <div class="search-section">
            <form method="GET" action="{{ url()->current() }}">
                <label for="search">Search</label>
                <input type="text" id="search" name="search" placeholder="Masukkan Kata Kunci" value="{{ request('search') }}">
                <button type="submit" class="btn-cari">Cari</button>
            </form>
        </div>  

        {{-- Tombol Export dan Tambah --}}
        <div style="display:flex; gap:10px;">
            <a href="{{ route('invoices.export.flatten') }}" class="btn-excel-all" style="height:40px; display:flex; align-items:center; padding:0 15px;">
                Export Data Invoice
            </a>
            <a href="{{ route('admin.invoice.create') }}" class="btn-tambah-invoice" style="height:40px; display:flex; align-items:center; padding:0 15px;">
                + Tambah Invoice Baru
            </a>
        </div>
    </div>

    {{-- Wrapper tabel scroll --}}
    <div class="table-wrapper" style="margin-top:20px;">
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Invoice No</th>
                    <th>Nama Klien</th>
                    <th>Paket Utama</th>
                    <th>Paket Tambahan</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoices as $invoice)
                    <tr>
                        <td>{{ 'INV-' . str_pad($invoice->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $invoice->client }}</td>

                        {{-- Paket Utama --}}
                        <td>
                            {{ $invoice->paket1_produk }} <br>
                            Qty: {{ $invoice->paket1_qty }} <br>
                            Rp {{ number_format($invoice->paket1_harga, 0, ',', '.') }}
                        </td>

                        {{-- Paket Tambahan --}}
                        <td>
                            @if(!empty($invoice->paket_tambahan) && is_array($invoice->paket_tambahan))
                                @foreach($invoice->paket_tambahan as $paket)
                                    {{ $paket['nama'] }} <br>
                                    Qty: {{ $paket['qty'] }} <br>
                                    Rp {{ number_format($paket['unit_price'], 0, ',', '.') }}
                                    <br><br>
                                @endforeach
                            @else
                                -
                            @endif
                        </td>

                        <td>Rp {{ number_format($invoice->grand_total, 0, ',', '.') }}</td>

                        <td class="aksi-column">
                            {{-- Tombol Generate --}}
                            <a href="{{ route('invoices.generate', $invoice->id) }}" class="btn-aksi btn-generate">
                                <i class="fas fa-file-invoice"></i> Generate
                            </a>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus invoice ini?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-aksi btn-delete">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;">Belum ada invoice</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
