@extends('layouts.landing')

@section('title', 'Laporan Infaq')

@section('content')
<!-- Section: page title -->
<section class="page-title layer-overlay overlay-dark-9 section-typo-light bg-img-center" style="padding-top: 120px;" data-tm-bg-img="{{ asset('LandingPage/studypress/images/bg/bg1.jpg') }}">
    <div class="container pt-50 pb-50">
        <div class="section-content">
        <div class="row">
            <div class="col-md-12">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                <h2 class="title">Laporan Infaq</h2>
                </div>
                <div class="col-md-6 text-end">
                <nav class="breadcrumbs" role="navigation" aria-label="Breadcrumbs">
                    <div class="breadcrumbs">
                    <span><a href="{{ route('landing') }}">Beranda</a></span>
                    <span><i class="fa fa-angle-right mx-2"></i></span>
                    <span class="active">Laporan Infaq</span>
                    </div>
                </nav>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>

<!-- Section: Laporan Infaq -->
<section id="laporan">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <!-- Tabel -->
                <div class="flex-grow-1 table-responsive">
                <table class="table table-bordered m-0 text-center align-middle h-100">
                    <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Dari</th>
                        <th>Total Infaq</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($laporan as $index => $laporaninfaq)
                        <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($laporaninfaq->tanggal_terakhir)->translatedFormat('d F Y') }}</td>
                        <td>{{ $laporaninfaq->nama ?? 'Hamba Allah' }}</td>
                        <td>Rp {{ number_format($laporaninfaq->total_infaq, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                        <td colspan="4">Belum ada infaq bulan ini.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                </div>
				<div class="mt-3">
				  {{ $laporan->links('pagination::bootstrap-5') }}
				</div>
            </div>
        </div>
    </div>
    </section>
@endsection