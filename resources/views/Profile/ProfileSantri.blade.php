@extends('layouts/layoutMaster')

@section('title', 'User Profile - Santri')

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
@vite(['resources/assets/js/pages-profile-santri.js'])
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
            <img src="{{ asset('public/assets/img/avatars/1.png') }}" alt="user image" class="d-block h-auto ms-0 ms-sm-5 rounded-4 user-profile-img">
            </div>
            <div class="flex-grow-1 mt-4 mt-sm-12">
            <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-6">
                <div class="user-profile-info">
                <h4 class="mb-2">{{ $profile->nama_lengkap }}</h4>
                <span class="badge bg-label-info">Santri</span>
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
            <div class="row g-4 my-2">
            <div class="col-md-6 d-flex align-items-center">
                <i class="ri-user-3-line ri-24px me-2 text-muted"></i>
                <span><strong>Nama Lengkap:</strong> {{ $profile->nama_lengkap }}</span>
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <i class="ri-account-circle-line ri-24px me-2 text-muted"></i>
                <span><strong>Username:</strong> {{ $profile->user->username ?? '-' }}</span>
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <i class="ri-user-smile-line ri-24px me-2 text-muted"></i>
                <span><strong>Nama Panggilan:</strong> {{ $profile->nama_panggil }}</span>
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <i class="ri-calendar-line ri-24px me-2 text-muted"></i>
                <span><strong>Tanggal Lahir:</strong></span> <span>{{ \Carbon\Carbon::parse($profile->tanggal_lahir)->locale('id')->translatedFormat('d F Y') }}</span>

            </div>

            <div class="col-md-6 d-flex align-items-center">
                <i class="ri-user-line ri-24px me-2 text-muted"></i>
                <span><strong>Jenis Kelamin:</strong>
  {{ $profile->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
</span>
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <i class="ri-book-2-line ri-24px me-2 text-muted"></i>
                <span><strong>Pendidikan Asal:</strong> {{ $profile->pendidikan_asal }}</span>
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <i class="ri-map-pin-line ri-24px me-2 text-muted"></i>
                <span><strong>Alamat:</strong> {{ $profile->alamat }}</span>
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <i class="ri-phone-line ri-24px me-2 text-muted"></i>
                <span><strong>No Telepon:</strong> {{ $profile->no_telepon }}</span>
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <i class="ri-mail-line ri-24px me-2 text-muted"></i>
                <span><strong>Email:</strong> {{ $profile->email }}</span>
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <i class="ri-user-2-line ri-24px me-2 text-muted"></i>
                <span><strong>Nama Ayah:</strong> {{ $profile->nama_ayah }}</span>
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <i class="ri-briefcase-line ri-24px me-2 text-muted"></i>
                <span><strong>Pekerjaan Ayah:</strong> {{ $profile->pekerjaan_ayah }}</span>
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <i class="ri-phone-line ri-24px me-2 text-muted"></i>
                <span><strong>No HP Ayah:</strong> {{ $profile->no_hp_ayah }}</span>
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <i class="ri-user-2-line ri-24px me-2 text-muted"></i>
                <span><strong>Nama Ibu:</strong> {{ $profile->nama_ibu }}</span>
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <i class="ri-briefcase-line ri-24px me-2 text-muted"></i>
                <span><strong>Pekerjaan Ibu:</strong> {{ $profile->pekerjaan_ibu }}</span>
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <i class="ri-phone-line ri-24px me-2 text-muted"></i>
                <span><strong>No HP Ibu:</strong> {{ $profile->no_hp_ibu }}</span>
            </div>
            </div>

        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profil</a>
            </div>
        </div>
    </div>
    <!--/ About User -->
    </div>
</div>
@endsection
