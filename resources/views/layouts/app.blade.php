<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'StockSync') }}</title>
        
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/9431/9431186.png" type="image/png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>

        <footer class="py-3"> 
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                                <p class="text-muted small mb-0">
                                    &copy; {{ date('Y') }} <strong>SarPras <span style="color: #8AB973;">SV IPB</span></strong>. All rights reserved.
                                </p>
                            </div>
                    <div class="col-md-6 text-center text-md-end">
                        <ul class="list-inline mb-0 small">
                            <li class="list-inline-item"><a href="{{ route('privacy.policy') }}" target="_blank" class="text-decoration-none text-muted hover-success">Privacy</a></li>
                            <li class="list-inline-item border-end mx-2"></li>
                            <li class="list-inline-item"><a href="{{ route('terms') }}" target="_blank" class="text-decoration-none text-muted hover-success">Terms</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;">
            
            @if (session('status') || session('success'))
                <div class="toast align-items-center text-bg-success border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body fw-bold">
                            <i class="fas fa-check-circle me-2"></i> 
                            {{ session('status') ?? session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="toast align-items-center text-bg-danger border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body fw-bold">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            Periksa formulir untuk kesalahan.
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>

        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    </body>
</html>