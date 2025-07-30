<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Imersa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/adminLayout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminBeranda.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminInvoice.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminKwitansi.css') }}">
</head>
<body>
    <div class="topbar">
        <img src="{{ asset('assets/picture/pic_logoImersa.png') }}" alt="Logo IMERSA">
    </div>
    <div class="container">
        <aside class="sidebar">
            <nav>
                <ul>
                    <li class="{{ Request::is('admin/beranda') ? 'active' : '' }}"><a href="{{ route('admin.beranda') }}">Beranda</a></li>
                    <li class="{{ Request::is('admin/invoice') ? 'active' : '' }}"><a href="{{ route('admin.invoice') }}">Invoice</a></li>
                    <li class="{{ Request::is('admin/kwitansi') ? 'active' : '' }}"><a href="{{ route('admin.kwitansi') }}">Kwitansi</a></li>
                    <li><a href="#">Keluar</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            @yield('content')
        </main>
    </div>
</body>
</html>
