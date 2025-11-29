<nav class="top-navbar sticky-top">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            
            <a class="navbar-brand fw-bold text-dark d-flex align-items-center gap-2" 
               href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}">
               
                <div class="bg-success bg-opacity-10 rounded-3 p-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-university text-success"></i>
                </div>
                <span style="letter-spacing: -0.5px;">SarPras <span style="color: #8AB973;">SV IPB</span></span>
            </a>

            <div class="dropdown">
                <button class="btn btn-light d-flex align-items-center gap-2 border-0 bg-transparent" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                             alt="Avatar" 
                             class="rounded-circle border border-2 border-white shadow-sm" 
                             style="width: 40px; height: 40px; object-fit: cover;">
                    @else
                        <div class="rounded-circle bg-success bg-opacity-25 d-flex align-items-center justify-content-center text-success fw-bold" style="width: 40px; height: 40px;">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif
                    
                    <div class="d-none d-md-flex flex-column align-items-start lh-sm">
                        <span class="fw-bold text-dark">{{ Auth::user()->name }}</span>
                        <span class="text-muted" style="font-size: 0.75rem;">{{ Auth::user()->email }}</span>
                    </div>

                </button>
                
                <ul class="dropdown-menu dropdown-menu-end animate slideIn" aria-labelledby="profileDropdown">
                    <li><span class="dropdown-item-text small text-muted">Masuk sebagai <br><strong>{{ Auth::user()->role }}</strong></span></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user-cog me-2 text-muted"></i> Profil
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Keluar
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="sub-navbar shadow-sm">
    <div class="container">
        <nav class="nav">
            
            @if(Auth::user()->role === 'admin')
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                   href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-chart-pie"></i> Dasbor
                </a>

                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                    href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users-cog"></i> Pengguna
                </a>

                <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" 
                   href="{{ route('admin.categories.index') }}">
                    <i class="fas fa-tags"></i> Kategori
                </a>

                <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" 
                   href="{{ route('admin.products.index') }}">
                    <i class="fas fa-box-open"></i> Sapras
                </a>

                <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}">
                    <i class="fas fa-bullhorn"></i> Laporan
                    @if(isset($pendingCount) && $pendingCount > 0)
                        <span class="badge bg-danger ms-2 rounded-pill" style="font-size: 0.7rem;">{{ $pendingCount }}</span>
                    @endif
                </a>

                <a class="nav-link {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}" 
                   href="{{ route('admin.activity-logs.index') }}">
                    <i class="fas fa-history"></i> Log Aktivitas
                </a>
            @else
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                   href="{{ route('dashboard') }}">
                    <i class="fas fa-clipboard-list"></i> Daftar Inventaris
                </a>
            @endif

        </nav>
    </div>
</div>