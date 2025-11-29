<x-guest-layout>
    <div class="mb-4">
        <span class="waving-hand">👋</span>
        <h3 class="fw-bold text-dark mb-1">Masuk ke SarPras SV IPB</h3>
        <p class="text-muted small">Selamat datang! Silakan masuk menggunakan akun Anda untuk melaporkan dan memantau sarana kampus.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label class="small fw-bold mb-1 text-muted">Email address <span class="text-danger">*</span></label>
        <div class="modern-input-group">
            <i class="fas fa-envelope"></i>
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required autofocus>
        </div>
        @error('email') <div class="text-danger small mb-2 mt-n2">{{ $message }}</div> @enderror

        <label class="small fw-bold mb-1 text-muted mt-2">Password <span class="text-danger">*</span></label>
        <div class="modern-input-group">
            <i class="fas fa-lock"></i>
            <input id="password" type="password" name="password" placeholder="password" required style="flex-grow: 1;">
            <i class="fas fa-eye toggle-password" style="cursor: pointer; margin-right: 0; margin-left: 10px;"></i>
        </div>
        @error('password') <div class="text-danger small mb-2 mt-n2">{{ $message }}</div> @enderror
        <div class="text-muted " style="font-size: 0.75rem;">Your password must be 8 characters at least</div>

        <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
            <div class="form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label small text-muted">Remember me</label>
            </div>
        </div>

        

        <button type="submit" class="btn btn-primary">
            Login
        </button>

        <div class="text-center mt-4 small text-muted">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="fw-bold text-primary text-decoration-none">Daftar di sini</a>
        </div>
    </form>
</x-guest-layout>