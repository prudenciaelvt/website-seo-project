<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin IMERSA</title>
    <link rel="stylesheet" href="{{ asset('css/admin.login.css') }}">

</head>
<body>

    <div class="login-container">
        <img src="{{ asset('assets/picture/pic_logoImersa.png') }}" alt="Logo IMERSA" class="logo">
        <h1>Login Admin IMERSA</h1>
        <p>Masuk ke sistem untuk mengelola layanan dan data klien anda dengan aman.</p>

        {{-- Tampilkan error login --}}
        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
