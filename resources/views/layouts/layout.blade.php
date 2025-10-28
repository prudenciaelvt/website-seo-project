<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Imersa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/adminLayout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminBeranda.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminInvoice.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminKwitansi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/detailCust.css') }}">
</head>
<body>
    <!-- Hamburger Menu untuk Mobile -->
    <button class="mobile-menu-toggle" aria-label="Toggle Menu">
        <span></span>
        <span></span>
        <span></span>
    </button>
    
    <!-- Overlay untuk Mobile -->
    <div class="sidebar-overlay"></div>

    <!-- Topbar -->
    <div class="topbar">
    </div>
    
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('assets/picture/pic_logoImersa.png') }}" alt="Logo IMERSA" class="sidebar-logo">
            </div>
            <nav>
                <ul>
                    <li class="{{ Request::is('admin/beranda') ? 'active' : '' }}">
                        <a href="{{ route('admin.beranda') }}">
                            <i class="fas fa-home"></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/invoice') ? 'active' : '' }}">
                        <a href="{{ route('admin.invoice') }}">
                            <i class="fas fa-file-invoice"></i>
                            <span>Invoice</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/kwitansi') ? 'active' : '' }}">
                        <a href="{{ route('admin.kwitansi') }}">
                            <i class="fas fa-receipt"></i>
                            <span>Kwitansi</span>
                        </a>
                    </li>
                    <li class="logout-item">
                        <a href="#" onclick="logoutAdmin()">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Keluar</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        function logoutAdmin() {
            event.preventDefault();
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                document.getElementById('logout-form').submit();
            }
        }

        // JavaScript untuk Hamburger Menu
        document.addEventListener('DOMContentLoaded', function() {
            const mobileToggle = document.querySelector('.mobile-menu-toggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            if (mobileToggle) {
                mobileToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                    mobileToggle.classList.toggle('active');
                });
                
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    mobileToggle.classList.remove('active');
                });
            }
            
            // Close sidebar ketika klik link di mobile
            const navLinks = document.querySelectorAll('.sidebar nav a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        sidebar.classList.remove('active');
                        overlay.classList.remove('active');
                        mobileToggle.classList.remove('active');
                    }
                });
            });
        });
    </script>
</body>
</html>