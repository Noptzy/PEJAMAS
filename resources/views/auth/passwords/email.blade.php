@extends('dashboard.layouts.app')

@section('title')
Pejamas | Forgot Password
@endsection

@push('custom-css')
<link rel="stylesheet" href="{{ asset('Dashboard/vendor/css/pages/page-auth.css') }}" />
@endpush

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">

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
                    <h4 class="mb-2">Forgot Password? 🔒</h4>
                    <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
                    <form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" autofocus value="{{ old('email') }}" required autocomplete="email" />
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
                    </form>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                            <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                            Back to login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
