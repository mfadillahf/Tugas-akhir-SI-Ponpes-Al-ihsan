@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Dashboard Donatur')

@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/apex-charts/apex-charts.scss'
])
@endsection

@section('page-style')
@vite([
    'resources/assets/vendor/scss/pages/cards-statistics.scss'
])
@endsection

@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/apex-charts/apexcharts.js'
])
@endsection

@section('page-script')
@vite(['resources/assets/js/dashboards-analytics.js'])
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
                <p class="mb-0">Berikut ringkasan dari donasi Anda.</p>
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

    <!-- Total Donasi Card -->
    <div class="col-xxl-2 col-sm-6">
        <div class="card h-100">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
            <div class="avatar">
                <div class="avatar-initial bg-label-primary rounded-3">
                <i class="ri-wallet-3-line ri-24px"></i>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <p class="mb-0 text-success me-1">+{{ $persentaseKenaikan ?? 0 }}%</p>
                <i class="ri-arrow-up-s-line text-success"></i>
            </div>
            </div>
            <div class="card-info mt-5">
            <h5 class="mb-1">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</h5>
            <p>Total Donasi Anda</p>
            <div class="badge bg-label-secondary rounded-pill">Terupdate</div>
            </div>
        </div>
        </div>
    </div>

    <!-- Grafik Donasi Bulanan -->
    <div class="col-xxl-2 col-sm-6">
        <div class="card h-100">
        <div class="card-header pb-0">
            <div class="d-flex align-items-center mb-1 flex-wrap">
            <h5 class="mb-0 me-1">Rp {{ number_format($totalBulanIni ?? 0, 0, ',', '.') }}</h5>
            <p class="mb-0 text-success">+{{ $persentaseKenaikan ?? 0 }}%</p>
            </div>
            <span class="d-block card-subtitle">Donasi Bulan Ini</span>
        </div>
        <div class="card-body">
            <div id="sessions"></div>
        </div>
        </div>
    </div>
</div>
@endsection
