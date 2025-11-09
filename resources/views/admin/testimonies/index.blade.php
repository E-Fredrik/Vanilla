<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="page-title">
                <i class="bi bi-chat-left-quote me-2" style="color: #D4AF88;"></i>
                Manage Testimonies
            </h1>
            <p class="page-subtitle mb-0">Review and moderate customer testimonies.</p>
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

        <!-- Testimonies Table -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-list-ul me-2"></i>
                All Testimonies ({{ $testimonies->total() }})
            </div>
            <div class="card-body p-0">
                @if ($testimonies->count() > 0)
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 80px;">ID</th>
                                    <th>Name</th>
                                    <th>Product</th>
                                    <th>Content</th>
                                    <th style="width: 100px;">Status</th>
                                    <th style="width: 150px;">Date</th>
                                    <th style="width: 250px;" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testimonies as $testimony)
                                    <tr>
                                        <td>
                                            <span class="badge bg-secondary">#{{ $testimony->id }}</span>
                                        </td>
                                        <td>
                                            <strong>{{ $testimony->name }}</strong>
                                            @if($testimony->email)
                                                <br><small class="text-muted">{{ $testimony->email }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($testimony->product)
                                                <span class="badge" style="background-color: #D4AF88;">
                                                    {{ $testimony->product->name }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">General</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div style="max-width: 300px;">
                                                {{ Str::limit($testimony->content, 100) }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($testimony->status === 'approved')
                                                <span class="badge bg-success">Approved</span>
                                            @elseif($testimony->status === 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @else
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small>{{ $testimony->created_at->format('M d, Y') }}</small>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                @if($testimony->status !== 'approved')
                                                    <form action="{{ route('admin.testimonies.approve', $testimony) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success" title="Approve">
                                                            <i class="bi bi-check-circle"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                @if($testimony->status !== 'rejected')
                                                    <form action="{{ route('admin.testimonies.reject', $testimony) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-warning" title="Reject">
                                                            <i class="bi bi-x-circle"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                <form action="{{ route('admin.testimonies.destroy', $testimony) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this testimony?');">
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
                                Showing {{ $testimonies->firstItem() }} to {{ $testimonies->lastItem() }} of
                                {{ $testimonies->total() }} testimonies
                            </div>
                            <div>
                                {{ $testimonies->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-inbox empty-state-icon"></i>
                        <h3 class="empty-state-title">No Testimonies Yet</h3>
                        <p class="empty-state-text">Customer testimonies will appear here.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>