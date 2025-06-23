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

<div class="row mb-4">
    <div class="col-12">
        <h4 class="fw-bold">Selamat datang, {{ auth()->user()->username }}</h4>
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
<!-- /Statistik Cards -->

@endsection
