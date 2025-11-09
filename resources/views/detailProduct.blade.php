@extends('layouts.layout')
@section('title', $product->name)
@section('content')
    <link rel = "stylesheet" href = "{{ asset('css/navigation.css') }}">
    
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <div class="container my-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-down">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none" style="color: #D4AF88;">Home</a></li>
                <li class="breadcrumb-item"><a href="/products" class="text-decoration-none" style="color: #D4AF88;">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6 mb-4" data-aos="fade-right">
                <div class="card shadow-sm overflow-hidden">
                    @if($product->imagePath)
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
                            <div class="ratio ratio-1x1" style="background-color: #F5E6D3;">
                                <img src="{{ $imageSrc }}" 
                                     alt="{{ $product->name }}" 
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
            <div class="col-md-6" data-aos="fade-left" data-aos-delay="100">
                <h1 class="mb-3">{{ $product->name }}</h1>
                
                <!-- Categories -->
                @if($product->categories->count() > 0)
                    <div class="mb-3">
                        @foreach($product->categories as $category)
                            <span class="badge me-1 mb-1" style="background-color: #D4AF88;">
                                <i class="bi bi-tag-fill me-1"></i>{{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                @endif
                
                <div class="mb-4">
                    <h2 class="text-primary" style="color: #D4AF88 !important;">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </h2>
                </div>

                <div class="mb-4">
                    <h5>
                        <i class="bi bi-file-text me-2" style="color: #D4AF88;"></i>
                        Description
                    </h5>
                    <p class="text-muted">{{ $product->description ?? 'No description available' }}</p>
                </div>

                <div class="mb-4">
                    <h5>
                        <i class="bi bi-list-check me-2" style="color: #D4AF88;"></i>
                        Ingredients
                    </h5>
                    <p class="text-muted">{{ $product->ingredients ?? 'No ingredients listed' }}</p>
                </div>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="https://wa.me/6281332227289?text=Hi!%20I'm%20interested%20in%20{{ urlencode($product->name) }}"
                       target="_blank"
                       class="btn btn-lg px-5 shadow-sm" 
                       style="background-color: #D4AF88; color: white; border: none;">
                        <i class="bi bi-whatsapp me-2"></i>Order Now
                    </a>
                    <a href="/products" class="btn btn-outline-secondary btn-lg px-4 shadow-sm">
                        <i class="bi bi-arrow-left me-2"></i>Back to Products
                    </a>
                </div>
            </div>
        </div>

        <!-- Product Description -->
        <div class="row mt-5">
            <div class="col-12" data-aos="fade-up">
                <div class="card shadow-sm">
                    <div class="card-body" style="background-color: #F5E6D3;">
                        <h5 class="card-title mb-4">
                            <i class="bi bi-info-circle me-2" style="color: #D4AF88;"></i>
                            Product Information
                        </h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <p class="mb-0">
                                    <strong>Product ID:</strong> 
                                    <span class="badge bg-secondary ms-2">#{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p class="mb-0">
                                    <strong>Categories:</strong> 
                                    @if($product->categories->count() > 0)
                                        @foreach($product->categories as $category)
                                            <span class="badge ms-1" style="background-color: #D4AF88;">{{ $category->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">Uncategorized</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p class="mb-0">
                                    <strong>Reviews:</strong> 
                                    <span class="badge bg-info ms-2">{{ $testimoniesCount }} {{ Str::plural('review', $testimoniesCount) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials Section -->
        @if($testimoniesCount > 0)
            <div class="row mt-5">
                <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="card shadow-sm">
                        <div class="card-header" style="background: linear-gradient(135deg, #F5E6D3 0%, #E8D4B8 100%); border-bottom: 2px solid #D4AF88;">
                            <h5 class="mb-0">
                                <i class="bi bi-chat-left-quote-fill me-2" style="color: #D4AF88;"></i>
                                Customer Testimonials for {{ $product->name }}
                                <span class="badge ms-2" style="background-color: #D4AF88;">{{ $testimoniesCount }}</span>
                            </h5>
                        </div>
                        <div class="card-body" style="background-color: #F5E6D3;">
                            @foreach($productTestimonies as $testimony)
                                <div class="card mb-3 border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start mb-2">
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                                 style="width: 45px; height: 45px; flex-shrink: 0; background: linear-gradient(135deg, #D4AF88 0%, #C19A6B 100%) !important;">
                                                <i class="bi bi-person-fill fs-5 text-white"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 fw-bold" style="color: #2C2C2C;">{{ $testimony->name }}</h6>
                                                <small class="text-muted">
                                                    <i class="bi bi-calendar-check me-1"></i>
                                                    {{ $testimony->created_at->format('F j, Y') }}
                                                </small>
                                            </div>
                                            <div>
                                                <span class="badge badge-success">
                                                    <i class="bi bi-patch-check-fill me-1"></i>Verified
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ms-5 ps-3">
                                            <i class="bi bi-quote text-muted" style="font-size: 1.5rem; opacity: 0.3;"></i>
                                            <p class="mb-0 fst-italic" style="color: #4A4A4A; line-height: 1.7;">
                                                {{ $testimony->content }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row mt-5">
                <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center py-5" style="background-color: #F5E6D3;">
                            <i class="bi bi-chat-left-quote display-1 mb-3" style="color: #D4AF88; opacity: 0.3;"></i>
                            <h5 class="mb-2" style="color: #2C2C2C;">No Reviews Yet</h5>
                            <p class="text-muted mb-0">Be the first to share your experience with this product!</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@endsection