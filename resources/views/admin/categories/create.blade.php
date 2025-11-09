<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="page-title">
                <i class="bi bi-plus-circle me-2" style="color: #D4AF88;"></i>
                Create New Category
            </h1>
            <p class="page-subtitle mb-0">Add a new product category to organize your bakery items.</p>
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
                        <form action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf

                            <!-- Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label">
                                    <i class="bi bi-tag me-2"></i>Category Name *
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name') }}" 
                                       required
                                       placeholder="e.g., Cakes, Pastries, Breads">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Choose a unique, descriptive name for this category.</small>
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
                                          placeholder="Describe what types of products belong in this category...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Optional. Help customers understand what's in this category.</small>
                            </div>

                            <!-- Example Preview -->
                            <div class="alert alert-info">
                                <i class="bi bi-lightbulb me-2"></i>
                                <strong>Category Examples:</strong>
                                <ul class="mb-0 mt-2">
                                    <li><strong>Cakes:</strong> Delicious and beautifully decorated cakes for all occasions.</li>
                                    <li><strong>Pastries:</strong> A variety of flaky and buttery pastries to satisfy your cravings.</li>
                                    <li><strong>Breads:</strong> Freshly baked breads with a perfect crust and soft interior.</li>
                                </ul>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-3 justify-content-end">
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-circle me-2"></i>
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Create Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>