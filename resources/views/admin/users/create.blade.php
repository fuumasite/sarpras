<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-plus text-primary me-2 fs-4"></i>
                            <h5 class="fw-bold m-0 text-dark">Add New User</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.users.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Full Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-secondary"><i class="fas fa-user"></i></span>
                                    <input type="text" name="name" class="form-control" placeholder="Misal Binggie Rashel " required autofocus>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Email Address <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-secondary"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="user@example.com" required>
                                </div>
                            </div>

                            <h6 class="text-muted small fw-bold text-uppercase mb-3">Security</h6>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-secondary"><i class="fas fa-lock"></i></span>
                                        <input type="password" name="password" class="form-control" placeholder="Create password" required>
                                        <span class="input-group-text bg-white">
                                            <i class="fas fa-eye toggle-password text-muted" style="cursor: pointer;"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">Confirm Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-secondary"><i class="fas fa-check-circle"></i></span>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password" required>
                                        <span class="input-group-text bg-white">
                                            <i class="fas fa-eye toggle-password text-muted" style="cursor: pointer;"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 pt-2">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-light text-muted border d-inline-flex align-items-center justify-content-center" style="min-width: 100px;">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary px-4 text-white d-inline-flex align-items-center justify-content-center" style="min-width: 140px;">
                                    Create User
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>