@extends('layouts.layout')
@section('title', 'Our Products')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
    
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Hero Section -->
    <div class="bg-gradient py-5 mb-5 rounded-bottom-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3" style="font-family: Georgia, serif; color: #2C2C2C;" data-aos="fade-down">
                Our Delicious Products
            </h1>
            <p class="lead text-muted mb-4" data-aos="fade-up" data-aos-delay="100">Freshly baked with love, every single day</p>
            <div class="mt-3" data-aos="zoom-in" data-aos-delay="200">
                <i class="bi bi-star-fill fs-5" style="color: #D4AF88;"></i>
                <i class="bi bi-star-fill fs-5 mx-2" style="color: #D4AF88;"></i>
                <i class="bi bi-star-fill fs-5" style="color: #D4AF88;"></i>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <!-- Search and View Toggle Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4" data-aos="fade-down">
                    <!-- Search Bar -->
                    <div class="flex-grow-1" style="max-width: 500px;">
                        <form action="{{ route('products.index') }}" method="GET" class="position-relative">
                            <input type="hidden" name="category" value="{{ $selectedCategory }}">
                            <input type="hidden" name="view" value="{{ $viewMode }}">
                            <input type="text" 
                                   name="search" 
                                   class="form-control form-control-lg rounded-pill ps-5 shadow-sm" 
                                   placeholder="Search products..."
                                   value="{{ $searchTerm }}"
                                   style="border: 2px solid #D4AF88;">
                            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-4" 
                               style="color: #D4AF88; font-size: 1.2rem;"></i>
                            @if($searchTerm)
                                <a href="{{ route('products.index', ['category' => $selectedCategory, 'view' => $viewMode]) }}" 
                                   class="position-absolute top-50 end-0 translate-middle-y me-4 text-muted">
                                    <i class="bi bi-x-circle-fill fs-5"></i>
                                </a>
                            @endif
                        </form>
                    </div>
                    
                    <!-- View Toggle Buttons -->
                    <div class="btn-group shadow-sm" role="group">
                        <a href="{{ route('products.index', ['category' => $selectedCategory, 'search' => $searchTerm, 'view' => 'grid']) }}" 
                           class="btn {{ $viewMode === 'grid' ? 'btn-primary' : 'btn-outline-secondary' }}"
                           style="{{ $viewMode === 'grid' ? 'background-color: #D4AF88; border-color: #D4AF88;' : '' }}">
                            <i class="bi bi-grid-3x3-gap-fill"></i> Grid
                        </a>
                        <a href="{{ route('products.index', ['category' => $selectedCategory, 'search' => $searchTerm, 'view' => 'list']) }}" 
                           class="btn {{ $viewMode === 'list' ? 'btn-primary' : 'btn-outline-secondary' }}"
                           style="{{ $viewMode === 'list' ? 'background-color: #D4AF88; border-color: #D4AF88;' : '' }}">
                            <i class="bi bi-list-ul"></i> List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Filter Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4" data-aos="fade-right">
                    <h5 class="mb-0" style="color: #2C2C2C;">
                        <i class="bi bi-funnel-fill me-2" style="color: #D4AF88;"></i>
                        Filter by Category
                    </h5>
                    <span class="badge rounded-pill px-3 py-2" style="background-color: #D4AF88;">
                        {{ count($products) }} {{ count($products) === 1 ? 'Product' : 'Products' }} Found
                    </span>
                </div>

                <!-- Category Buttons -->
                <div class="d-flex flex-wrap gap-2 mb-4" data-aos="fade-left">
                    <a href="{{ route('products.index', ['search' => $searchTerm, 'view' => $viewMode]) }}" 
                       class="btn filter-btn {{ !$selectedCategory || $selectedCategory === 'all' ? 'active' : '' }}"
                       style="{{ !$selectedCategory || $selectedCategory === 'all' ? 'background-color: #D4AF88; color: white;' : 'background-color: white; color: #2C2C2C; border: 2px solid #D4AF88;' }}">
                        <i class="bi bi-grid-3x3-gap-fill me-2"></i>
                        All Products
                        <span class="badge ms-2" style="{{ !$selectedCategory || $selectedCategory === 'all' ? 'background-color: rgba(255,255,255,0.3);' : 'background-color: #D4AF88; color: white;' }}">
                            {{ \App\Models\Product::count() }}
                        </span>
                    </a>

                    @foreach($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->id, 'search' => $searchTerm, 'view' => $viewMode]) }}" 
                           class="btn filter-btn {{ $selectedCategory == $category->id ? 'active' : '' }}"
                           style="{{ $selectedCategory == $category->id ? 'background-color: #D4AF88; color: white;' : 'background-color: white; color: #2C2C2C; border: 2px solid #D4AF88;' }}">
                            <i class="bi bi-tag-fill me-2"></i>
                            {{ $category->name }}
                            <span class="badge ms-2" style="{{ $selectedCategory == $category->id ? 'background-color: rgba(255,255,255,0.3);' : 'background-color: #D4AF88; color: white;' }}">
                                {{ $category->products_count }}
                            </span>
                        </a>
                    @endforeach
                </div>

                <!-- Active Filters Display -->
                @if($selectedCategory && $selectedCategory !== 'all' || $searchTerm)
                    <div class="alert alert-light border-0 shadow-sm d-flex justify-content-between align-items-center flex-wrap gap-2" 
                         style="background: linear-gradient(135deg, #F5E6D3 0%, #E8D4B8 100%);"
                         data-aos="zoom-in">
                        <div>
                            <i class="bi bi-funnel-fill me-2" style="color: #D4AF88;"></i>
                            <strong>Active Filters:</strong>
                            @if($searchTerm)
                                <span class="badge bg-dark mx-1">
                                    <i class="bi bi-search me-1"></i>{{ $searchTerm }}
                                </span>
                            @endif
                            @if($selectedCategory && $selectedCategory !== 'all')
                                @php
                                    $activeCategory = $categories->firstWhere('id', $selectedCategory);
                                @endphp
                                @if($activeCategory)
                                    <span class="badge mx-1" style="background-color: #D4AF88;">
                                        <i class="bi bi-tag-fill me-1"></i>{{ $activeCategory->name }}
                                    </span>
                                @endif
                            @endif
                        </div>
                        <a href="{{ route('products.index', ['view' => $viewMode]) }}" class="btn btn-sm btn-dark">
                            <i class="bi bi-x-circle me-1"></i>Clear All Filters
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Products Grid/List View -->
        @if(count($products) > 0)
            @if($viewMode === 'grid')
                <!-- Grid View -->
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($products as $product)
                        <div class="col" 
                             data-aos="fade-up" 
                             data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="card h-100 product-card shadow-sm border-0">
                                <!-- Product Image -->
                                <div class="position-relative overflow-hidden" style="height: 250px; background: linear-gradient(135deg, #F5E6D3 0%, #E8D4B8 100%);">
                                    @if ($product->imagePath)
                                        @php
                                            $cleanPath = str_replace('images/', '', $product->imagePath);
                                            $cleanPath = str_replace('storage/', '', $cleanPath);
                                            
                                            $storageExists = Storage::disk('public')->exists('images/' . $cleanPath);
                                            $publicExists = file_exists(public_path('images/' . $cleanPath));
                                            
                                            if ($storageExists) {
                                                $imageSrc = asset('storage/images/' . $cleanPath);
                                            } elseif ($publicExists) {
                                                $imageSrc = asset('images/' . $cleanPath);
                                            } else {
                                                $imageSrc = null;
                                            }
                                        @endphp
                                        
                                        @if($imageSrc)
                                            <img src="{{ $imageSrc }}" 
                                                 class="product-image w-100 h-100" 
                                                 alt="{{ $product->name }}"
                                                 style="object-fit: cover;">
                                        @else
                                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                                <i class="bi bi-image display-3" style="color: #D4AF88;"></i>
                                            </div>
                                        @endif
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-image display-3" style="color: #D4AF88;"></i>
                                        </div>
                                    @endif
                                    
                                    <!-- Category Badges -->
                                    <div class="position-absolute top-0 start-0 p-2">
                                        @foreach($product->categories as $category)
                                            <span class="badge me-1 mb-1" style="background-color: #D4AF88;">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>

                                    <!-- Overlay on Hover -->
                                    <div class="product-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                         style="background: linear-gradient(135deg, rgba(212, 175, 136, 0.95) 0%, rgba(193, 154, 107, 0.95) 100%); opacity: 0;">
                                        <a href="/products/{{ $product->id }}" 
                                           class="btn btn-light btn-lg rounded-pill px-4 shadow">
                                            <i class="bi bi-eye-fill me-2"></i>View Details
                                        </a>
                                    </div>
                                </div>

                                <!-- Product Info -->
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold mb-2" style="color: #2C2C2C; font-family: Georgia, serif;">
                                        {{ $product->name }}
                                    </h5>
                                    <p class="card-text text-muted flex-grow-1 mb-3" style="font-size: 0.95rem; line-height: 1.6;">
                                        {{ Str::limit($product->description, 100) }}
                                    </p>
                                    
                                    <!-- Price -->
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="price-tag">
                                            <small class="d-block mb-1" style="font-size: 0.75rem; color: rgba(255,255,255,0.8);">Starting from</small>
                                            <h5 class="mb-0 fw-bold text-white">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </h5>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="d-grid gap-2">
                                        <a href="/products/{{ $product->id }}" 
                                           class="btn btn-hover shadow-sm"
                                           style="background-color: #D4AF88; color: white; border: none;">
                                            <i class="bi bi-eye-fill me-2"></i>View Details
                                        </a>
                                        <a href="https://wa.me/6281332227289?text=Hi!%20I'm%20interested%20in%20{{ urlencode($product->name) }}" 
                                           target="_blank"
                                           class="btn btn-hover shadow-sm"
                                           style="background-color: #D4AF88; border: none;">
                                            <i class="bi bi-whatsapp me-2 text-white"></i>
                                            <span class="text-white">Order on WhatsApp</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- List View -->
                <div class="row g-3">
                    @foreach ($products as $product)
                        <div class="col-12" 
                             data-aos="fade-left" 
                             data-aos-delay="{{ $loop->index * 50 }}">
                            <div class="card product-card-list shadow-sm border-0">
                                <div class="row g-0">
                                    <!-- Product Image -->
                                    <div class="col-md-3 col-lg-2">
                                        <div class="position-relative overflow-hidden h-100" style="min-height: 180px; background: linear-gradient(135deg, #F5E6D3 0%, #E8D4B8 100%);">
                                            @if ($product->imagePath)
                                                @php
                                                    $cleanPath = str_replace('images/', '', $product->imagePath);
                                                    $cleanPath = str_replace('storage/', '', $cleanPath);
                                                    
                                                    $storageExists = Storage::disk('public')->exists('images/' . $cleanPath);
                                                    $publicExists = file_exists(public_path('images/' . $cleanPath));
                                                    
                                                    if ($storageExists) {
                                                        $imageSrc = asset('storage/images/' . $cleanPath);
                                                    } elseif ($publicExists) {
                                                        $imageSrc = asset('images/' . $cleanPath);
                                                    } else {
                                                        $imageSrc = null;
                                                    }
                                                @endphp
                                                
                                                @if($imageSrc)
                                                    <img src="{{ $imageSrc }}" 
                                                         class="w-100 h-100" 
                                                         alt="{{ $product->name }}"
                                                         style="object-fit: cover;">
                                                @else
                                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-image fs-1" style="color: #D4AF88;"></i>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-image fs-1" style="color: #D4AF88;"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Product Info -->
                                    <div class="col-md-9 col-lg-10">
                                        <div class="card-body d-flex flex-column h-100">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div class="flex-grow-1">
                                                    <h5 class="card-title fw-bold mb-2" style="color: #2C2C2C; font-family: Georgia, serif;">
                                                        {{ $product->name }}
                                                    </h5>
                                                    <div class="mb-2">
                                                        @foreach($product->categories as $category)
                                                            <span class="badge me-1" style="background-color: #D4AF88;">
                                                                {{ $category->name }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="text-end ms-3">
                                                    <small class="text-muted d-block mb-1">Starting from</small>
                                                    <h4 class="mb-0 fw-bold" style="color: #D4AF88;">
                                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                                    </h4>
                                                </div>
                                            </div>
                                            
                                            <p class="card-text text-muted mb-3" style="line-height: 1.6;">
                                                {{ Str::limit($product->description, 200) }}
                                            </p>
                                            
                                            <!-- Action Buttons -->
                                            <div class="d-flex gap-2 mt-auto">
                                                <a href="/products/{{ $product->id }}" 
                                                   class="btn btn-hover shadow-sm"
                                                   style="background-color: #D4AF88; color: white; border: none;">
                                                    <i class="bi bi-eye-fill me-2"></i>View Details
                                                </a>
                                                <a href="https://wa.me/6281332227289?text=Hi!%20I'm%20interested%20in%20{{ urlencode($product->name) }}" 
                                                   target="_blank"
                                                   class="btn btn-hover shadow-sm"
                                                   style="background-color: #D4AF88; border: none;">
                                                    <i class="bi bi-whatsapp me-2 text-white"></i>
                                                    <span class="text-white">Order Now</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Pagination Section -->
            <div class="row mt-5">
                <div class="col-12">
                    <nav aria-label="Product pagination" data-aos="fade-up">
                        <div class="d-flex justify-content-center align-items-center flex-column gap-3">
                            <!-- Pagination Info -->
                            <p class="text-muted mb-0">
                                Showing <strong>{{ $products->firstItem() ?? 0 }}</strong> to 
                                <strong>{{ $products->lastItem() ?? 0 }}</strong> of 
                                <strong>{{ $products->total() }}</strong> products
                            </p>
                            
                            <!-- Pagination Links -->
                            {{ $products->links('pagination::bootstrap-5') }}
                        </div>
                    </nav>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="row">
                <div class="col-12">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center py-5 my-5" 
                         style="min-height: 400px;"
                         data-aos="zoom-in">
                        <div class="mb-4">
                            <i class="bi bi-search display-1 text-muted opacity-50"></i>
                        </div>
                        <h3 class="mt-4 text-muted fw-bold">
                            No products found
                        </h3>
                        <p class="text-muted lead mb-4">
                            @if($searchTerm)
                                No results for "{{ $searchTerm }}". Try different keywords or clear filters.
                            @elseif($selectedCategory && $selectedCategory !== 'all')
                                No products found in this category. Try selecting a different category.
                            @else
                                Please check back later for our delicious baked goods!
                            @endif
                        </p>
                        <a href="{{ route('products.index', ['view' => $viewMode]) }}" 
                           class="btn btn-lg mt-3 px-5 rounded-pill shadow" 
                           style="background-color: #D4AF88; color: white;">
                            <i class="bi bi-arrow-counterclockwise me-2"></i>Clear All Filters
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Call to Action Section -->
    <div class="container mb-5">
        <div class="rounded-4 shadow-lg py-5 px-4" 
             style="background: linear-gradient(135deg, #F5E6D3 0%, #E8D4B8 100%);"
             data-aos="flip-up">
            <div class="text-center">
                <h3 class="fw-bold mb-3" style="font-family: Georgia, serif; color: #2C2C2C;">
                    <i class="bi bi-heart-fill me-2" style="color: #D4AF88;"></i>
                    Can't find what you're looking for?
                </h3>
                <p class="lead text-muted mb-4">
                    Contact us directly for custom orders and special requests!
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="https://wa.me/6281332227289?text=Hi!%20I'd%20like%20to%20make%20a%20custom%20order" 
                       target="_blank"
                       class="btn btn-lg px-5 shadow social-btn"
                       style="background-color: #D4AF88; border: none;">
                        <i class="bi bi-whatsapp me-2 text-white"></i>
                        <span class="text-white">WhatsApp Us</span>
                    </a>
                    <a href="https://www.instagram.com/vanillabakery777" 
                       target="_blank"
                       class="btn btn-lg px-5 shadow social-btn"
                       style="background-color: #D4AF88; border: none;">
                        <i class="bi bi-instagram me-2 text-white"></i>
                        <span class="text-white">Follow Us</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@endsection
