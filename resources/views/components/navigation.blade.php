@props([])
<link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
<nav class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top" style="background: linear-gradient(135deg,#F5E6D3 0%,#E8D4B8 100%); z-index:1030;">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold fs-3 d-flex align-items-center gap-2" href="/" style="font-family: Georgia, serif; letter-spacing:1px; color:#2C2C2C;">
            @if(file_exists(storage_path('app/public/images/Logo_Vanilla.png')))
                <img src="{{ asset('storage/images/Logo_Vanilla.png') }}" alt="Logo Vanilla Bakery" style="height:50px; width:auto; object-fit:contain; filter:drop-shadow(2px 2px 4px rgba(0,0,0,.1));">
            @elseif(file_exists(public_path('images/Logo_Vanilla.png')))
                <img src="{{ asset('images/Logo_Vanilla.png') }}" alt="Logo Vanilla Bakery" style="height:50px; width:auto; object-fit:contain; filter:drop-shadow(2px 2px 4px rgba(0,0,0,.1));">
            @else
                <i class="bi bi-shop" style="font-size: 2rem; color: #D4AF88;"></i>
            @endif
            <span class="d-none d-md-inline">Vanilla Bakery</span>
        </a>
        <button class="navbar-toggler border-0 shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="background-color:#fff;">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item mx-1">
                    <a class="nav-link nav-link-custom {{ Request::is('/') ? 'active' : '' }}" href="/"><i class="bi bi-house-door-fill me-1"></i>Home</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link nav-link-custom {{ Request::is('about*') ? 'active' : '' }}" href="/about"><i class="bi bi-info-circle-fill me-1"></i>About Us</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link nav-link-custom {{ Request::is('products') || Request::is('products/*') ? 'active' : '' }}" href="/products"><i class="bi bi-basket2-fill me-1"></i>Our Products</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link nav-link-custom {{ Request::is('contact*') ? 'active' : '' }}" href="/#contact"><i class="bi bi-envelope-fill me-1"></i>Contact</a>
                </li>
                @auth
                    <li class="nav-item dropdown mx-1">
                        <a class="nav-link nav-link-custom dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item mx-1">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-dark rounded-pill px-3"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>