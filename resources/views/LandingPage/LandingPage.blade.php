@extends('layouts.landing')

@section('content')
<body class="tm-container-1340px has-side-panel side-panel-right">

{{-- slider --}}
@include('partials.slider')

<!-- Section: About -->
<section id="about" class="bg-silver-light">
    <div class="container">
        <div class="section-content">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <h6 class="letter-space-4 text-gray-darkgray text-uppercase mt-0 mb-0">Tentang Kami</h6>
                    <h2 class="text-uppercase mt-0 line-bottom line-bottom-theme-colored1">{{ $tentang->judul ?? '-' }}</h2>
                    <h4></h4>
                    <p>{!! $tentang->deskripsi ?? '-' !!}</p>
                    <a href="{{ route('landing.tentang') }}" class="btn btn-sm btn-theme-colored2 text-white mb-md-40">Selengkapnya</a>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    @if ($tentang && $tentang->gambar)
                        <img class="w-100 rounded" src="{{ asset('storage/tentang/' . $tentang->gambar) }}" alt="Foto Tentang">
                    @else
                        <img class="w-100 rounded" src="{{ asset('studypress/images/about/default.jpg') }}" alt="Foto Default">
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Section: Staff -->
<section id="teachers" class="bg-white-f5">
    <div class="container">
        <div class="section-title">
        <div class="row">
            <div class="col-md-8">
            <div class="mb-60">
                <div class="tm-sc tm-sc-section-title section-title">
                <div class="title-wrapper">
                    <h2 class="text-uppercase line-bottom line-bottom-theme-colored1">
                    Kepengurusan <span class="text-theme-colored1"></span>
                    </h2>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>

        <div class="section-content">
        <div class="row">
            <div class="col-12">
            <div class="tm-sc-staff tm-sc-staff-carousel staff-style3-modern owl-dots-light-skin owl-dots-center">
                <div id="staff-holder-945632" class="owl-carousel owl-theme tm-owl-carousel-4col"
                data-nav="true" data-dots="true" data-autoplay="true" data-loop="true"
                data-duration="6000" data-smartspeed="300" data-margin="30" data-stagepadding="0">

                @forelse ($kepengurusan as $item)
                <div class="tm-carousel-item">
                    <div class="tm-staff">
                    <div class="staff-inner">
                        <div class="box-hover-effect">
                        <div class="staff-header effect-wrapper">
                            <div class="thumb">
                            <img alt="{{ $item->nama }}" src="{{ asset('storage/kepengurusan/' . $item->foto) }}" class="img-fullwidth" style="height: 300px; object-fit: cover;">
                            </div>
                        </div>
                        <div class="staff-content text-center">
                            <h5 class="name">{{ $item->nama }}</h5>
                            <div class="speciality">{{ $item->jabatan }}</div>
                            <p class="mb-0">Periode:</p>
                            <p>{{ $item->mulai }} s.d {{ $item->akhir }}</p>

                            <div class="staff-btn">
                                <div class="clearfix"></div>
                            </div>

                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                @empty
                <div class="tm-carousel-item">
                    <div class="text-center">Belum ada data kepengurusan yang tersedia.</div>
                </div>
                @endforelse

                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>


        @include('partials.gallery')

    <!-- Section: News -->
    <section id="blog" class="bg-silver-light">
        <div class="container">
            <div class="section-title">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-60">
                            <div class="tm-sc-blog blog-style-default mb-lg-30">
                                <div class="title-wrapper">
                                    <h2 class="text-uppercase line-bottom line-bottom-theme-colored1">
                                        Berita <span class="text-theme-colored2">Terkini</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- berita --}}
            <div class="section-content">
                <div class="row">
                    @foreach ($berita as $item)
                    <div class="col-md-6 col-lg-6 col-xl-3 d-flex">
                        <div class="tm-sc-blog blog-style-default mb-lg-30 w-100 d-flex flex-column">
                            <article class="post type-post status-publish format-standard has-post-thumbnail d-flex flex-column h-100">
                                <div class="entry-header">
                                    <div class="post-thumb lightgallery-lightbox">
                                        <div class="post-thumb-inner">
                                            <div class="thumb">
                                                <img class="w-100" style="height: 200px; object-fit: cover;" src="{{ asset('storage/berita/' . $item->foto) }}" alt="{{ $item->judul }}">
                                            </div>
                                        </div>
                                    </div>
                                    <a class="link" href="{{ route('berita.detail', $item->id_berita) }}"><i class="fa fa-link"></i></a>
                                </div>

                                <div class="entry-content d-flex flex-column flex-grow-1">
                                    <h4 class="entry-title">
                                        <a href="{{ route('berita.detail', $item->id_berita) }}" rel="bookmark">
                                            {{ str($item->judul)->limit(60) }}
                                        </a>
                                    </h4>
                                    <div class="entry-meta mt-0 mb-2">
                                        <span class="text-gray-darkgray font-size-13 d-block">
                                            <i class="far fa-calendar-alt mr-5 text-theme-colored1"></i>
                                            {{ $item->created_at->format('M d, Y') }}
                                        </span>
                                        <span class="text-gray-darkgray font-size-13">
                                            <i class="far fa-user-circle mr-5 text-theme-colored1"></i> Admin
                                        </span>
                                    </div>

                                    <div class="post-excerpt mb-2 flex-grow-1">
                                        <div class="mascot-post-excerpt">
                                            {{ str(strip_tags($item->isi))->limit(100) }}
                                        </div>
                                    </div>

                                    <div class="post-btn-readmore mt-auto">
                                        <a href="{{ route('berita.detail', $item->id_berita) }}" class="btn btn-plain-text-with-arrow">Selengkapnya</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @include('partials.contact')
</div>
</body>
@push('scripts')
<script>
    $(document).ready(function(){
        $('#staff-holder-945632').owlCarousel({
            nav: true,
            dots: true,
            autoplay: true,
            loop: true,
            autoplayTimeout: 6000,
            smartSpeed: 300,
            margin: 30,
            responsive:{
                0:{ items:1 },
                600:{ items:2 },
                1000:{ items:4 }
            }
        });
    });
</script>
@endpush
@endsection
