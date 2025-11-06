@extends('layouts.layout')
@section('title', $product['name'])
@section('content')
    <link rel = "stylesheet" href = "{{ asset('css/navigation.css') }}">
    <div class="container my-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none" style="color: #D4AF88;">Home</a></li>
                <li class="breadcrumb-item"><a href="/products" class="text-decoration-none" style="color: #D4AF88;">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product['name'] }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm overflow-hidden">
                    @if(isset($product['imagePath']) && $product['imagePath'])
                        @if(str_starts_with($product['imagePath'], 'images/'))
                            {{-- Old format --}}
                            @if(file_exists(public_path($product['imagePath'])))
                                <div class="ratio ratio-1x1" style="background-color: #F5E6D3;">
                                    <img src="{{ asset($product['imagePath']) }}" 
                                         alt="{{ $product['name'] }}" 
                                         class="w-100 h-100"
                                         style="object-fit: cover;">
                                </div>
                            @else
                                <div class="ratio ratio-1x1 d-flex align-items-center justify-content-center" style="background-color: #F5E6D3;">
                                    <div class="text-center">
                                        <i class="bi bi-image" style="font-size: 5rem; color: #D4AF88;"></i>
                                        <p class="mt-3 text-muted">No image available</p>
                                    </div>
                                </div>
                            @endif
                        @else
                            {{-- New format --}}
                            <div class="ratio ratio-1x1" style="background-color: #F5E6D3;">
                                <img src="{{ asset('storage/' . $product['imagePath']) }}" 
                                     alt="{{ $product['name'] }}" 
                                     class="w-100 h-100"
                                     style="object-fit: cover;">
                            </div>
                        @endif
                    @else
                        <div class="ratio ratio-1x1 d-flex align-items-center justify-content-center" style="background-color: #F5E6D3;">
                            <div class="text-center">
                                <i class="bi bi-image" style="font-size: 5rem; color: #D4AF88;"></i>
                                <p class="mt-3 text-muted">No image available</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <h1 class="mb-3">{{ $product['name'] }}</h1>
                
                <div class="mb-4">
                    <h2 class="text-primary" style="color: #D4AF88 !important;">
                        Rp {{ number_format($product['price'], 0, ',', '.') }}
                    </h2>
                </div>

                <div class="mb-4">
                    <h5>Description</h5>
                    <p class="text-muted">{{ $product['description'] ?? 'No description available' }}</p>
                </div>

                <div class="mb-4">
                    <h5>Ingredients</h5>
                    <p class="text-muted">{{ $product['ingredients'] ?? 'No ingredients listed' }}</p>
                </div>

                <div class="d-flex gap-3">
                    <a href="https://wa.me/6281332227289?text=Hi!%20I'm%20interested%20in%20{{ urlencode($product['name']) }}"
                       class="btn btn-lg px-5" 
                       style="background-color: #D4AF88; color: white; border: none;">
                        <i class="bi bi-whatsapp me-2"></i>Order Now
                    </a>
                    <a href="/products" class="btn btn-outline-secondary btn-lg px-4">
                        <i class="bi bi-arrow-left me-2"></i>Back to Products
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body" style="background-color: #F5E6D3;">
                        <h5 class="card-title mb-4">Product Information</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Product ID:</strong> #{{ str_pad($product['id'], 4, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Category:</strong> Baked Goods</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection