<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        
        <!-- Custom Styles -->
        <style>
            body {
                font-family: 'Figtree', sans-serif;
            }
            .auth-card {
                background: white;
                border-radius: 1rem;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            }
            .btn-primary {
                background-color: #D4AF88;
                border-color: #D4AF88;
            }
            .btn-primary:hover {
                background-color: #C19A6B;
                border-color: #C19A6B;
            }
            .form-control:focus {
                border-color: #D4AF88;
                box-shadow: 0 0 0 0.25rem rgba(212, 175, 136, 0.25);
            }
        </style>
    </head>
    <body class="bg-light">
        <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center py-5">
            <div class="mb-4">
                <a href="/">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-shop" style="font-size: 3rem; color: #D4AF88;"></i>
                        <span class="h3 mb-0 fw-bold" style="color: #2C2C2C;">Vanilla Bakery</span>
                    </div>
                </a>
            </div>

            <div class="auth-card p-4 p-md-5" style="width: 100%; max-width: 450px;">
                {{ $slot }}
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
