@extends('layouts.landing')

@section('title', 'Kepengurusan')

@section('content')
<!-- Section: page title -->
<section class="page-title layer-overlay overlay-dark-9 section-typo-light bg-img-center" style="padding-top: 120px;" data-tm-bg-img="{{ asset('LandingPage/studypress/images/bg/bg1.jpg') }}">
    <div class="container pt-50 pb-50">
        <div class="section-content">
			<div class="row">
			  <div class="col-12 col-md-6 text-center text-md-start mb-2 mb-md-0">
				<h2 class="title mb-2">Struktur Kepengurusan</h2>
			  </div>
			  <div class="col-12 col-md-6 text-center text-md-end">
				<nav class="breadcrumbs d-inline-block" role="navigation" aria-label="Breadcrumbs">
				  <div class="breadcrumbs">
					<span><a href="{{ route('landing') }}">Beranda</a></span>
					<span><i class="fa fa-angle-right mx-2"></i></span>
					<span class="active">Kepengurusan</span>
				  </div>
				</nav>
			  </div>
			</div>
        </div>
    </div>
</section>

<!-- Section: Kepengurusan List -->
<section id="team" class="pt-50 pb-50">
    <div class="container">
        <div class="row mtli-row-clearfix">
        @forelse($kepengurusan as $item)
            <div class="col-xs-12 col-sm-6 col-md-3 sm-text-center mb-30 mb-sm-30">
            <div class="team-members maxwidth400">
                <div class="team-thumb">
                <img class="img-fullwidth" alt="{{ $item->nama }}" src="{{ asset('storage/app/public/kepengurusan/' . $item->foto) }}" style="height: 270px; object-fit: cover;">
            </div>
            <div class="team-bottom-part border-bottom-theme-color-2-2px bg-lighter border-1px text-center p-10 pt-20 pb-10">
                <h4 class="text-uppercase font-raleway font-weight-600 m-0">
                    <span class="text-theme-color-2">{{ $item->nama }}</span>
                </h4>
                <h5 class="text-theme-color1 mb-20">{{ $item->jabatan }}</h5>
                <p class="small text-muted mb-10">
                    Periode: <br>
                    {{ \Carbon\Carbon::parse($item->mulai)->locale('id')->translatedFormat('d F Y') }}
                    s.d
                    {{ \Carbon\Carbon::parse($item->akhir)->locale('id')->translatedFormat('d F Y') }}
                </p>
            </div>
        </div>
        </div>
        @empty
            <div class="col-12 text-center">
            <p>Belum ada data kepengurusan yang tersedia.</p>
            </div>
        @endforelse
    </div>
    </div>
</section>
@endsection
