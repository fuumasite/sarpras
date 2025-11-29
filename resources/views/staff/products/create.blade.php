<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-plus-circle text-primary me-2 fs-4"></i>
                            <h5 class="fw-bold m-0 text-dark">Add New Product (User)</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('staff.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Product Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-secondary"><i class="fas fa-box"></i></span>
                                    <input type="text" name="name" class="form-control" placeholder="e.g. Wireless Mouse" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">Category <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-secondary"><i class="fas fa-list"></i></span>
                                        <select name="category_id" class="form-select" required>
                                            <option value="" disabled selected>Select...</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">Stock <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-secondary"><i class="fas fa-cubes"></i></span>
                                        <input type="number" name="quantity" class="form-control" placeholder="0" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-muted">Description</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Enter product details, features, or specifications..."></textarea>
                            </div>

                            <div class="d-flex justify-content-end gap-2 pt-2">
                                <a href="{{ route('dashboard') }}" class="btn btn-light text-muted border d-inline-flex align-items-center justify-content-center" style="min-width: 100px;">Cancel</a>
                                <button type="submit" class="btn btn-primary px-4 text-white d-inline-flex align-items-center justify-content-center" style="min-width: 140px;">Save Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>