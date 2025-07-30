<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - IMERSA</title>
    <link rel="stylesheet" href="{{ asset('css/adminlogin.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
</head>
<body>
    <div class="topbar">
        <img src="{{ asset('assets/picture/pic_logoImersa.png') }}" alt="Logo IMERSA">
    </div>

    <div id="particles-js"></div>


    <div class="login-container">
        <div class="login-box">
            <h2>Login Admin IMERSA</h2>
            <p class="subtitle">Masuk ke sistem untuk mengelola layanan dan data<br>klien Anda dengan aman.</p>
            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <label for="username">Username</label>
                <div class="input-group">
                    <span class="icon">&#128100;</span>
                    <input type="text" name="username" id="username" placeholder="Username" required>
                </div>

                <label for="password">Password</label>
                <div class="input-group">
                    <span class="icon">&#128274;</span>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>

                <button type="submit" class="login-button">Login</button>
            </form>
        </div>
    </div>

    <script>
        particlesJS("particles-js", {
            particles: {
                number: { value: 50 },
                size: { value: 3 },
                move: { speed: 1 },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: "#ffffff",
                    opacity: 0.2,
                    width: 1
                }
            },
            interactivity: {
                events: {
                    onhover: { enable: true, mode: "repulse" }
                }
            }
        });
    </script>

</body>
</html>
