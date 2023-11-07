@extends('layouts.auth')
@extends('auth.auth-layout')

@section('css')
<style>
    /* Add this CSS to make the form responsive for mobile devices */
@media (max-width: 768px) {
    .login-container {
        padding: 20px; 
    }

    .login-box {
        padding: 20px; 
    }

    .text-center.mb-4 {
        font-size: 24px; 
    }

    .form-control {
        margin-bottom: 15px; 
    }

    .password-toggle-icon {
        position: absolute;
        right: 10px;
        top: 35px; 
    }

    .form-group:last-child {
        margin-bottom: 0; 
    }
}

    .btn-success {
        color: #fff;
        background-color: #348739;
        border-color: #348739;
    }
    .text {
        color: #348739;
    }

    
</style>
@endsection

@section('content')
<div class="login-container">
    <div class="login-box">
        <h3 class="text-center mb-4 font-weight-bold text">লগইন</h3>
        <form action="{{ route('login') }}" method="post">
            @csrf

            <div class="form-group">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="ইমেইল" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group password-input-group">
                <input type="password" class="form-control password-toggle @error('password') is-invalid @enderror"
                    placeholder="পাসওয়ার্ড" name="password" required autocomplete="current-password">
                <span class="password-toggle-icon">
                    <i class="fa-solid fa-eye-slash"></i>
                </span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- <div class="form-group">
                <label class="form-check-label">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    মনে রাখুন
                </label>
            </div> --}}

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block font-weight-bold">লগইন করুন</button>
            </div>

        </form>

        {{-- <div class="text-center">
            <p><a href="{{ route('password.request') }}">পাসওয়ার্ড ভুলে গেছেন?</a></p>
            <p><a href="{{ route('register')}}">সদস্যপদ এর জন্য নিবন্ধন করুন</a></p>
        </div> --}}

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordField = document.querySelector('.password-toggle');
        const toggleIcon = document.querySelector('.password-toggle-icon i');

        toggleIcon.addEventListener('click', function () {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        });
    });
</script>
@endsection
