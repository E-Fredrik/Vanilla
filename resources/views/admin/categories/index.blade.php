<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="bi bi-grid-3x3-gap me-2" style="color: #D4AF88;"></i>
                    Manage Categories
                </h1>
                <p class="page-subtitle mb-0">Add, edit, or remove product categories.</p>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill me-2"></i>
                Add New Category
            </a>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Error Message -->
        @if ($errors->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <span>{{ $errors->first('error') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Categories Table -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-list-ul me-2"></i>
                All Categories ({{ $categories->total() }})
            </div>
            <div class="card-body p-0">
                @if ($categories->count() > 0)
                    <div class="table-container">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 80px;">ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th style="width: 150px;" class="text-center">Products</th>
                                    <th style="width: 150px;">Created</th>
                                    <th style="width: 200px;" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <span class="badge bg-secondary">#{{ $category->id }}</span>
                                        </td>
                                        <td>
                                            <strong class="d-block">{{ $category->name }}</strong>
                                        </td>
                                        <td>
                                            <div style="max-width: 400px;">
                                                {{ $category->description ?? 'No description' }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-primary">
                                                {{ $category->products_count }} {{ Str::plural('product', $category->products_count) }}
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $category->created_at->format('M d, Y') }}</small>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.categories.edit', $category) }}"
                                                    class="btn btn-sm btn-primary" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.categories.destroy', $category) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                                        {{ $category->products_count > 0 ? 'disabled' : '' }}>
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
                                Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of
                                {{ $categories->total() }} categories
                            </div>
                            <div>
                                {{ $categories->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-inbox empty-state-icon"></i>
                        <h3 class="empty-state-title">No Categories Found</h3>
                        <p class="empty-state-text">Start by adding your first category.</p>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>
                            Add Your First Category
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>