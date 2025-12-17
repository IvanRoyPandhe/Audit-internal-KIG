<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI AI KIG - Sistem Informasi Audit Internal</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/kig.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
</head>
<body>
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
        <div class="text-center">
            <img src="{{ asset('assets/images/logos/kig.png') }}" alt="KIG Logo" width="120" class="mb-4">
            <h1 class="mb-3">SI AI KIG</h1>
            <h5 class="text-muted mb-4">Sistem Informasi Audit Internal</h5>
            <p class="mb-4">PT Kawasan Industri Gresik</p>
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
            @endauth
        </div>
    </div>
</body>
</html>
