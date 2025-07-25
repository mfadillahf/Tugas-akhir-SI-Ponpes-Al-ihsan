@extends('layouts/layoutMaster')

@section('title')
Dashboard Santri
@endsection

@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/apex-charts/apex-charts.scss'
])
@endsection

@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/apex-charts/apexcharts.js'
])
@endsection

@section('page-script')
@vite('resources/assets/js/app-academy-dashboard.js')
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-start row">
      <!-- Kiri: Sambutan -->
      <div class="col-md-8 order-2 order-md-1">
        <h5 class="mb-2">Selamat Datang,
          <span class="h4 fw-semibold">{{ auth()->user()->username }} 👋🏻</span>
        </h5>

        {{-- Cek status santri --}}
        @if ($santri->status === 'santri')
          <p class="mb-4 text-muted">Berikut Informasi Data Akademik Anda</p>
          <div class="row g-4">
            {{-- Rata-rata nilai --}}
            <div class="col-sm-6 col-lg-6">
              <div class="d-flex align-items-center">
                <div class="avatar avatar-lg me-3">
                  <div class="avatar-initial bg-label-primary rounded-3">
                    <img src="{{ asset('assets/svg/icons/laptop.svg') }}" alt="laptop" class="img-fluid" />
                  </div>
                </div>
                <div>
                  <p class="mb-1 fw-medium">Rata-Rata Nilai</p>
                  <h5 class="mb-0 text-primary">{{ $rataRataNilai }}</h5>
                </div>
              </div>
            </div>

            {{-- Jumlah Surah --}}
            <div class="col-sm-6 col-lg-6">
              <div class="d-flex align-items-center">
                <div class="avatar avatar-lg me-3">
                  <div class="avatar-initial bg-label-info rounded-3">
                    <img src="{{ asset('assets/svg/icons/lightbulb.svg') }}" alt="lightbulb" class="img-fluid" />
                  </div>
                </div>
                <div>
                  <p class="mb-1 fw-medium">Jumlah Mata Pelajaran Dinilai</p>
                  <h5 class="mb-0 text-info">{{ $jumlahSurah }}</h5>
                </div>
              </div>
            </div>
          </div>
        @else
          {{-- Tampilan untuk calon santri --}}
          <p class="text-muted mb-4">Status kamu saat ini <strong>{{ ucfirst($santri->status) }} Santri</strong>.</p>
          <div class="alert alert-info">
            Data akademik hanya dapat diakses setelah status kamu resmi menjadi <strong>santri aktif</strong>.
            Tunggu informasi lebih lanjut.
          </div>
        @endif
      </div>

      <!-- Kanan: Logo -->
      <div class="col-md-4 text-center text-md-end order-1 order-md-2">
        <div class="pe-md-4 pt-2">
          <img src="{{ asset('public/assets/img/illustrations/logo_ponpes.png') }}"
               height="150"
               alt="Logo Ponpes"
               class="scaleX-n1-rtl">
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
