<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - {{ __('Page Not Found') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .error-container {
            max-width: 600px;
        }
        .error-container img {
            max-width: 100%;
        }
        .btn-back {
            margin-top: 20px;
            background-color: #303192;
            border-color: #303192;
            color: #ffffff; /* teks putih */
        }
        .btn-back:hover {
            background-color: #1f2466; /* lebih gelap saat hover */
            border-color: #1f2466;
            color: #ffffff; /* tetap putih */
        }
        h1 {
            color: #303192;
        }
        h2 {
            color: #303192;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1 class="display-1 fw-bold">404</h1>
        <h2>{{ __('Oops! Page not found.') }}</h2>
        <p class="text-muted">
            {{ __('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.') }}
        </p>
        <a href="{{ url('/') }}" class="btn btn-lg btn-back">
            {{ __('Back to Homepage') }}
        </a>
    </div>
</body>
</html>
