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

.register-section {
    background: var(--gold-radial);
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 2rem 0;
}

.register-container {
    max-width: 450px;
    margin: 0 auto;
}

.register-card {
    background: var(--white);
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    border: none;
    overflow: hidden;
    backdrop-filter: blur(10px);
}

.register-header {
    background: var(--gold-gradient);
    background-size: var(--bg-size);
    animation: shimmer 3s ease infinite;
    padding: 2.5rem 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.register-header::before {
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

.register-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--black);
    margin-bottom: 0.5rem;
    position: relative;
    z-index: 2;
}

.register-subtitle {
    color: rgba(0, 0, 0, 0.8);
    font-size: 1rem;
    position: relative;
    z-index: 2;
}

.register-body {
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

.btn-register {
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

.btn-register:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(214, 167, 81, 0.4);
}

.btn-register:active {
    transform: translateY(0);
}

.login-link {
    color: var(--primary);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.login-link:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}

/* Math CAPTCHA Styles */
.math-captcha {
    background: var(--light-gray);
    border: 2px solid var(--primary);
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    margin: 1.5rem 0;
}

.captcha-question {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--dark-gray);
    margin-bottom: 1rem;
}

.captcha-input {
    width: 120px;
    margin: 0 auto;
    text-align: center;
    font-size: 1.1rem;
    font-weight: 600;
}

.refresh-captcha {
    background: none;
    border: none;
    color: var(--primary);
    font-size: 1.2rem;
    cursor: pointer;
    margin-left: 0.5rem;
    transition: transform 0.3s ease;
}

.refresh-captcha:hover {
    transform: rotate(180deg);
    color: var(--primary-dark);
}

