<section>
    {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form> --}}

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="d-flex align-items-center mb-4">
            <div class="me-3">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" 
                         alt="Avatar" 
                         class="rounded-circle border border-2 border-success p-1" 
                         style="width: 80px; height: 80px; object-fit: cover;">
                @else
                    <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center fw-bold fs-3 border border-success border-opacity-25" 
                         style="width: 80px; height: 80px;">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                @endif
            </div>
            <div class="flex-grow-1">
                <label class="form-label fw-bold small text-muted">Profile Picture</label>
                <input type="file" name="avatar" class="form-control form-control-sm" accept="image/*">
                <div class="form-text small text-muted">Allowed: jpg, jpeg, png. Max: 2MB</div>
                @error('avatar') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold small text-muted">Full Name</label>
            <div class="modern-input-group">
                <i class="fas fa-user text-muted"></i>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name">
            </div>
            @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold small text-muted">Email Address</label>
            <div class="modern-input-group">
                <i class="fas fa-envelope text-muted"></i>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
            </div>
            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-2 small">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline small fw-bold">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </div>
                @if (session('status') === 'verification-link-sent')
                    <div class="text-success small mt-1 fw-bold">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </div>
                @endif
            @endif
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary px-4 text-white">
                {{ __('Save Changes') }}
            </button>

        </div>
    </form>
</section>