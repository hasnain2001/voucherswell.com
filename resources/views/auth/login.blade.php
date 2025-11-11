@extends('layouts.master')
@section('title','Login | Access Your Account for Exclusive '. date('y') .'  Discounts & Deals')
@section('description', 'Sign in to your '.config('app.name').' account to unlock exclusive discount codes, special offers, and the best deals of '. date('Y').' Access your saved coupons and personalized recommendations.')
@section('keywords', 'stores, offers, products, services')
@section('author', 'john doe')
@push('styles')
<style>
:root {
    --white: #ffffff;
    --black: #000000;
    --primary: #d6a751;
    --primary-light: #f9e076;
    --primary-dark: #b8860b;
    --gold-highlight: #ffeb3b;
    --dark-bg: #145f59;
    --dark-bg-light: #1a7a72;
    --dark-bg-dark: #0f4a45;
    --light-gray: #f8f9fa;
    --medium-gray: #e9ecef;
    --dark-gray: #343a40;

    --gold-gradient: linear-gradient(135deg, #ffeb3b 0%, #f9e076 25%, #d4af37 50%, #b8860b 100%);
    --gold-shimmer: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
    --gold-radial: radial-gradient(circle at center, #fff9c4 0%, #f9e076 35%, #d4af37 70%, #b8860b 100%);
    --bg-size: 200% 200%;
}

.login-section {
    background: var(--gold-radial);
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 2rem 0;
}

.login-container {
    max-width:1000px;
    margin: 0 auto;
}

.login-card {
    background: var(--white);
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    border: none;
    overflow: hidden;
    backdrop-filter: blur(10px);
}

.login-header {
    background: var(--gold-gradient);
    background-size: var(--bg-size);
    animation: shimmer 3s ease infinite;
    padding: 2.5rem 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.login-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: var(--gold-shimmer);
    animation: shine 2s infinite;
}

@keyframes shimmer {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

@keyframes shine {
    0% { left: -100%; }
    100% { left: 100%; }
}

.login-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--black);
    margin-bottom: 0.5rem;
    position: relative;
    z-index: 2;
}

.login-subtitle {
    color: rgba(0, 0, 0, 0.8);
    font-size: 1rem;
    position: relative;
    z-index: 2;
}

.login-body {
    padding: 2.5rem 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
    position: relative;
}

.form-label {
    font-weight: 600;
    color: var(--dark-gray);
    margin-bottom: 0.5rem;
    display: block;
}

.form-control {
    border: 2px solid var(--medium-gray);
    border-radius: 12px;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: var(--white);
}

.form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 0.2rem rgba(214, 167, 81, 0.25);
    background: var(--white);
}

.form-control.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    display: block;
    margin-top: 0.5rem;
    font-size: 0.875rem;
    color: #dc3545;
}

.password-toggle {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--dark-gray);
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: color 0.3s ease;
}

.password-toggle:hover {
    color: var(--primary);
}

.btn-login {
    background: var(--gold-gradient);
    background-size: var(--bg-size);
    border: none;
    border-radius: 12px;
    padding: 0.875rem 2rem;
    font-weight: 600;
    color: var(--black);
    transition: all 0.3s ease;
    animation: shimmer 3s ease infinite;
    position: relative;
    overflow: hidden;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(214, 167, 81, 0.4);
}

.btn-login:active {
    transform: translateY(0);
}

.auth-link {
    color: var(--primary);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.auth-link:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}

.form-check-input:checked {
    background-color: var(--primary);
    border-color: var(--primary);
}

.form-check-input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 0.2rem rgba(214, 167, 81, 0.25);
}

.divider {
    display: flex;
    align-items: center;
    margin: 1.5rem 0;
}

.divider::before, .divider::after {
    content: "";
    flex: 1;
    border-bottom: 1px solid var(--medium-gray);
}

.divider-text {
    padding: 0 1rem;
    color: var(--dark-gray);
    font-size: 0.875rem;
    font-weight: 500;
}

.login-features {
    background: var(--light-gray);
    border-radius: 12px;
    padding: 1.5rem;
    margin-top: 2rem;
}

.features-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--dark-gray);
    margin-bottom: 1rem;
    text-align: center;
}

