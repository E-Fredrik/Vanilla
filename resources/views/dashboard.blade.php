<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="page-title">
                <i class="bi bi-speedometer2 me-2" style="color: #D4AF88;"></i>
                Dashboard
            </h1>
            <p class="page-subtitle mb-0">Welcome back, {{ Auth::user()->name }}! Here's what's happening with your bakery.</p>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="stat-card">
                    <div class="stat-icon primary">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <h3 class="stat-value">{{ \App\Models\Product::count() }}</h3>
                    <p class="stat-label">Total Products</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-primary mt-3">
                        <i class="bi bi-eye me-2"></i>View All Products
                    </a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="stat-card">
                    <div class="stat-icon success">
                        <i class="bi bi-grid-3x3-gap"></i>
                    </div>
                    <h3 class="stat-value">{{ \App\Models\Category::count() }}</h3>
                    <p class="stat-label">Product Categories</p>
                    <div class="mt-3">
                        @foreach(\App\Models\Category::withCount('products')->get() as $category)
                            <span class="badge me-1 mb-1" style="background-color: #D4AF88;">
                                {{ $category->name }} ({{ $category->products_count }})
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Products -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>
                            <i class="bi bi-clock-history me-2"></i>
                            Recent Products
                        </span>
                        <a href="{{ route('admin.products.index') }}" class="text-decoration-none" style="color: #D4AF88;">
                            View All <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        @php
                            $recentProducts = \App\Models\Product::with('categories')->latest()->take(5)->get();
                        @endphp

                        @if($recentProducts->count() > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Categories</th>
                                            <th>Price</th>
                                            <th>Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentProducts as $product)
                                            <tr>
                                                <td>
                                                    @if($product->imagePath && Storage::disk('public')->exists($product->imagePath))
                                                        <img src="{{ asset('storage/' . $product->imagePath) }}" 
                                                             alt="{{ $product->name }}" 
                                                             class="product-image-thumb">
                                                    @else
                                                        <div class="product-image-thumb d-flex align-items-center justify-content-center" 
                                                             style="background: linear-gradient(135deg, #F5E6D3 0%, #E8D4B8 100%);">
                                                            <i class="bi bi-image" style="color: #D4AF88;"></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $product->name }}</strong>
                                                </td>
                                                <td>
                                                    @foreach($product->categories as $category)
                                                        <span class="badge badge-primary me-1">{{ $category->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                                <td>{{ $product->created_at->diffForHumans() }}</td>
                                                <td>
                                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                                       class="btn btn-sm btn-primary">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="bi bi-inbox empty-state-icon"></i>
                                <h3 class="empty-state-title">No Products Yet</h3>
                                <p class="empty-state-text">Get started by adding your first product!</p>
                                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    Add Product
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
