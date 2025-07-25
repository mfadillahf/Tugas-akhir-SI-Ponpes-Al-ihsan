@extends('layouts.landing')

@section('title', 'Galeri')

@section('content')
    <!-- Section: page title -->
    <section class="page-title layer-overlay overlay-dark-9 section-typo-light bg-img-center" style="padding-top: 120px;" data-tm-bg-img="{{ asset('LandingPage/studypress/images/bg/bg1.jpg') }}">
        <div class="container pt-50 pb-50">
            <div class="section-content">
				<div class="row">
				  <div class="col-12 col-md-6 text-center text-md-start mb-2 mb-md-0">
					<h2 class="title mb-2">Galeri Pesantren Al-Ihsan</h2>
				  </div>
				  <div class="col-12 col-md-6 text-center text-md-end">
					<nav class="breadcrumbs d-inline-block" role="navigation" aria-label="Breadcrumbs">
					  <div class="breadcrumbs">
						<span><a href="{{ route('landing') }}">Beranda</a></span>
						<span><i class="fa fa-angle-right mx-2"></i></span>
						<span class="active">Galeri</span>
					  </div>
					</nav>
				  </div>
				</div>
            </div>
        </div>
    </section>

    <!-- Gallery Grid 3 -->
    <section>
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tm-sc-gallery tm-sc-gallery-grid gallery-style1-basic">

                            <!-- Isotope Filter -->
                            <div class="isotope-layout-filter filter-style-4 text-left cat-filter-default text-center" data-link-with="gallery-holder-618422">
                                <a href="#" class="active" data-filter="*">All</a>
                                @foreach ($kategoriGaleri as $kat)
                                    <a href="#" data-filter=".katg-{{ $kat->id }}">{{ $kat->nama_kategori }}</a>
                                @endforeach
                            </div>
                            <!-- End Isotope Filter -->

                            <!-- Isotope Gallery Grid -->
                            <div id="gallery-holder-618422" class="isotope-layout grid-3 gutter-15 clearfix lightgallery-lightbox">
                                <div class="isotope-layout-inner">
                                    @foreach ($galeri as $item)
                                        <div class="isotope-item katg-{{ $item->kategori_galeri_id }}">
                                            <div class="isotope-item-inner">
                                                <div class="tm-gallery">
                                                    <div class="tm-gallery-inner">
                                                        <div class="thumb">
                                                            <a href="#">
                                                                <img width="672" height="448" src="{{ asset('storage/app/public/galeri/' . $item->foto) }}" alt="{{ $item->judul }}" />
                                                            </a>
                                                        </div>
                                                        <div class="tm-gallery-content-wrapper">
                                                            <div class="tm-gallery-content">
                                                                <div class="tm-gallery-content-inner">
                                                                    <div class="icons-holder-inner">
                                                                        <div class="styled-icons icon-dark icon-circled icon-theme-colored1">
                                                                            <a class="lightgallery-trigger styled-icons-item"
                                                                                data-exthumbimage="{{ asset('storage/app/public/galeri/' . $item->foto) }}"
                                                                                data-src="{{ asset('storage/app/public/galeri/' . $item->foto) }}"
                                                                                title="{{ $item->judul }}"
                                                                                href="{{ asset('storage/app/public/galeri/' . $item->foto) }}">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="title-holder">
                                                                        <h5 class="title"><a href="#">{{ $item->judul }}</a></h5>
                                                                        <small class="text-muted">{{ $item->kategoriGaleri->nama_kategori ?? '-' }}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- End Isotope Gallery Grid -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
