<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Selamat Datang, Admin!</h1>

    <p>Anda berhasil login ke sistem.</p>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>

protected function unauthenticated($request, AuthenticationException $exception)
{
    if ($request->expectsJson()) {
        return response()->json(['message' => $exception->getMessage()], 401);
    }

    // Cek jika guard adalah admin
    $guard = $exception->guards()[0] ?? null;
    if ($guard === 'admin') {
        return redirect()->route('admin.login');
    }

    return redirect()->guest(route('login'));
}
