<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="bi bi-box-seam me-2" style="color: #D4AF88;"></i>
                    Manage Products
                </h1>
                <p class="page-subtitle mb-0">Add, edit, or remove products from your bakery inventory.</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i>
                Add New Product
            </a>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Products Table -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-list-ul me-2"></i>
                All Products ({{ $products->total() }})
            </div>
            <div class="card-body p-0">
                @if ($products->count() > 0)
                    <div class="table-container">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 80px;">Image</th>
                                    <th>Name</th>
                                    <th>Categories</th>
                                    <th style="width: 150px;">Price</th>
                                    <th>Description</th>
                                    <th style="width: 200px;" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            @if ($product->imagePath)
                                                @php
                                                    // Remove any path prefixes
                                                    $imageName = basename($product->imagePath);
                                                    
                                                    // Check storage location first
                                                    if(Storage::disk('public')->exists('images/' . $imageName)) {
                                                        $imageSrc = asset('storage/images/' . $imageName);
                                                    } 
                                                    // Then check public directory
                                                    elseif(file_exists(public_path('images/' . $imageName))) {
                                                        $imageSrc = asset('images/' . $imageName);
                                                    } 
                                                    else {
                                                        $imageSrc = null;
                                                    }
                                                @endphp
                                                
                                                @if($imageSrc)
                                                    <img src="{{ $imageSrc }}"
                                                        alt="{{ $product->name }}" class="product-image-thumb">
                                                @else
                                                    <div class="product-image-thumb d-flex align-items-center justify-content-center"
                                                        style="background: linear-gradient(135deg, #F5E6D3 0%, #E8D4B8 100%);">
                                                        <i class="bi bi-image" style="color: #D4AF88;"></i>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="product-image-thumb d-flex align-items-center justify-content-center"
                                                    style="background: linear-gradient(135deg, #F5E6D3 0%, #E8D4B8 100%);">
                                                    <i class="bi bi-image" style="color: #D4AF88;"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong class="d-block">{{ $product->name }}</strong>
                                            <small class="text-muted">ID:
                                                #{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</small>
                                        </td>
                                        <td>
                                            @foreach ($product->categories as $category)
                                                <span class="badge badge-primary me-1 mb-1">{{ $category->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td>
                                            <div style="max-width: 300px;">
                                                {{ Str::limit($product->description, 80) }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('products.show', $product->id) }}"
                                                    class="btn btn-sm btn-secondary" target="_blank" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.products.edit', $product) }}"
                                                    class="btn btn-sm btn-primary" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.products.destroy', $product) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="p-3 border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">
                                Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of
                                {{ $products->total() }} products
                            </div>
                            <div>
                                {{ $products->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-inbox empty-state-icon"></i>
                        <h3 class="empty-state-title">No Products Found</h3>
                        <p class="empty-state-text">Start by adding your first product to the inventory.</p>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>
                            Add Your First Product
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
