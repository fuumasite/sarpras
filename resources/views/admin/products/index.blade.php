<x-app-layout>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark m-0">Inventaris Sarana dan Prasarana</h3>
                <small class="text-muted">Kelola semua Inventaris Sarana dan Prasarana</small>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.export.inventory') }}" class="btn btn-primary border d-inline-flex align-items-center justify-content-center shadow-sm px-4" target="_blank">
                    <i class="fas fa-file-pdf me-2"></i> Export PDF
                </a>

                <a href="{{ route('admin.products.create') }}" class="btn btn-primary shadow-sm px-4">
                    <i class="fas fa-plus me-2"></i> Add
                </a>
            </div>
        </div>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4">
                <table class="table table-hover align-middle datatable" style="width:100%">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 px-3 small fw-bold text-muted text-center" style="width: 7%;">#</th>
                            <th class="py-3 px-3 small fw-bold text-muted">Products</th>
                            <th class="py-3 px-3 small fw-bold text-muted">Description</th>
                            <th class="py-3 px-3 small fw-bold text-muted text-center">Category</th>
                            <th class="py-3 px-3 small fw-bold text-muted text-center">Stock</th>
                            <th class="py-3 px-3 small fw-bold text-muted text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="px-3 fw-bold text-secondary text-center">{{ $loop->iteration }}</td>
                                <td class="px-3">
                                    <div class="d-flex align-items-center">
                                        @if($product->image_path)
                                            <img src="{{ asset('storage/' . $product->image_path) }}" class="rounded border me-3" width="40" height="40" style="object-fit: cover;">
                                        @else
                                            <div class="rounded border me-3 bg-light d-flex align-items-center justify-content-center text-muted" style="width: 40px; height: 40px;">
                                                <i class="fas fa-box"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-bold small text-dark">{{ $product->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 text-muted small" style="max-width: 200px;">
                                    <div class="text-truncate" title="{{ $product->description }}">
                                        {{ Str::limit($product->description, 100) }} 
                                    </div>
                                </td>
                                <td class="px-3 text-center">
                                    <span class="badge bg-light text-dark border">{{ $product->category->name ?? 'Tidak Dikategorikan' }}</span>
                                <td class="px-3 text-center">
                                    @if($product->quantity <= 10)
                                        <span class="badge bg-danger">Rendah: {{ $product->quantity }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $product->quantity }}</span>
                                    @endif
                                </td>
                                <td class="px-3 text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-light text-primary border me-2 rounded" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?');">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-light text-danger border rounded" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>