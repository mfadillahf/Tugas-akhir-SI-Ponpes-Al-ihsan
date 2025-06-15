@extends('layouts.landing')

@section('title', $tentang->judul)

@section('content')
<!-- Section: Page Title -->
<section class="page-title layer-overlay overlay-dark-9 section-typo-light bg-img-center" style="padding-top: 120px;" data-tm-bg-img="{{ asset('LandingPage/studypress/images/bg/bg1.jpg') }}">
    <div class="container pt-50 pb-50">
        <div class="section-content">
        <div class="row">
          <div class="col-md-12">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                    <h2 class="title">Tentang Pesantren Al-Ihsan</h2>
                    </div>
                    <div class="col-md-6 text-end">
                    <nav class="breadcrumbs" role="navigation" aria-label="Breadcrumbs">
                        <div class="breadcrumbs">
                        <span><a href="{{ route('landing') }}">Beranda</a></span>
                        <span><i class="fa fa-angle-right mx-2"></i></span>
                        <span class="active">Tentang</span>
                        </div>
                    </nav>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>

<!-- Section: Tentang -->
<section class="py-5">
  <div class="container mt-30 mb-30 pt-30 pb-30">
    <div class="row">

      <!-- Konten Tentang -->
      <div class="col-md-9">
        <div class="blog-posts single-post">
          <article class="post clearfix mb-0">
            <div class="entry-header">
              @if($tentang->gambar)
              <div class="post-thumb thumb mb-3">
                <img src="{{ asset('storage/tentang/' . $tentang->gambar) }}" alt="{{ $tentang->judul }}" class="img-responsive img-fullwidth rounded shadow">
              </div>
              @endif
            </div>
            <div class="entry-content">
              <div class="entry-meta d-flex no-bg no-border mt-15 pb-20">
                <div class="media-body">
                  <h3 class="entry-title pt-0 mt-0">{{ $tentang->judul }}</h3>
                </div>
              </div>
              <article class="content" style="line-height: 1.8; font-size: 1.1rem;">
                {!! $tentang->deskripsi !!}
              </article>
              <div class="mt-4">
                <a href="{{ route('landing') }}" class="btn btn-theme-colored1 btn-sm">← Kembali ke Beranda</a>
              </div>
            </div>
          </article>
        </div>
      </div>

      <!-- Sidebar Berita Lainnya -->
      <div class="col-md-3">
        <div class="sidebar sidebar-right mt-sm-30">
          <div class="widget">
            <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1">Berita Lainnya</h4>
            <div class="latest-posts">
              @foreach ($beritaLain as $item)
              <article class="post clearfix pb-0 mb-20">
                <a class="post-thumb" href="{{ route('berita.detail', $item->id_berita) }}">
                  <img src="{{ asset('storage/berita/' . $item->foto) }}" alt="{{ $item->judul }}" style="width: 70px; height: 70px; object-fit: cover;" class="rounded shadow-sm">
                </a>
                <div class="post-right">
                  <h5 class="post-title mt-0 mb-1">
                    <a href="{{ route('berita.detail', $item->id_berita) }}">{{ $item->judul }}</a>
                  </h5>
                  <span class="post-date small text-muted">
                    <i class="far fa-calendar-alt me-1"></i> {{ $item->created_at->format('d M Y') }}
                  </span>
                </div>
              </article>
              @endforeach
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection
