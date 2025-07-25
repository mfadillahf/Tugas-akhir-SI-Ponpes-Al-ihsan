@php
    $configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')

@section('title', 'Dashboard - Admin')

@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/apex-charts/apex-charts.scss',
    'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss'
    ])
@endsection

@section('page-style')
@vite('resources/assets/vendor/scss/pages/app-logistics-dashboard.scss')
@endsection

@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/apex-charts/apexcharts.js',
    'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'
    ])
@endsection

@section('page-script')
@vite('resources/assets/js/app-logistics-dashboard.js')
@endsection

@section('content')
<div class="row g-6">
    <!-- Welcome Card -->
    <div class="col-md-12 col-xxl-8">
        <div class="card">
        <div class="d-flex align-items-start row">
            <div class="col-md-6 order-2 order-md-1">
            <div class="card-body">
                <h4 class="card-title mb-4">Selamat Datang, <span class="fw-bold">{{ auth()->user()->username }}</span> 👋</h4>
            </div>
            </div>
            <div class="col-md-6 text-center text-md-end order-1 order-md-2">
            <div class="card-body pb-0 px-0 pt-2 me-4">
               <img src="{{ asset('public/assets/img/illustrations/logo_ponpes.png') }}" 
					 height="186" 
					 class="scaleX-n1-rtl" 
					 alt="Welcome">
            </div>
            </div>
        </div>
        </div>
    </div>

<!-- Statistik Cards -->
<div class="row g-4">
  <div class="col-sm-6 col-lg-3">
    <div class="card card-border-shadow-primary h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2">
          <div class="avatar me-4">
            <span class="avatar-initial rounded-3 bg-label-primary"><i class="ri-group-3-line"></i></span>
          </div>
          <h4 class="mb-0">{{ $jumlahSantri }}</h4>
        </div>
        <h6 class="mb-0 fw-normal">Jumlah Santri</h6>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">
    <div class="card card-border-shadow-success h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2">
          <div class="avatar me-4">
            <span class="avatar-initial rounded-3 bg-label-success"><i class="ri-user-2-fill"></i></span>
          </div>
          <h4 class="mb-0">{{ $jumlahGuru }}</h4>
        </div>
        <h6 class="mb-0 fw-normal">Jumlah Guru</h6>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">
    <div class="card card-border-shadow-warning h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2">
          <div class="avatar me-4">
            <span class="avatar-initial rounded-3 bg-label-warning"><i class="ri-user-2-line"></i></span>
          </div>
          <h4 class="mb-0">{{ $jumlahDonatur }}</h4>
        </div>
        <h6 class="mb-0 fw-normal">Jumlah Donatur</h6>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">
    <div class="card card-border-shadow-danger h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2">
          <div class="avatar me-4">
            <span class="avatar-initial rounded-3 bg-label-danger"><i class="ri-group-line"></i></span>
          </div>
          <h4 class="mb-0">{{ $jumlahPengurus }}</h4>
        </div>
        <h6 class="mb-0 fw-normal">Jumlah Pengurus</h6>
      </div>
    </div>
  </div>
</div>
</div>
<!-- /Statistik Cards -->

@endsection
