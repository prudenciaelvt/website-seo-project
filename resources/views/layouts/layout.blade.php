<!-- template layout utama untuk halaman admin Imersa, 
    yang menyusun struktur tampilan dengan topbar logo, sidebar navigasi 
    (Beranda, Invoice, Kwitansi, Logout) 
-->

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
    <link rel="stylesheet" href="{{ asset('css/admin/detailCust.css') }}">
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
                    <li href="#" onclick="logoutAdmin()">Keluar</li>
                </ul>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        </aside>

        <main class="main-content">
            @yield('content')
        </main>
    </div>
    <script>
        function logoutAdmin() {
                event.preventDefault();
                document.getElementById('logout-form').submit();
            }
    </script>

</body>
</html>
