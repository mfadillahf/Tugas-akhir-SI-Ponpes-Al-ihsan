@extends('layouts/layoutMaster')

@section('title', 'User Profile - Donatur')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
])
@endsection

<!-- Page Styles -->
@section('page-style')
@vite([
    'resources/assets/vendor/scss/pages/page-profile.scss',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/pages-profile-donatur.js'])
@endsection

@section('content')
<meta name="flash-success" content="{{ session('success') }}">
<meta name="flash-error" content="{{ session('error') }}">

<!-- Header -->
<div class="row">
    <div class="col-12">
        <div class="card mb-6">
        <div class="user-profile-header-banner">
            <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top">
        </div>
        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-5">
            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user image" class="d-block h-auto ms-0 ms-sm-5 rounded-4 user-profile-img">
            </div>
            <div class="flex-grow-1 mt-4 mt-sm-12">
            <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-6">
                <div class="user-profile-info">
                <h4 class="mb-2">{{ $profile->nama }}</h4>
                <span class="badge bg-label-success">Donatur</span>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
<!--/ Header -->

<!-- User Profile Content -->
<div class="row">
    <div class="col-12">
        <!-- About User -->
        <div class="card mb-6">
        <div class="card-body">
            <small class="card-text text-uppercase text-muted small">Tentang</small>
            <ul class="list-unstyled my-3 py-1">
                <li class="d-flex align-items-center mb-4">
                    <i class="ri-user-3-line ri-24px"></i>
                    <span class="fw-medium mx-2">Nama:</span> <span>{{ $profile->nama }}</span>
                </li>
                <li class="d-flex align-items-center mb-4">
                    <i class="ri-account-circle-line ri-24px"></i>
                    <span class="fw-medium mx-2">Username:</span>
                    <span>{{ $profile->user->username ?? '-' }}</span>
                </li>
                <li class="d-flex align-items-center mb-4">
                    <i class="ri-map-pin-line ri-24px"></i>
                    <span class="fw-medium mx-2">Alamat:</span> <span>{{ $profile->alamat }}</span>
                </li>
                <li class="d-flex align-items-center mb-4">
                    <i class="ri-phone-line ri-24px"></i>
                    <span class="fw-medium mx-2">No Telepon:</span> <span>{{ $profile->no_telepon }}</span>
                </li>
                <li class="d-flex align-items-center mb-4">
                    <i class="ri-mail-line ri-24px"></i>
                    <span class="fw-medium mx-2">Email:</span> <span>{{ $profile->email }}</span>
                </li>
                </ul>

            <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profil</a>
            </div>
        </div>
        </div>
        <!--/ About User -->
    </div>
</div>
@endsection