.form-features {
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

.password-strength {
    margin-top: 0.5rem;
    height: 4px;
    background: var(--medium-gray);
    border-radius: 2px;
    overflow: hidden;
}

.strength-bar {
    height: 100%;
    width: 0%;
    transition: all 0.3s ease;
    border-radius: 2px;
}

.strength-weak { background: #dc3545; width: 33%; }
.strength-medium { background: #ffc107; width: 66%; }
.strength-strong { background: #28a745; width: 100%; }

.strength-text {
    font-size: 0.75rem;
    margin-top: 0.25rem;
    color: var(--dark-gray);
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

/* Responsive */
@media (max-width: 576px) {
    .register-container {
        margin: 1rem;
    }

    .register-body {
        padding: 2rem 1.5rem;
    }

    .register-header {
        padding: 2rem 1.5rem;
    }

    .math-captcha {
        padding: 1rem;
    }
}
</style>
@endpush

@section('content')
<section class="register-section">
    <div class="container">
        <div class="register-container">
            <div class="register-card">
                <!-- Header -->
                <div class="register-header">
                    <h1 class="register-title">Create Account</h1>
                    <p class="register-subtitle">Join thousands saving with exclusive deals</p>
                </div>

                <!-- Body -->
                <div class="register-body">
                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}"
                                   required
                                   autofocus
                                   autocomplete="name"
                                   placeholder="Enter your full name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}"
                                   required
                                   autocomplete="email"
                                   placeholder="your@email.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <div class="position-relative">
                                <input type="password"
                                       id="password"
                                       name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       required
                                       autocomplete="new-password"
                                       placeholder="Create a strong password"
                                       oninput="checkPasswordStrength(this.value)">
                                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="password-strength">
                                <div class="strength-bar" id="passwordStrengthBar"></div>
                            </div>
                            <div class="strength-text" id="passwordStrengthText"></div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <div class="position-relative">
                                <input type="password"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                       required
                                       autocomplete="new-password"
                                       placeholder="Confirm your password">
                                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Math CAPTCHA -->
                        <div class="math-captcha">
                            <div class="captcha-question" id="captchaQuestion">
                                <!-- Generated by JavaScript -->
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <input type="number"
                                       id="captcha_answer"
                                       name="captcha_answer"
                                       class="form-control captcha-input"
                                       required
                                       placeholder="Answer">
                                <button type="button" class="refresh-captcha" onclick="generateMathCaptcha()" title="Refresh question">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                            <input type="hidden" id="captcha_result" name="captcha_result">
                            @error('captcha_answer')
                                <div class="invalid-feedback d-block text-center mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-register" id="registerBtn">
                                Create Account
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center mt-4">
                            <p class="mb-0">
                                Already have an account?
                                <a href="{{ route('login') }}" class="login-link">Sign in here</a>
                            </p>
                        </div>
                    </form>

                    <!-- Features -->
                    <div class="form-features">
                        <h4 class="features-title">Why Join Us?</h4>
                        <ul class="features-list">
                            <li>Exclusive discount codes & deals</li>
                            <li>Personalized recommendations</li>
                            <li>Save your favorite stores</li>
                            <li>Early access to new offers</li>
                            <li>Track your savings</li>
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

// Password strength checker
function checkPasswordStrength(password) {
    const strengthBar = document.getElementById('passwordStrengthBar');
    const strengthText = document.getElementById('passwordStrengthText');

    let strength = 0;
    let text = '';
    let barClass = '';

    // Check password length
    if (password.length >= 8) strength++;

    // Check for mixed case
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength++;

    // Check for numbers
    if (password.match(/([0-9])/)) strength++;

    // Check for special characters
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength++;

    // Update strength indicator
    switch(strength) {
        case 0:
        case 1:
            barClass = 'strength-weak';
            text = 'Weak password';
            break;
        case 2:
        case 3:
            barClass = 'strength-medium';
            text = 'Medium strength';
            break;
        case 4:
            barClass = 'strength-strong';
            text = 'Strong password';
            break;
    }

    strengthBar.className = 'strength-bar ' + barClass;
    strengthText.textContent = text;
}

// Math CAPTCHA Generator
function generateMathCaptcha() {
    const operations = ['+', '-', '*'];
    const operation = operations[Math.floor(Math.random() * operations.length)];

    let num1, num2, result;

    switch(operation) {
        case '+':
            num1 = Math.floor(Math.random() * 10) + 1;
            num2 = Math.floor(Math.random() * 10) + 1;
            result = num1 + num2;
            break;
        case '-':
            num1 = Math.floor(Math.random() * 15) + 5;
            num2 = Math.floor(Math.random() * 5) + 1;
            result = num1 - num2;
            break;
        case '*':
            num1 = Math.floor(Math.random() * 8) + 2;
            num2 = Math.floor(Math.random() * 5) + 1;
            result = num1 * num2;
            break;
    }

    document.getElementById('captchaQuestion').textContent = `What is ${num1} ${operation} ${num2}?`;
    document.getElementById('captcha_result').value = result;

    // Clear previous answer
    document.getElementById('captcha_answer').value = '';
}

// Form submission handler
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const captchaAnswer = document.getElementById('captcha_answer').value;
    const captchaResult = document.getElementById('captcha_result').value;
    const submitBtn = document.getElementById('registerBtn');

    if (!captchaAnswer) {
        e.preventDefault();
        alert('Please solve the math question to verify you are human.');
        return;
    }

    if (parseInt(captchaAnswer) !== parseInt(captchaResult)) {
        e.preventDefault();
        alert('Incorrect answer. Please try the math question again.');
        generateMathCaptcha();
        return;
    }

    // Show loading state
    submitBtn.disabled = true;
    submitBtn.classList.add('btn-loading');
    submitBtn.innerHTML = 'Creating Account...';
});

// Real-time password confirmation check
document.getElementById('password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmPassword = this.value;
    const formGroup = this.closest('.form-group');

    if (confirmPassword && password !== confirmPassword) {
        this.classList.add('is-invalid');
        if (!formGroup.querySelector('.confirm-error')) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback confirm-error';
            errorDiv.textContent = 'Passwords do not match';
            formGroup.appendChild(errorDiv);
        }
    } else {
        this.classList.remove('is-invalid');
        const errorDiv = formGroup.querySelector('.confirm-error');
        if (errorDiv) {
            errorDiv.remove();
        }
    }
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

// Generate CAPTCHA on page load
document.addEventListener('DOMContentLoaded', function() {
    generateMathCaptcha();
});
</script>
@endpush
@endsection
