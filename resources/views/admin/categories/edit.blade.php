<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="page-title">
                <i class="bi bi-pencil-square me-2" style="color: #D4AF88;"></i>
                Edit Category
            </h1>
            <p class="page-subtitle mb-0">Update category information for: <strong>{{ $category->name }}</strong></p>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-info-circle me-2"></i>
                        Category Information
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label">
                                    <i class="bi bi-tag me-2"></i>Category Name *
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $category->name) }}" 
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
                                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category Stats -->
                            <div class="alert alert-light border">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-info-circle me-2" style="color: #D4AF88;"></i>
                                        <strong>Category Statistics</strong>
                                    </div>
                                    <div>
                                        <span class="badge bg-primary">
                                            {{ $category->products_count }} {{ Str::plural('product', $category->products_count) }}
                                        </span>
                                    </div>
                                </div>
                                @if($category->products_count > 0)
                                    <small class="text-muted d-block mt-2">
                                        This category is currently assigned to {{ $category->products_count }} product(s).
                                    </small>
                                @endif
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-3 justify-content-end">
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-circle me-2"></i>
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Update Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>