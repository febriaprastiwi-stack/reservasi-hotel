<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Grand Royal Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: ("{{ asset('img/hotel-bg.jpg') }}");
        }

        .register-container {
            display: flex;
            justify-content: center;
            padding: 50px 0;
        }

        .register-form {
            width: 100%;
            max-width: 500px;
            padding: 30px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="register-container">
        <div class="register-form text-center">
            <h3 class="mb-4">GRAND ROYAL HOTEL</h3>
            <p class="text-muted mb-4">Pendaftaran Pengguna Baru</p>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password_confirmation"
                        placeholder="Konfirmasi Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">REGISTER</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
