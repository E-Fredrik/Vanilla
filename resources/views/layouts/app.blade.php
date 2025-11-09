<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vanilla Bakery') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar d-flex flex-column">
            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <a href="/" class="sidebar-brand">
                    <i class="bi bi-shop sidebar-brand-icon"></i>
                    <div>
                        <div class="sidebar-brand-text">Vanilla Bakery</div>
                        <div class="sidebar-subtitle">Admin Panel</div>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="sidebar-nav flex-grow-1">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam"></i>
                    Products
                </a>
                <a href="/" class="nav-link">
                    <i class="bi bi-globe"></i>
                    Visit Website
                </a>
            </nav>

            <!-- Logout Section -->
            <div class="logout-section">
                <div class="mb-3 text-center">
                    <small class="text-muted d-block mb-1">Logged in as</small>
                    <strong class="text-dark">{{ Auth::user()->name }}</strong>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Page Header -->
            @isset($header)
                <header class="page-header">
                    {{ $header }}
                </header>
            @endisset

            <!-- Page Content -->
            <main class="p-4">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
