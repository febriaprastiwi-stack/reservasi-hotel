<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Grand Royal Hotel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: url("{{ asset('img/hotel-bg.jpg') }}");
            background-position: center;
            background-attachment: fixed;
            padding-top: 56px;
        }

        .login-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-form {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.9);
            /* Sedikit transparan */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .text-muted {
            color: #6c757d !important;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-form text-center">
            <h3 class="mb-4">GRAND ROYAL HOTEL</h3>
            <p class="text-muted mb-4">Login Hanya Untuk Admin</p>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror

                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">LOGIN</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"        
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