.features-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.features-list li {
    padding: 0.5rem 0;
    color: var(--dark-gray);
    display: flex;
    align-items: center;
}

.features-list li::before {
    content: '✓';
    color: var(--primary);
    font-weight: bold;
    margin-right: 0.75rem;
    font-size: 1.1rem;
}

/* Loading state */
.btn-loading {
    position: relative;
    color: transparent;
}

.btn-loading::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    top: 50%;
    left: 50%;
    margin-left: -10px;
    margin-top: -10px;
    border: 2px solid transparent;
    border-top-color: var(--black);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Logo styles */
.auth-logo {
    margin-bottom: 1rem;
    width: 120px;
    transition: transform 0.3s ease;
    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
}

.auth-logo:hover {
    transform: scale(1.05);
}

/* Responsive */
@media (max-width: 576px) {
    .login-container {
        margin: 1rem;
    }

    .login-body {
        padding: 2rem 1.5rem;
    }

    .login-header {
        padding: 2rem 1.5rem;
    }

    .login-title {
        font-size: 1.75rem;
    }
}

/* Success message styles */
.alert-success {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    border: 1px solid #c3e6cb;
    color: #155724;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}
</style>
@endpush

@section('content')
<section class="login-section">
    <div class="container">
        <div class="login-container">
            <!-- Session Status -->
            <x-auth-session-status class="alert alert-success text-center" :status="session('status')" />

            <div class="login-card">
                <!-- Header -->
                <div class="login-header">
                    <h1 class="login-title">Welcome Back!</h1>
                    <a href="{{ url(app()->getLocale().'/') }}" class="d-block text-center">
                        <x-application-logo class="auth-logo"/>
                    </a>
                    <p class="login-subtitle">Sign in to access exclusive deals & discounts</p>
                </div>

                <!-- Body -->
                <div class="login-body">
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf

                        <!-- Email Address -->
                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   placeholder="Enter your email address">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password with toggle -->
                        <div class="form-group">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <div class="position-relative">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="current-password"
                                       placeholder="Enter your password">
                                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember_me">
                                    {{ __('Remember me') }}
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <a class="auth-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-login" id="loginBtn">
                                <i class="fas fa-sign-in-alt me-2"></i>{{ __('Sign In') }}
                            </button>
                        </div>

                        <!-- Divider -->
                        <div class="divider">
                            <span class="divider-text">New to {{ config('app.name') }}?</span>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="mb-0">Don't have an account?
                                @if (Route::has('register'))
                                    <a class="auth-link" href="{{ route('register') }}">
                                        {{ __('Create one now') }}
                                    </a>
                                @endif
                            </p>
                        </div>
                    </form>

                    <!-- Features -->
                    <div class="login-features">
                        <h4 class="features-title">Your Account Benefits</h4>
                        <ul class="features-list">
                            <li>Access exclusive member-only deals</li>
                            <li>Save your favorite stores & coupons</li>
                            <li>Personalized discount recommendations</li>
                            <li>Track your savings history</li>
                            <li>Early access to new offers</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@push('scripts')
<script>
// Password visibility toggle
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = field.nextElementSibling.querySelector('i');

    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Form submission handler
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('loginBtn');

    // Show loading state
    submitBtn.disabled = true;
    submitBtn.classList.add('btn-loading');
    submitBtn.innerHTML = 'Signing In...';
});

// Input validation on blur
document.querySelectorAll('.form-control').forEach(input => {
    input.addEventListener('blur', function() {
        if (this.value.trim() === '' && this.required) {
            this.classList.add('is-invalid');
        } else {
            this.classList.remove('is-invalid');
        }
    });
});

// Auto-remove validation on input
document.querySelectorAll('.form-control').forEach(input => {
    input.addEventListener('input', function() {
        if (this.value.trim() !== '') {
            this.classList.remove('is-invalid');
        }
    });
});

// Enter key submission
document.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        const form = document.getElementById('loginForm');
        const submitBtn = document.getElementById('loginBtn');

        if (!submitBtn.disabled) {
            form.dispatchEvent(new Event('submit'));
        }
    }
});
</script>
@endpush
@endsection
