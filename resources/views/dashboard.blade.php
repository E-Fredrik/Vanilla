<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            <div>
                <h1 class="page-title mb-2 mb-md-0">
                    <i class="bi bi-speedometer2 me-2" style="color: #D4AF88;"></i>
                    Dashboard
                </h1>
                <p class="page-subtitle mb-0 d-none d-md-block">Welcome back, {{ Auth::user()->name }}! Here's what's happening with your bakery.</p>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Stats Cards -->
        <div class="row g-3 g-md-4 mb-4 mb-md-5">
            <div class="col-12 col-sm-6 col-lg-6">
                <div class="stat-card">
                    <div class="stat-icon primary">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <h3 class="stat-value">{{ $stats['totalProducts'] }}</h3>
                    <p class="stat-label">Total Products</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-primary mt-3 w-100 w-md-auto">
                        <i class="bi bi-eye me-2"></i>View All Products
                    </a>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-6">
                <div class="stat-card">
                    <div class="stat-icon success">
                        <i class="bi bi-grid-3x3-gap"></i>
                    </div>
                    <h3 class="stat-value">{{ $stats['totalCategories'] }}</h3>
                    <p class="stat-label">Categories</p>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-success mt-3 w-100 w-md-auto">
                        <i class="bi bi-eye me-2"></i>Manage Categories
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Products -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                        <span>
                            <i class="bi bi-clock-history me-2"></i>
                            Recent Products
                        </span>
                        <a href="{{ route('admin.products.index') }}" class="text-decoration-none" style="color: #D4AF88;">
                            View All <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        @if($recentProducts->count() > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="d-none d-md-table-cell">Image</th>
                                            <th>Name</th>
                                            <th class="d-none d-lg-table-cell">Categories</th>
                                            <th>Price</th>
                                            <th class="d-none d-xl-table-cell">Created</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentProducts as $product)
                                            <tr>
                                                <td class="d-none d-md-table-cell">
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
                                                    <strong class="d-block">{{ $product->name }}</strong>
                                                    <small class="text-muted d-md-none">Rp {{ number_format($product->price, 0, ',', '.') }}</small>
                                                </td>
                                                <td class="d-none d-lg-table-cell">
                                                    @foreach($product->categories as $category)
                                                        <span class="badge badge-primary me-1 mb-1">{{ $category->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td class="d-none d-md-table-cell">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                                <td class="d-none d-xl-table-cell">
                                                    <small>{{ $product->created_at->diffForHumans() }}</small>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                                       class="btn btn-sm btn-primary">
                                                        <i class="bi bi-pencil"></i>
                                                        <span class="d-none d-lg-inline ms-1">Edit</span>
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
