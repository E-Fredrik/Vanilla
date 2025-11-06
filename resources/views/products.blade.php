@extends('layouts.layout')
@section('title', 'Our Products')
@section('content')
    <link rel="stylesheet" href="css/products.css">
    <!-- Hero Section -->
    <div class="bg-gradient py-5 mb-5 rounded-bottom-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3" style="font-family: Georgia, serif; color: #2C2C2C;">
                Our Delicious Products
            </h1>
            <p class="lead text-muted mb-4">Freshly baked with love, every single day</p>
            <div class="mt-3">
                <i class="bi bi-star-fill fs-5" style="color: #D4AF88;"></i>
                <i class="bi bi-star-fill fs-5 mx-2" style="color: #D4AF88;"></i>
                <i class="bi bi-star-fill fs-5" style="color: #D4AF88;"></i>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <!-- Filter/Category Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h5 class="mb-0" style="color: #2C2C2C;">
                            <i class="bi bi-grid-3x3-gap-fill me-2" style="color: #D4AF88;"></i>
                            All Products ({{ count($products) }})
                        </h5>
                    </div>
                    <div class="btn-group" role="group" aria-label="View toggle">
                        <button type="button" class="btn btn-sm active" 
                                style="background-color: #D4AF88; color: white; border: none;">
                            <i class="bi bi-grid-3x3"></i> Grid
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-list"></i> List
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm product-card" 
                         data-aos="fade-up" 
                         data-aos-delay="{{ $loop->index * 100 }}">
                        
                        <!-- Product Image -->
                        <div class="position-relative overflow-hidden rounded-top-3" 
                             style="background-color: #F5E6D3; height: 280px;">
                            
                            @if(isset($product['imagePath']) && $product['imagePath'])
                                @if(str_starts_with($product['imagePath'], 'images/'))
                                    {{-- Old format: direct public path --}}
                                    @if(file_exists(public_path($product['imagePath'])))
                                        <img src="{{ asset($product['imagePath']) }}"
                                             class="card-img-top h-100 w-100 product-image"
                                             alt="{{ $product['name'] }}"
                                             style="object-fit: cover; transition: transform 0.3s ease;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <i class="bi bi-image display-1" style="color: #D4AF88;"></i>
                                        </div>
                                    @endif
                                @else
                                    {{-- New format: storage path --}}
                                    @if(Storage::disk('public')->exists($product['imagePath']))
                                        <img src="{{ asset('storage/' . $product['imagePath']) }}"
                                             class="card-img-top h-100 w-100 product-image"
                                             alt="{{ $product['name'] }}"
                                             style="object-fit: cover; transition: transform 0.3s ease;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <i class="bi bi-image display-1" style="color: #D4AF88;"></i>
                                        </div>
                                    @endif
                                @endif
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <i class="bi bi-image display-1" style="color: #D4AF88;"></i>
                                </div>
                            @endif

                            <!-- Overlay on hover -->
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center product-overlay"
                                 style="background: rgba(0, 0, 0, 0.7); opacity: 0; transition: opacity 0.3s ease;">
                                <a href="/products/{{ $product['id'] }}" 
                                   class="btn btn-light btn-lg rounded-pill px-4 shadow-lg">
                                    <i class="bi bi-eye me-2"></i>View Details
                                </a>
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="card-body d-flex flex-column bg-light">
                            <h5 class="card-title fw-bold mb-2 text-truncate" 
                                style="color: #2C2C2C; font-family: Georgia, serif;">
                                {{ $product['name'] }}
                            </h5>
                            
                            @if(isset($product['description']))
                                <p class="card-text text-muted small mb-3 flex-grow-1" style="line-height: 1.6;">
                                    {{ Str::limit($product['description'], 80) }}
                                </p>
                            @endif

                            <div class="mt-auto">
                                <!-- Price and Stock -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="bg-white rounded-3 p-2 shadow-sm">
                                        <small class="text-muted d-block">Price</small>
                                        <span class="h5 mb-0 fw-bold" style="color: #D4AF88;">
                                            Rp {{ number_format($product['price'], 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Order Button -->
                                <a href="/products/{{ $product['id'] }}" 
                                   class="btn w-100 btn-hover shadow-sm"
                                   style="background-color: #D4AF88; color: white; border: none;">
                                    <i class="bi bi-cart-plus me-2"></i>Order Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if(count($products) === 0)
            <div class="text-center py-5">
                <i class="bi bi-basket display-1 text-muted opacity-50"></i>
                <h3 class="mt-4 text-muted">No products available</h3>
                <p class="text-muted">Please check back later for our delicious baked goods!</p>
            </div>
        @endif
    </div>

    <!-- Call to Action Section -->
    <div class="container mb-5">
        <div class="rounded-4 shadow-lg py-5 px-4" 
             style="background: linear-gradient(135deg, #F5E6D3 0%, #E8D4B8 100%);">
            <div class="text-center">
                <h2 class="mb-3 fw-bold" style="font-family: Georgia, serif; color: #2C2C2C;">
                    Can't Decide?
                </h2>
                <p class="lead mb-4" style="color: #4A4A4A;">
                    Visit our store and try our samples!
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="/#contact" 
                       class="btn btn-dark btn-lg px-5 py-3 shadow">
                        <i class="bi bi-geo-alt-fill me-2"></i>Visit Us
                    </a>
                    <a href="https://wa.me/6281332227289?text=Hallo!%20Saya%20ingin%20memesan%20produk%20Vanilla%20Bakery" 
                       class="btn btn-lg px-5 py-3 shadow"
                       style="background-color: #25D366; color: white; border: none;">
                        <i class="bi bi-whatsapp me-2"></i>Order via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
