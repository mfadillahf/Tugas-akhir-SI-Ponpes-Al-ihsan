@php
$configData = Helper::appClasses();
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Login Ponpes Al-Ihsan')

@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/@form-validation/form-validation.scss'
])
@endsection

@section('page-style')
@vite([
    'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection

@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js'
])
@endsection

@section('page-script')
@vite([
    'resources/assets/js/pages-auth-login.js'
])
@endsection

@section('content')
<div class="authentication-wrapper authentication-cover">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="auth-cover-brand d-flex align-items-center gap-2">
        <span class="app-brand-logo demo">@include('_partials.macros', ["width" => 25, "withbg" => 'var(--bs-primary)'])</span>
        <span class="app-brand-text demo text-heading fw-semibold">Ponpes Al-Ihsan</span>
    </a>
    <!-- /Logo -->

    <div class="authentication-inner row m-0">
    <!-- Ilustrasi kiri -->
    <div class="d-none d-lg-flex col-lg-7 col-xl-8 p-0" style="height: 100vh; overflow: hidden;">
		<img src="{{ asset('assets/img/illustrations/ponpes.jpg') }}" 
			 class="w-100 h-100" 
			 alt="Ponpes" 
			 style="object-fit: cover;" />
	</div>
    <!-- /Ilustrasi -->

    <!-- Form Login -->
    <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-12 px-12 py-6">
        <div class="w-px-400 mx-auto pt-5 pt-lg-0">
            <h4 class="mb-1">Selamat datang! 👋</h4>
            <h5 class="text-primary fw-bold mb-1">Di Ponpes Al-Ihsan Banjarmasin</h5>
            <p class="mb-5">Silakan login untuk melanjutkan</p>
            @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form id="formAuthentication" class="mb-5" action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="form-floating form-floating-outline mb-4">
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" autofocus required>
                <label for="username">Username</label>
            </div>

            <div class="mb-4">
                <div class="form-password-toggle">
                <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                    <input type="password" id="password" class="form-control" name="password" placeholder="Password" required />
                    <label for="password">Password</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                </div>
                </div>
            </div>

            {{-- Opsional: Remember Me --}}
            {{-- 
            <div class="mb-4 d-flex justify-content-between">
                <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" />
                <label class="form-check-label" for="remember">Ingat saya</label>
                </div>
                <a href="#" class="text-decoration-none">Lupa password?</a>
            </div>
            --}}

            <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
            </form>
        </div>
    </div>
    <!-- /Form Login -->
    </div>
</div>
@endsection
