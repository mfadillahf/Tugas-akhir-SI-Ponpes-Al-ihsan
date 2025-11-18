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

            <!-- Kiri: Sambutan dan Info Akademik -->
            <div class="col-md-8 order-2 order-md-1">
                <h5 class="mb-2">
                    Selamat Datang, <span class="h4 fw-semibold">{{ auth()->user()->username }} 👋🏻</span>
                </h5>

                {{-- Cek status santri --}}
                @if ($santri->status === 'santri')
                    <p class="mb-4 text-muted">Berikut Informasi Data Akademik Anda</p>

                    <div class="row g-4">
                        {{-- Rata-rata Nilai --}}
                        <div class="col-sm-6 col-lg-4">
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

                        {{-- Jumlah Mata Pelajaran Dinilai --}}
                        <div class="col-sm-6 col-lg-4">
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

                        {{-- Status SPP Bulan Ini --}}
                        <div class="col-sm-6 col-lg-4">
                            @if($sppBulanIni)
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg me-3">
                                        <div class="avatar-initial bg-label-warning rounded-3">
                                            <img src="{{ asset('assets/svg/icons/credit-card.svg') }}" alt="spp" class="img-fluid" />
                                        </div>
                                    </div>
                                    <div>
                                        <p class="mb-1 fw-medium">
                                            Status SPP Bulan Ini ({{ \Carbon\Carbon::create()->month($sppBulanIni->bulan)->format('F') }})
                                        </p>
                                        @if($sppBulanIni->status == 'lunas')
                                            <h5 class="mb-0 text-success">Lunas</h5>
                                        @else
                                            <h5 class="mb-0 text-danger">Belum</h5>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning mb-0">
                                    Data SPP bulan ini belum tersedia.
                                </div>
                            @endif
                        </div>
                    </div> >
                @endif 
            </div>

            <!-- Kanan: Logo Ponpes -->
            <div class="col-md-4 text-center text-md-end order-1 order-md-2">
                <div class="pe-md-4 pt-2">
                    <img src="{{ asset('public/assets/img/illustrations/logo_ponpes.png') }}" height="150" alt="Logo Ponpes" class="scaleX-n1-rtl">
                </div>
            </div>

        </div> <!-- Tutup d-flex align-items-start row -->
    </div> <!-- Tutup card-body -->
</div> <!-- Tutup card -->
@endsection
