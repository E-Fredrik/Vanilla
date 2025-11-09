<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="page-title">
                <i class="bi bi-pencil-square me-2" style="color: #D4AF88;"></i>
                Edit Product
            </h1>
            <p class="page-subtitle mb-0">Update product information for: <strong>{{ $product->name }}</strong></p>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-info-circle me-2"></i>
                        Product Information
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label">
                                    <i class="bi bi-tag me-2"></i>Product Name *
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $product->name) }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <label for="description" class="form-label">
                                    <i class="bi bi-text-paragraph me-2"></i>Description
                                </label>
                                <textarea name="description" 
                                          id="description" 
                                          rows="4" 
                                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="mb-4">
                                <label for="price" class="form-label">
                                    <i class="bi bi-currency-dollar me-2"></i>Price (Rp) *
                                </label>
                                <input type="number" 
                                       name="price" 
                                       id="price" 
                                       class="form-control @error('price') is-invalid @enderror" 
                                       value="{{ old('price', $product->price) }}" 
                                       required 
                                       min="0" 
                                       step="100">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Ingredients -->
                            <div class="mb-4">
                                <label for="ingredients" class="form-label">
                                    <i class="bi bi-egg me-2"></i>Ingredients
                                </label>
                                <textarea name="ingredients" 
                                          id="ingredients" 
                                          rows="3" 
                                          class="form-control @error('ingredients') is-invalid @enderror">{{ old('ingredients', $product->ingredients) }}</textarea>
                                @error('ingredients')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category Selection -->
                            <div class="mb-4">
                                <label for="categories" class="form-label">
                                    <i class="bi bi-grid-3x3-gap me-2"></i>Categories *
                                </label>
                                <div class="border rounded p-3" style="background-color: #f8f9fa;">
                                    @foreach($categories as $category)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   name="categories[]" 
                                                   value="{{ $category->id }}" 
                                                   id="category{{ $category->id }}"
                                                   {{ in_array($category->id, old('categories', $product->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="category{{ $category->id }}">
                                                <strong>{{ $category->name }}</strong>
                                                <small class="text-muted d-block">{{ $category->description }}</small>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('categories')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Select at least one category for this product.</small>
                            </div>

                            <!-- Current Image Status -->
                            @if ($product->imagePath && Storage::disk('public')->exists($product->imagePath))
                                <div class="mb-4">
                                    <label class="form-label">
                                        <i class="bi bi-image-fill me-2"></i>Current Image
                                    </label>
                                    <div class="d-flex align-items-center gap-2 p-3 border rounded" style="background-color: #f8f9fa;">
                                        <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                        <div>
                                            <strong class="text-success">Image Uploaded</strong>
                                            <small class="text-muted d-block">{{ basename($product->imagePath) }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Replace Image Upload -->
                            <div class="mb-4">
                                <label for="image" class="form-label">
                                    <i class="bi bi-image me-2"></i>{{ $product->imagePath ? 'Replace Image (Optional)' : 'Add Image' }}
                                </label>
                                <div class="d-flex align-items-center gap-3">
                                    <input type="file" 
                                           name="image" 
                                           id="image" 
                                           class="d-none @error('image') is-invalid @enderror" 
                                           accept="image/*"
                                           onchange="handleImageSelect(event)">
                                    
                                    <button type="button" 
                                            class="btn btn-primary" 
                                            onclick="document.getElementById('image').click()">
                                        <i class="bi bi-upload me-2"></i>
                                        Choose New Image
                                    </button>
                                    
                                    <div id="imageStatus" class="d-flex align-items-center">
                                        <span class="text-muted">
                                            <i class="bi bi-info-circle me-2"></i>
                                            No new image selected
                                        </span>
                                    </div>
                                </div>
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="text-muted d-block mt-2">PNG, JPG, GIF up to 2MB</small>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-3 justify-content-end">
                                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-circle me-2"></i>
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Update Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function handleImageSelect(event) {
            const file = event.target.files[0];
            const statusDiv = document.getElementById('imageStatus');
            
            if (file) {
                const fileName = file.name;
                const fileSize = (file.size / 1024 / 1024).toFixed(2);
                
                statusDiv.innerHTML = `
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill text-success fs-5"></i>
                        <div>
                            <strong class="text-success">New Image Selected</strong>
                            <small class="text-muted d-block">${fileName} (${fileSize} MB)</small>
                        </div>
                    </div>
                `;
            } else {
                statusDiv.innerHTML = `
                    <span class="text-muted">
                        <i class="bi bi-info-circle me-2"></i>
                        No new image selected
                    </span>
                `;
            }
        }
    </script>
</x-app-layout>