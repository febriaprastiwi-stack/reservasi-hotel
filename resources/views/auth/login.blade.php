<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Grand Royal Hotel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Lato:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            font-family: 'Lato', sans-serif;
            color: #fff;
        }

        /* Background zoom animation */
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("{{ asset('img/hotel-bg.jpg') }}") no-repeat center center;
            background-size: cover;
            z-index: -2;
            animation: bgZoom 20s ease-in-out infinite alternate;
        }

        @keyframes bgZoom {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.1);
            }
        }

        /* Partikel sparkle */
        .sparkle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #fff9c4;
            border-radius: 50%;
            opacity: 0.8;
            box-shadow: 0 0 10px #fff9c4, 0 0 20px #f5d76e, 0 0 30px #d4af37;
            animation: sparkleAnim linear infinite;
        }

        @keyframes sparkleAnim {
            from {
                transform: translateY(0) scale(1);
                opacity: 0.9;
            }

            to {
                transform: translateY(-100vh) scale(0.5);
                opacity: 0;
            }
        }

        .login-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .login-form {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 40px;
            width: 420px;
            text-align: center;
            color: #fff;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.6);
            animation: fadeInUp 1.2s ease-in-out;
        }

        .logo-wrapper img {
            width: 80px;
            border-radius: 50%;
        }

        .gold-text {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(90deg, #d4af37, #f5d76e, #fff8c6, #d4af37);
            background-size: 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shineText 5s linear infinite;
            margin: 15px 0;
        }

        @keyframes shineText {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-control {
            border-radius: 50px;
            padding: 12px;
            border: none;
            font-size: 1rem;
            margin-bottom: 18px;
            text-align: center;
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
            letter-spacing: 1px;
            box-shadow: 0 0 15px rgba(245, 215, 110, 0.6);
            transition: all 0.4s ease;
        }

        .btn-gold:hover {
            background: linear-gradient(45deg, #d4af37, #f5d76e);
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(245, 215, 110, 0.9);
        }

        .btn-secondary {
            border-radius: 50px;
            font-weight: 600;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <!-- Background -->
    <div class="background"></div>

    <!-- Sparkle container -->
    <div id="sparkle-container"></div>

    <div class="login-container">
        <div class="login-form">
            <div class="logo-wrapper">
                <img src="{{ asset('img/logo.jpg') }}" alt="Hotel Logo">
            </div>
            <h3 class="gold-text">GRAND ROYAL HOTEL</h3>
            <p>Login Hanya Untuk Admin</p>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <input type="email" class="form-control" name="email" placeholder="Email" required>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror

                <input type="password" class="form-control" name="password" placeholder="Password" required>
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn-gold">LOGIN</button>
                <a href="{{ route('home') }}" class="btn btn-secondary w-100">BACK</a>
            </form>
        </div>
    </div>

    <script>
        // Generate sparkle
        const container = document.getElementById('sparkle-container');
        for (let i = 0; i < 40; i++) {
            const sparkle = document.createElement('div');
            sparkle.classList.add('sparkle');
            sparkle.style.left = Math.random() * 100 + "vw";
            sparkle.style.top = Math.random() * 100 + "vh";
            sparkle.style.animationDuration = (5 + Math.random() * 5) + "s";
            sparkle.style.opacity = Math.random();
            container.appendChild(sparkle);
        }
    </script>
</body>

</html>
