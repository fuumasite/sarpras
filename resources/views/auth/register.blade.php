<x-guest-layout>
    <div class="mb-4">
        <span class="waving-hand">🚀</span>
        <h3 class="fw-bold text-dark mb-1">Buat Akun</h3>
        <p class="text-muted small">Selamat datang! Buat akun untuk mulai melaporkan sarana dan prasarana kampus.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label class="small fw-bold mb-1 text-muted">Full Name <span class="text-danger">*</span></label>
        <div class="modern-input-group">
            <i class="fas fa-user"></i>
            <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required autofocus>
        </div>
        @error('name') <div class="text-danger small mb-2 mt-n2">{{ $message }}</div> @enderror

        <label class="small fw-bold mb-1 text-muted mt-2">Email Address <span class="text-danger">*</span></label>
        <div class="modern-input-group">
            <i class="fas fa-envelope"></i>
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
        </div>
        @error('email') <div class="text-danger small mb-2 mt-n2">{{ $message }}</div> @enderror

        <label class="small fw-bold mb-1 text-muted mt-2">Password <span class="text-danger">*</span></label>
        <div class="modern-input-group">
            <i class="fas fa-lock"></i>
            <input id="password" type="password" name="password" placeholder="Create a password" required style="flex-grow: 1;">
            <i class="fas fa-eye toggle-password" style="cursor: pointer; margin-right: 0; margin-left: 10px;"></i>
        </div>
        @error('password') <div class="text-danger small mb-2 mt-n2">{{ $message }}</div> @enderror
        <div class="text-muted " style="font-size: 0.75rem;">Your password must be 8 characters at least</div>

        <label class="small fw-bold mb-1 text-muted mt-2">Confirm Password <span class="text-danger">*</span></label>
        <div class="modern-input-group">
            <i class="fas fa-check-circle"></i>
            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Repeat password" required style="flex-grow: 1;">
            <i class="fas fa-eye toggle-password" style="cursor: pointer; margin-right: 0; margin-left: 10px;"></i>
        </div>

        <div class="form-check mb-3 mt-3">
            <input id="terms" type="checkbox" class="form-check-input" name="terms" required>
            <label for="terms" class="form-check-label small text-muted">
                I agree to the 
                <a href="{{ route('terms') }}" class="text-primary text-decoration-none fw-bold">Terms</a> 
                & 
                <a href="{{ route('privacy.policy') }}" class="text-primary text-decoration-none fw-bold">Privacy Policy</a>
            </label>
        </div>

        

        <button type="submit" class="btn btn-primary">
            Daftar
        </button>

        <div class="text-center mt-4 small text-muted">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="fw-bold text-primary text-decoration-none">Masuk di sini</a>
        </div>
    </form>
</x-guest-layout>