<!DOCTYPE html>
<html>
<head>
    <title>Data Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9fafb;
            margin: 20px;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        thead {
            background: #0072BC;
            color: white;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        tbody tr:nth-child(even) {
            background: #f4f9ff;
        }

        tbody tr:hover {
            background: #e6f2fb;
            transition: 0.2s;
        }
    </style>
</head>
<body>
    <h3>Data Customer</h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal Masuk</th>
                <th>Paket</th>
                <th>Produk/Jasa</th>
                <th>Nama Usaha/Perusahaan</th>
                <th>Website</th>
                <th>Nama Pemilik</th>
                <th>Nomor Telepon</th>
                <th>Alamat Email</th>
                <th>Alamat</th>
                <th>Komisi</th>
                <th>Jangka Waktu</th>
                <th>Target Market</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $c)
                <tr>
                    <td>{{ $c->tanggal_masuk ? \Carbon\Carbon::parse($c->tanggal_masuk)->format('d-m-Y H:i') : '-' }}</td>
                    <td>{{ $c->paket ?? '-' }}</td>
                    <td>{{ $c->produk_jasa ?? '-' }}</td>
                    <td>{{ $c->nama_usaha ?? '-' }}</td>    
                    <td>{{ $c->website_usaha ?? '-' }}</td>
                    <td>{{ $c->nama_pemilik ?? '-' }}</td>
                    <td>{{ $c->kontak ?? '-' }}</td>
                    <td>{{ $c->email ?? '-' }}</td>
                    <td>{{ $c->alamat_usaha ?? '-' }}</td>
                    <td>{{ $c->komisi ?? '-' }}</td>
                    <td>{{ $c->jangka_waktu ?? '-' }}</td>
                    <td>{{ $c->target_market ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
