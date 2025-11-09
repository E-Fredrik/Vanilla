<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="page-title">
                <i class="bi bi-plus-circle me-2" style="color: #D4AF88;"></i>
                Create New Product
            </h1>
            <p class="page-subtitle mb-0">Add a new product to your bakery inventory.</p>
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
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label">
                                    <i class="bi bi-tag me-2"></i>Product Name *
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name') }}" 
                                       required 
                                       placeholder="e.g., Chocolate Croissant">
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
                                          class="form-control @error('description') is-invalid @enderror" 
                                          placeholder="Describe your product in detail...">{{ old('description') }}</textarea>
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
                                       value="{{ old('price') }}" 
                                       required 
                                       min="0" 
                                       step="100"
                                       placeholder="10000">
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
                                          class="form-control @error('ingredients') is-invalid @enderror"
                                          placeholder="Flour, sugar, butter, eggs...">{{ old('ingredients') }}</textarea>
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
                                    @foreach(\App\Models\Category::all() as $category)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   name="categories[]" 
                                                   value="{{ $category->id }}" 
                                                   id="category{{ $category->id }}"
                                                   {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
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

                            <!-- Image Upload with Icon Indicator -->
                            <div class="mb-4">
                                <label for="image" class="form-label">
                                    <i class="bi bi-image me-2"></i>Product Image
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
                                        Choose Image
                                    </button>

                                    <div id="imageStatus" class="d-flex align-items-center">
                                        <span class="text-muted">
                                            <i class="bi bi-info-circle me-2"></i>
                                            No image selected
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
                                    Create Product
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
                const fileSize = (file.size / 1024 / 1024).toFixed(2); // Convert to MB
                
                statusDiv.innerHTML = `
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill text-success fs-5"></i>
                        <div>
                            <strong class="text-success">Image Selected</strong>
                            <small class="text-muted d-block">${fileName} (${fileSize} MB)</small>
                        </div>
                    </div>
                `;
            } else {
                statusDiv.innerHTML = `
                    <span class="text-muted">
                        <i class="bi bi-info-circle me-2"></i>
                        No image selected
                    </span>
                `;
            }
        }
    </script>
</x-app-layout>