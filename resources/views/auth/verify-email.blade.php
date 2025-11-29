<x-guest-layout>
    <div class="mb-4 text-center">
        <h3 class="fw-bold text-dark mb-2">Verifikasi Email Dinonaktifkan</h3>
        <p class="text-muted small">Sistem ini telah dikonfigurasi tanpa verifikasi email. Silakan masuk atau hubungi administrator jika perlu.</p>
    </div>

    <div class="d-grid gap-3">
        <a href="{{ route('login') }}" class="btn btn-primary">Kembali ke Masuk</a>
    </div>
</x-guest-layout>