<!DOCTYPE html>
<html>

<head>

    <head>
        <meta charset="UTF-8">
        <title>Verifikasi Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                margin: 0;
                padding: 0;
                height: 100vh;
                background: url("hotel-bg.jpg") no-repeat center center;
                background-size: cover;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .verify-box {
                background: rgba(0, 0, 0, 0.6);
                /* transparan hitam */
                padding: 30px;
                border-radius: 10px;
                text-align: center;
                color: white;
                /* teks putih */
                width: 400px;
            }
        </style>
    </head>
</head>

<body>
    <div class="verify-box">
        <h2>Masukkan Kode Akses untuk Dashboard</h2>

        @if (session('error'))
            <p style="color:red;">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('verify.dashboard') }}">
            @csrf
            <input type="password" name="access_code" placeholder="Kode Akses" required>
            <button type="submit">Verifikasi</button>
        </form>
</body>

</html>

<style>
    body {
        background: url("{{ asset('img/verify.jpg') }}") no-repeat center center fixed;
        background-size: cover;
    }

    .card {
        background: rgba(255, 255, 255, 0.9);
        /* transparan putih elegan */
        border-radius: 15px;
    }
</style>
