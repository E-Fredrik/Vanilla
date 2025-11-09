<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-4">
        <h2 class="fw-bold" style="color: #2C2C2C;">Welcome Back!</h2>
        <p class="text-muted">Sign in to access your admin panel</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label">
                <i class="bi bi-envelope me-2"></i>Email Address
            </label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username"
                   placeholder="admin@vanillabakery.com">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label">
                <i class="bi bi-lock me-2"></i>Password
            </label>
            <input id="password" 
                   type="password" 
                   name="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   required 
                   autocomplete="current-password"
                   placeholder="Enter your password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-4 form-check">
            <input id="remember_me" 
                   type="checkbox" 
                   class="form-check-input" 
                   name="remember">
            <label class="form-check-label" for="remember_me">
                Remember me
            </label>
        </div>

        <!-- Submit Button -->
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Sign In
            </button>
        </div>

        <!-- Forgot Password Link -->
        @if (Route::has('password.request'))
            <div class="text-center">
                <a href="{{ route('password.request') }}" 
                   class="text-decoration-none" 
                   style="color: #D4AF88;">
                    <i class="bi bi-question-circle me-1"></i>
                    Forgot your password?
                </a>
            </div>
        @endif
    </form>

    <div class="mt-4 pt-4 border-top text-center">
        <a href="/" class="text-decoration-none text-muted">
            <i class="bi bi-arrow-left me-2"></i>
            Back to Website
        </a>
    </div>
</x-guest-layout>
