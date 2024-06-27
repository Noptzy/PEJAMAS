@extends('dashboard.layouts.app')

@section('title')
Pejamas | Login
@endsection

@push('custom-css')
<link rel="stylesheet" href="{{ asset('backend/vendor/css/pages/page-auth.css') }}" />
@endpush

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
            <a href="/" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                <img src="{{ asset('BizLand/Pejamas Icon.png') }}" alt="pejamas logo" style="width: 20px;" class="w-10 p-0 m-0">
                </span>
                <span class="app-brand-text demo text-body fw-bolder">Pejamas</span>
            </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Welcome to Pejamas! 👋</h4>
            <p class="mb-4">Please sign-in to your account before reporting</p>
            <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                type="text"
                class="form-control @error('email') is-invalid @enderror"
                id="email"
                name="email"
                placeholder="Enter your email"
                autofocus
                required
                value="{{ old('email') }}"
                />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        <small>Forgot Password?</small>
                    </a>
                @endif
                </div>
                <div class="input-group input-group-merge">
                <input
                    type="password"
                    id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    required
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
                <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
            </form>

            <p class="text-center">
            <span>New on our platform?</span>
            <a href="{{ route('register') }}">
                <span>Create an account</span>
            </a>
            </p>
        </div>
        </div>
        <!-- /Register -->
    </div>
    </div>
</div>
@endsection
