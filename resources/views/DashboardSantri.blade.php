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
    <div class="card-body row g-4">
        <div class="col-12">
        <h5 class="mb-2">Selamat Datang,
            <span class="h4 fw-semibold">{{ auth()->user()->username }} 👋🏻</span>
        </h5>

        {{-- Cek status santri --}}
        @if ($santri->status === 'santri')
            <p class="mb-4 text-muted">Berikut Informasi Data Akademik Anda</p>
            <div class="row g-4">
            {{-- Rata-rata nilai --}}
            <div class="col-sm-4">
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
            <div class="col-sm-4">
                <div class="d-flex align-items-center">
                <div class="avatar avatar-lg me-3">
                    <div class="avatar-initial bg-label-info rounded-3">
                    <img src="{{ asset('assets/svg/icons/lightbulb.svg') }}" alt="lightbulb" class="img-fluid" />
                    </div>
                </div>
                <div>
                    <p class="mb-1 fw-medium">Jumlah Surah Dihafal</p>
                    <h5 class="mb-0 text-info">{{ $jumlahSurah }}</h5>
                </div>
                </div>
            </div>

            {{-- Mapel --}}
            <div class="col-sm-4">
                <div class="d-flex align-items-start">
                <div class="avatar avatar-lg me-3">
                    <div class="avatar-initial bg-label-warning rounded-3">
                    <img src="{{ asset('assets/svg/icons/check.svg') }}" alt="check" class="img-fluid" />
                    </div>
                </div>
                <div>
                    <p class="mb-1 fw-medium">Mata Pelajaran Dinilai</p>
                    @if ($mapelList->isNotEmpty())
                    <ul class="mb-0 list-unstyled small">
                        @foreach ($mapelList as $mapel)
                        <li class="text-warning">{{ $mapel }}</li>
                        @endforeach
                    </ul>
                    @else
                    <span class="text-muted small">Belum ada mapel</span>
                    @endif
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
    </div>
    </div>
@endsection
