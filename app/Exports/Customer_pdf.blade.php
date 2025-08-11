<!DOCTYPE html>
<html>
<head>
    <title>Data Customer</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h3>Data Customer</h3>
    <table>
        <thead>
            <tr>
                <th>NAMA</th>
                <th>KONTAK</th>
                <th>PAKET</th>
                <th>PRODUK / JASA</th>
                <th>STATUS INVOICE</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $c)
                <tr>
                    <td>{{ $c->nama }}</td>
                    <td>{{ $c->kontak }}</td>
                    <td>{{ $c->paket }}</td>
                    <td>{{ $c->produk_jasa }}</td>
                    <td>{{ $c->status_invoice }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
