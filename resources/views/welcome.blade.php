<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'StockSync') }}</title>

        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/9431/9431186.png" type="image/png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        @vite(['resources/css/app.scss', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    </head>
    
    <body class="d-flex flex-column min-vh-100 bg-light">

        <main class="flex-grow-1">
            
            <div class="hero-wrapper">
                <div class="blob blob-1"></div>
                <div class="blob blob-2"></div>

                <nav class="navbar navbar-expand-lg fixed-top glass-nav">
                    <div class="container">
                        <a class="navbar-brand fw-bold text-dark d-flex align-items-center gap-2" href="#">
                            <div class="bg-success bg-opacity-10 rounded-3 p-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-university text-success"></i>
                            </div>
                            <span style="letter-spacing: -0.5px;">SarPras <span style="color: #8AB973;">SV IPB</span></span>
                        </a>
                        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <i class="fas fa-bars text-dark"></i>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <ul class="navbar-nav align-items-center gap-4">
                                @if (Route::has('login'))
                                    @auth
                                        <li class="nav-item">
                                            <a href="{{ url('/dashboard') }}" class="btn btn-glow px-4">
                                                Go to Dashboard <i class="fas fa-arrow-right ms-2"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a href="{{ route('login') }}" class="nav-link">Log in</a>
                                        </li>
                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a href="{{ route('register') }}" class="btn btn-glow">
                                                    Get Started Free
                                                </a>
                                            </li>
                                        @endif
                                    @endauth
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>

                <section class="hero-content">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 mb-5 mb-lg-0">
                                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white border mb-4 shadow-sm">
                                    <span class="badge bg-success rounded-pill">New</span>
                                    <span class="small fw-bold text-muted">System v1.0 is Live!</span>
                                </div>
                                
                                <h1 class="display-3 fw-bolder mb-4" style="line-height: 1.1;">
                                    Sistem Pelaporan <br>
                                    <span class="gradient-text">Sarana & Prasarana Kampus</span>
                                </h1>
                                
                                <p class="lead text-muted mb-5" style="max-width: 90%;">
                                    Kelola pelaporan kerusakan, permintaan perbaikan, dan inventaris sarana kampus dengan mudah dan terstruktur.
                                </p>
                                
                                <div class="d-flex gap-3 flex-wrap">
                                    <a href="{{ route('register') }}" class="btn btn-glow btn-lg">
                                        Mulai Pelaporan
                                    </a>
                                    <a href="#features" class="btn btn-outline-modern btn-lg">
                                        <i class="fas fa-play-circle me-2"></i> Learn More
                                    </a>
                                </div>

                                <div class="mt-5 pt-4 border-top border-secondary border-opacity-10">
                                    <p class="small fw-bold text-uppercase text-muted mb-3">Powered by Modern Technology</p>
                                    <div class="tech-stack-container">
                                        <i class="fab fa-laravel tech-icon laravel" data-bs-toggle="tooltip" title="Laravel 12 Framework"></i>
                                        <i class="fab fa-php tech-icon php" data-bs-toggle="tooltip" title="PHP 8.2"></i>
                                        <i class="fab fa-bootstrap tech-icon bootstrap" data-bs-toggle="tooltip" title="Bootstrap 5 UI"></i>
                                        <i class="fas fa-database tech-icon mysql" data-bs-toggle="tooltip" title="MySQL Database"></i>
                                        <i class="fab fa-js tech-icon js" data-bs-toggle="tooltip" title="JavaScript / Chart.js"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 text-center">
                                <div class="hero-img-container">
                                    <img src="{{ asset('images/undraw_analytics-setup_ptrz.svg') }}" alt="Dashboard Preview" class="img-fluid position-relative z-2" style="filter: drop-shadow(0 20px 50px rgba(176, 219, 156, 0.5));">
                                    
                                    <div class="bg-white p-3 rounded-4 shadow-lg position-absolute top-0 end-0 z-3 animate-float-slow d-none d-md-block" style="width: 180px; right: -20px !important; top: 40px !important;">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <div class="rounded-circle bg-success p-1"></div>
                                            <span class="small fw-bold">Stock Updated</span>
                                        </div>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-success" style="width: 75%"></div>
                                        </div>
                                    </div>

                                    <div class="bg-white p-3 rounded-4 shadow-lg position-absolute bottom-0 start-0 z-3 animate-float-delayed d-none d-md-block" style="width: 200px; left: -30px !important; bottom: 50px !important;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <small class="text-muted">Total Items</small>
                                                <h5 class="fw-bold m-0">1,240</h5>
                                            </div>
                                            <div class="bg-warning bg-opacity-10 p-2 rounded-circle text-warning">
                                                <i class="fas fa-box"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <section id="features" class="py-5 position-relative bg-white">
                <div class="container py-5">
                    <div class="text-center mb-5" style="max-width: 700px; margin: 0 auto;">
                        <span class="text-success fw-bold text-uppercase small ls-2">Why Choose Us</span>
                        <h2 class="display-5 fw-bold mt-2 mb-3 text-dark">Powerful Features</h2>
                                        <p class="text-muted">Sistem kami memudahkan pelaporan dan pemantauan sarana & prasarana kampus.</p>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="glass-card">
                                <div class="feature-icon bg-success bg-opacity-10 text-success">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                                <h4 class="fw-bold mb-3">Laporan & Statistik</h4>
                                <p class="text-muted">Visualisasikan data pelaporan dengan grafik interaktif. Pantau status perbaikan dan kondisi aset secara real-time.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="glass-card">
                                <div class="feature-icon bg-primary bg-opacity-10 text-primary">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <h4 class="fw-bold mb-3">Hak Akses Terstruktur</h4>
                                <p class="text-muted">Sistem hak akses untuk Admin dan Petugas. Semua aksi dicatat untuk akuntabilitas.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="glass-card">
                                <div class="feature-icon bg-warning bg-opacity-10 text-warning">
                                    <i class="fas fa-print"></i>
                                </div>
                                <h4 class="fw-bold mb-3">Manajemen Aset</h4>
                                <p class="text-muted">Kelola data aset kampus, cetak label, dan atur inventaris dengan cepat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="bg-white border-top mt-auto">
            <div class="container pt-5 pb-4">
                <div class="row">
                    <div class="col-lg-5 col-md-12 mb-4 mb-lg-0">
                            <div class="d-flex align-items-center mb-3">
                            <div class="bg-success bg-opacity-10 p-2 rounded me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-university text-success"></i>
                            </div>
                            <span class="h5 fw-bold mb-0 text-dark">SarPras <span class="text-success">SV IPB</span></span>
                        </div>
                        <p class="text-muted small pe-lg-5">
                            Sistem pelaporan sarana dan prasarana yang andal untuk lingkungan kampus. Mudah digunakan dan aman.
                        </p>
                    </div>

                    <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                        <h6 class="fw-bold text-dark mb-3">Product</h6>
                        <ul class="list-unstyled small">
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-link">Features</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-link">Pricing</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-link">API</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                        <h6 class="fw-bold text-dark mb-3">Company</h6>
                        <ul class="list-unstyled small">
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-link">About Us</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-link">Careers</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-link">Contact</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <h6 class="fw-bold text-dark mb-3">Legal</h6>
                        <ul class="list-unstyled small">
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-link">Privacy Policy</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-link">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="border-top py-3 text-center bg-white">
                <p class="small text-muted mb-0">
                    &copy; {{ date('Y') }} <span class="fw-bold text-dark">SarPras <span class="text-success">SV IPB</span></span>. All rights reserved.
                </p>
            </div>
        </footer>

    </body>
</html>