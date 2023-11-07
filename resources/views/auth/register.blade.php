@extends('layouts.auth')
@extends('auth.auth-layout')

@section('css')
<style>
    .btn-success {
        color: #fff;
        background-color: #348739;
        border-color: #348739;
    }
    .text {
        color: #348739;
    }

    .password-input-group {
        position: relative;
    }

    .password-toggle-icon {
        position: absolute;
        top: 50%;
        right: 10px; /* Adjust the position as needed */
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div>
    <h3 class="text-center mb-4 font-weight-bold text">রেজিস্টার</h3>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus
                placeholder="প্রথম নাম">
            @error('first_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus
                placeholder="শেষ নাম">
            @error('last_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" placeholder="ইমেইল">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group password-input-group">
            <input id="password" type="password" class="form-control password-toggle @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password" placeholder="পাসওয়ার্ড">
            <span class="password-toggle-icon">
                <i class="fa-solid fa-eye-slash"></i>
            </span>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group password-input-group">
            <input id="password-confirm" type="password" class="form-control password-toggle" name="password_confirmation"
                required autocomplete="new-password" placeholder="পাসওয়ার্ড নিশ্চিত করুন">
            <span class="password-toggle-icon">
                <i class="fa-solid fa-eye-slash"></i>
            </span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block font-weight-bold">রেজিস্টার করুন</button>
        </div>
    </form>
    <p class="mt-3">
        ইতিমধ্যে একটি একাউন্ট আছে? <a href="{{ route('login') }}">লগইন</a>
    </p>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordFields = document.querySelectorAll('.password-toggle');
        const toggleIcons = document.querySelectorAll('.password-toggle-icon i');

        toggleIcons.forEach((icon, index) => {
            icon.addEventListener('click', function () {
                if (passwordFields[index].type === 'password') {
                    passwordFields[index].type = 'text';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    passwordFields[index].type = 'password';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });
        });
    });
</script>
@endsection
