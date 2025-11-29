<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'StockSync') }}</title>
        
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" type="image/png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container-fluid p-0 split-screen">
            <div class="row g-0 row-full">
                
                <div class="col-lg-6 d-none d-lg-flex left-panel">
                    
                    <div class="text-content my-auto"> 
                        <div class="mb-3">
                            <i class="fas fa-warehouse fa-4x" style="color: #8AB973; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));"></i>
                        </div>
                        
                        <h2>
                            <span class="typing-text">
                                <span class="text-dark"> Welcome to </span> SarPras SV IPB
                            </span>
                        </h2>

                        <p>Laporkan Sarana Dan Prasarana Kampus SV IPB</p>
                        
                        <img src="{{ asset('images/undraw_term-sheet_70lo.svg') }}" 
                             alt="Inventory Illustration" 
                             class="hero-img">
                        
                        <div class="avatar-group justify-content-center">
                            <img src="https://i.pravatar.cc/150?img=3" alt="User">
                            <img src="https://i.pravatar.cc/150?img=5" alt="User">
                            <img src="https://i.pravatar.cc/150?img=8" alt="User">
                            <img src="https://i.pravatar.cc/150?img=12" alt="User">
                            <span>100+ Users joined us, now it's your turn.</span>
                        </div>
                    </div>

                    <div class="mt-auto pb-3 text-muted small">
                        &copy; {{ date('Y') }} SarPras SV IPB. All rights reserved.
                    </div>
                </div>

                <div class="col-lg-6 right-panel">
                    <div class="auth-container">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>

        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;">
            @if (session('status') || session('success'))
                <div class="toast align-items-center text-bg-success border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body fw-bold">
                            <i class="fas fa-check-circle me-2"></i> {{ session('status') ?? session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div class="toast align-items-center text-bg-danger border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body fw-bold">
                            <i class="fas fa-exclamation-circle me-2"></i> Please check the form for errors.
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
    </body>
</html>