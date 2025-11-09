@extends('layouts.layout')
@section('title', 'Home - Vanilla Bakery')
@section('content')
    <link rel="stylesheet" href="css/home.css">

    <!-- Jumbotron Hero -->
    <div class="jumbotron mb-0">
        <div class="jumbotron-content container">
            <h1 class="display-1 fw-bold mb-4 animate__animated animate__fadeInDown">Vanilla Bakery</h1>
            <p class="lead fs-3 mb-4 animate__animated animate__fadeInUp">Wisata Bukit Mas C4-18</p>
            <a href="/products"
                class="btn btn-lg px-5 py-3 rounded-pill shadow-lg animate__animated animate__fadeInUp animate__delay-1s"
                style="background-color: #D4AF88; color: white; border: none; transition: all 0.3s ease;">
                <i class="bi bi-basket2-fill me-2"></i>Explore Our Products
            </a>
        </div>
    </div>

    <div class="container my-5">
        <!-- Featured Products Carousel Section -->
        <div class="row mb-5">
            <div class="col-12 text-center mb-5">
                <span class="badge rounded-pill px-4 py-2 mb-3" style="background-color: #D4AF88; font-size: 0.9rem;">
                    <i class="bi bi-star-fill me-2"></i>Featured Collection
                </span>
                <h2 class="display-5 fw-bold mb-3" style="font-family: Georgia, serif; color: #2C2C2C;">
                    Our Specialties
                </h2>
                <p class="lead text-muted">Discover our most popular baked goods</p>
            </div>

            <div class="col-12">
                <div id="featuredProductsCarousel" class="carousel slide carousel-fade shadow-lg rounded-4 overflow-hidden"
                    data-bs-ride="carousel" data-bs-interval="5000">
                    <!-- Carousel Indicators -->
                    <div class="carousel-indicators mb-4">
                        @foreach ($featuredProducts as $index => $product)
                            <button type="button" data-bs-target="#featuredProductsCarousel"
                                data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                                aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}">
                            </button>
                        @endforeach
                    </div>

                    <!-- Carousel Inner -->
                    <div class="carousel-inner">
                        @foreach ($featuredProducts as $index => $product)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="row g-0 align-items-stretch">
                                    <!-- Product Image Side -->
                                    <div class="col-md-6 position-relative overflow-hidden"
                                        style="background: linear-gradient(135deg, #F5E6D3 0%, #E8D4B8 100%);">
                                        
                                        <!-- Fixed height container -->
                                        <div class="d-flex align-items-center justify-content-center position-relative" 
                                             style="height: 500px;">
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
                                                         class="w-100 h-100 carousel-product-image" 
                                                         alt="{{ $product->name }}"
                                                         style="object-fit: cover;">
                                                @else
                                                    <i class="bi bi-image display-1" style="color: #D4AF88;"></i>
                                                @endif
                                            @else
                                                <i class="bi bi-image display-1" style="color: #D4AF88;"></i>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Product Info Side -->
                                    <div class="col-md-6 d-flex align-items-center bg-white">
                                        <div class="p-4 p-lg-5 w-100">
                                            <span class="badge bg-light text-dark border mb-3 px-3 py-2">
                                                <i class="bi bi-award-fill me-2" style="color: #D4AF88;"></i>Premium Quality
                                            </span>

                                            <h3 class="display-6 fw-bold mb-3 mb-lg-4"
                                                style="color: #2C2C2C; font-family: Georgia, serif;">
                                                {{ $product->name }}
                                            </h3>

                                            <p class="text-muted mb-3 mb-lg-4 fs-6 fs-lg-5" style="line-height: 1.8;">
                                                {{ $product->description }}
                                            </p>

                                            <!-- Price Section -->
                                            <div class="d-flex align-items-center mb-3 mb-lg-4 p-3 rounded-3 bg-light">
                                                <div class="flex-grow-1">
                                                    <small class="text-muted d-block mb-1">Starting from</small>
                                                    <h4 class="mb-0 fw-bold" style="color: #D4AF88;">
                                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                                    </h4>
                                                </div>
                                            </div>

                                            <!-- Action Buttons -->
                                            <div class="d-grid gap-2 d-sm-flex gap-sm-3">
                                                <a href="/products/{{ $product->id }}"
                                                    class="btn btn-lg px-4 px-lg-5 shadow"
                                                    style="background-color: #D4AF88; color: white; border: none;">
                                                    <i class="bi bi-eye-fill me-2"></i>View Details
                                                </a>
                                                <a href="https://wa.me/6281332227289?text=Hi!%20I'm%20interested%20in%20{{ urlencode($product->name) }}"
                                                    target="_blank"
                                                    class="btn btn-outline-success btn-lg px-4 px-lg-5 shadow-sm">
                                                    <i class="bi bi-whatsapp me-2"></i>Order Now
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#featuredProductsCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon rounded-circle shadow-lg p-3 p-lg-4"
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#featuredProductsCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon rounded-circle shadow-lg p-3 p-lg-4"
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Testimonial Section -->
        <div class="row mb-5">
            <div class="col-12 text-center mb-4">
                <span class="badge rounded-pill px-4 py-2 mb-3" style="background-color: #D4AF88; font-size: 0.9rem;">
                    <i class="bi bi-chat-quote-fill me-2"></i>Testimonials
                </span>
                <h2 class="display-5 fw-bold mb-3" style="font-family: Georgia, serif; color: #2C2C2C;">
                    What Our Customers Say
                </h2>
                <p class="lead text-muted">Hear from our satisfied customers</p>
            </div>

            <div class="col-12">
                <!-- Bootstrap Carousel with improved spacing -->
                <div id="testimonialsCarousel" class="carousel slide position-relative" 
                     data-bs-ride="carousel" data-bs-interval="3000"
                     style="padding: 2rem 0 3.5rem 0;"> <!-- Added padding for arrows and indicators -->
                    
                    <!-- Carousel Inner -->
                    <div class="carousel-inner">
                        @foreach ($testimonies as $index => $testimony)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8 col-md-10">
                                            <div class="card border-0 shadow-lg testimonial-card">
                                                <div class="card-body p-4 p-lg-5 text-center">
                                                    <div class="mb-4">
                                                        <i class="bi bi-quote text-muted"
                                                            style="font-size: 3rem; opacity: 0.3;"></i>
                                                    </div>
                                                    <p class="lead mb-4"
                                                        style="color: #4A4A4A; line-height: 1.8; font-size: 1.25rem;">
                                                        "{{ $testimony->content }}"
                                                    </p>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                                            style="width: 60px; height: 60px;">
                                                            <i class="bi bi-person-fill fs-3" style="color: #D4AF88;"></i>
                                                        </div>
                                                        <div class="text-start">
                                                            <h5 class="mb-0 fw-bold">{{ $testimony->name }}</h5>
                                                            <small class="text-muted">Verified Customer</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Carousel Controls - Smaller Arrows -->
                    <button class="carousel-control-prev testimonial-control-prev" 
                            type="button" 
                            data-bs-target="#testimonialsCarousel"
                            data-bs-slide="prev">
                        <span class="d-flex align-items-center justify-content-center" 
                              aria-hidden="true">
                            <i class="bi bi-chevron-left text-white"></i>
                        </span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next testimonial-control-next" 
                            type="button" 
                            data-bs-target="#testimonialsCarousel"
                            data-bs-slide="next">
                        <span class="d-flex align-items-center justify-content-center" 
                              aria-hidden="true">
                            <i class="bi bi-chevron-right text-white"></i>
                        </span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    
                    <!-- Carousel Indicators -->
                    <div class="carousel-indicators">
                        @foreach ($testimonies as $index => $testimony)
                            <button type="button" 
                                    data-bs-target="#testimonialsCarousel"
                                    data-bs-slide-to="{{ $index }}" 
                                    class="{{ $index === 0 ? 'active' : '' }}"
                                    aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                    aria-label="Slide {{ $index + 1 }}">
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Location & Contact Section -->
        <div id="contact" class="row mb-5">
            <div class="col-12 text-center mb-5">
                <span class="badge rounded-pill px-4 py-2 mb-3" style="background-color: #D4AF88; font-size: 0.9rem;">
                    <i class="bi bi-geo-alt-fill me-2"></i>Find Us
                </span>
                <h2 class="display-5 fw-bold mb-3" style="font-family: Georgia, serif; color: #2C2C2C;">
                    Visit Us
                </h2>
                <p class="lead text-muted">Find us at Jl. Raya Balongpanggang No.26</p>
            </div>

            <div class="col-lg-6 mb-4">
                <!-- Google Maps Embed -->
                <div class="card border-0 shadow-sm h-100 overflow-hidden contact-card-no-hover">
                    <iframe class="w-100 h-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.7620773419703!2d112.44515921144023!3d-7.267894071383989!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e780343f0176b45%3A0x5f8f719cff1cf5ed!2sJl.%20Raya%20Balongpanggang%20No.26%2C%20Wates%2C%20Kedungpring%2C%20Kec.%20Balongpanggang%2C%20Kabupaten%20Gresik%2C%20Jawa%20Timur%2061173!5e0!3m2!1sen!2sid!4v1760154177435!5m2!1sen!2sid"
                        style="border:0; min-height: 450px;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm h-100 contact-card-no-hover">
                    <div class="card-body p-4 p-lg-5 d-flex flex-column justify-content-center"
                        style="background: linear-gradient(135deg, #F5E6D3 0%, #E8D4B8 100%);">

                        <h3 class="fw-bold mb-4" style="color: #2C2C2C; font-family: Georgia, serif;">
                            Get In Touch
                        </h3>

                        <!-- Address -->
                        <div class="d-flex mb-4 p-3 bg-white rounded-3 shadow-sm contact-info-item">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px; background-color: #D4AF88;">
                                    <i class="bi bi-geo-alt-fill fs-5 text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-bold mb-2" style="color: #2C2C2C;">Address</h6>
                                <p class="mb-0 text-muted">
                                    Jl. Raya Balongpanggang No.26<br>
                                    Gresik, Indonesia
                                </p>
                            </div>
                        </div>

                        <!-- Operating Hours -->
                        <div class="d-flex mb-4 p-3 bg-white rounded-3 shadow-sm contact-info-item">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px; background-color: #D4AF88;">
                                    <i class="bi bi-clock-fill fs-5 text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-bold mb-2" style="color: #2C2C2C;">Operating Hours</h6>
                                <p class="mb-0 text-muted">
                                    Monday - Saturday: 8:00 AM - 8:00 PM<br>
                                    Sunday: 9:00 AM - 6:00 PM
                                </p>
                            </div>
                        </div>

                        <!-- Social Media Buttons -->
                        <div class="d-flex mb-3 p-3 bg-white rounded-3 shadow-sm contact-info-item">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px; background-color: #D4AF88;">
                                    <i class="bi bi-chat-dots-fill fs-5 text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-bold mb-3" style="color: #2C2C2C;">Contact Us</h6>
                                <div class="d-grid gap-2">
                                    <a href="https://wa.me/6281332227289?text=Hallo!%20Saya%20ingin%20memesan%20produk%20Vanilla%20Bakery"
                                        target="_blank"
                                        class="btn btn-hover d-flex align-items-center justify-content-center gap-2 shadow-sm"
                                        style="background-color: #D4AF88; border: none;">
                                        <i class="bi bi-whatsapp fs-5 text-white"></i>
                                        <span class="fw-medium text-white">WhatsApp Us</span>
                                    </a>
                                    <a href="https://www.instagram.com/vanillabakery777" target="_blank"
                                        class="btn btn-hover d-flex align-items-center justify-content-center gap-2 shadow-sm"
                                        style="background-color: #D4AF88; border: none;">
                                        <i class="bi bi-instagram fs-5 text-white"></i>
                                        <span class="fw-medium text-white">Follow Us</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
