<x-app-layout>
    <div class="container py-5">
        
        <div class="row mb-4">
            <div class="col-12">
                <div class="p-4 rounded-3 shadow-sm d-flex align-items-center justify-content-between" style="background-color: #ECFAE5; border: 1px solid #B0DB9C;">
                    <div>
                        <h2 class="fw-bold text-dark m-0">Inventaris Dasbor</h2>
                        <p class="text-muted m-0">Selamat datang kembali, Admin! Berikut ringkasan kondisi inventaris Anda.</p>
                    </div>
                    <i class="fas fa-chart-line fa-3x" style="color: #8AB973;"></i>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card card-modern h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Total SAPRAS</h6>
                            <h2 class="fw-bold text-dark m-0">{{ $totalProducts }}</h2>
                        </div>
                        <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-box text-primary fs-4"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 rounded-bottom-4">
                        <a href="{{ route('admin.products.index') }}" class="small text-decoration-none fw-bold text-primary">
                            View Inventory <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-modern h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Kategori</h6>
                            <h2 class="fw-bold text-dark m-0">{{ $totalCategories }}</h2>
                        </div>
                        <div class="rounded-circle bg-warning bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-tags text-warning fs-4"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 rounded-bottom-4">
                        <a href="{{ route('admin.categories.index') }}" class="small text-decoration-none fw-bold text-warning">
                            Manage Categories <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-modern h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Pengguna</h6>
                            <h2 class="fw-bold text-dark m-0">{{ $totalUsers }}</h2>
                        </div>
                        <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-users text-success fs-4"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 rounded-bottom-4">
                        <a href="{{ route('admin.users.index') }}" class="small text-decoration-none fw-bold text-success">
                            Manage Users <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

           
            
            
            <div class="col-md-3">
                <div class="card card-modern h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Laporan Menunggu</h6>
                            <h2 class="fw-bold text-dark m-0">{{ $pendingReportsCount ?? 0 }}</h2>
                        </div>
                        <div class="rounded-circle bg-info bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-file-alt text-info fs-4"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 rounded-bottom-4">
                        <a href="{{ route('admin.reports.index') }}" class="small text-decoration-none fw-bold text-info">
                            Lihat Laporan <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

      

</x-app-layout>