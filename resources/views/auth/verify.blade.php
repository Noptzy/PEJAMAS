@extends('dashboard.layouts.app')

@section('title')
Pejamas | Verify Email
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
                    <h4 class="mb-2">Good Citizens starts here 🚀</h4>
                    <p class="mb-4">Make your road better!</p>
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="mb-3 mt-4" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary d-grid w-100">{{ __('click here to request another') }}</button>.
                    </form>

                    <p class="text-center">

                        <span>Do you want using another account?</span>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <span>Log Out</span>
                        </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    </p>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>
@endsection
