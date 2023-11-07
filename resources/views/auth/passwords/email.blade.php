@extends('layouts.auth')
@extends('auth.auth-layout')

@section('css')
<style>
    .btn-success {
    color: #fff;
    background-color: #348739;
    border-color: #348739;
    }
</style>
@endsection


@section('content')

<p class="login-box-msg">আপনি আপনার পাসওয়ার্ড ভুলে গেছেন? এখানে আপনি সহজেই একটি নতুন পাসওয়ার্ড পুনরুদ্ধার করতে পারেন।</p>

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="form-group">

        <div class="input-group">
            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="ইমেইল"
                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-success">নতুন পাসওয়ার্ডের জন্য অনুরোধ করুন</button>
        </div>
        <!-- /.col -->
    </div>
</form>

<p class="mt-3 mb-1">
    <a href="{{ route('login') }}">লগইন</a>
</p>
<p class="mb-0">
    <a href="{{ route('register') }}" class="text-center">একটি নতুন সদস্যতা নিবন্ধন করুন</a>
</p>

@endsection