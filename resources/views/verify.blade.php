<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Verifikasi Dashboard - Grand Royal Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Lato:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: url("{{ asset('img/verify.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Lato', sans-serif;
        }

        .verify-box {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 40px;
            width: 420px;
            text-align: center;
            color: #fff;
            box-shadow: 0px 8px 32px rgba(0, 0, 0, 0.5);
            animation: fadeIn 1.2s ease-in-out;
        }

        .hotel-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
        }

        .hotel-logo img {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            margin-right: 12px;
            border: 2px solid #f5d76e;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.4);
        }

        .hotel-logo span {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: #f5d76e;
            letter-spacing: 1px;
        }

        .verify-box h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            margin-bottom: 20px;
            color: #f5d76e;
            text-shadow: 0px 2px 10px rgba(0, 0, 0, 0.7);
        }

        .form-control {
            border-radius: 50px;
            padding: 12px;
            text-align: center;
            border: none;
            outline: none;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .btn-gold {
            display: inline-block;
            width: 100%;
            padding: 12px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            text-transform: uppercase;
            color: #111;
            background: linear-gradient(45deg, #f5d76e, #d4af37);
            border: none;
            letter-spacing: 2px;
            box-shadow: 0 0 15px rgba(245, 215, 110, 0.6);
            transition: all 0.4s ease;
        }

        .btn-gold:hover {
            background: linear-gradient(45deg, #d4af37, #f5d76e);
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(245, 215, 110, 0.9);
        }

        .error-msg {
            color: #ff6b6b;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="verify-box">
        <!-- Logo Hotel -->
        <div class="hotel-logo">
            <img src="{{ asset('img/logo.jpg') }}" alt="Hotel Logo">
            <span>GRAND ROYAL HOTEL</span>
        </div>

        <h2>Masukkan Kode Akses</h2>

        @if (session('error'))
            <p class="error-msg">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('verify.dashboard') }}">
            @csrf
            <input type="password" class="form-control" name="access_code" placeholder="Kode Akses" required>
            <button type="submit" class="btn-gold">Verifikasi</button>
        </form>
    </div>
</body>

</html>
