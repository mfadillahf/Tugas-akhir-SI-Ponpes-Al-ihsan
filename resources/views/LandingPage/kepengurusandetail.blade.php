@extends('layouts.landing')

@section('title', $kepengurusan->nama)

@section('content')
<!-- Section: Page Title -->
<section class="page-title layer-overlay overlay-dark-9 section-typo-light bg-img-center" 
    style="padding-top: 120px;" 
    data-tm-bg-img="{{ asset('LandingPage/studypress/images/bg/bg1.jpg') }}">
    <div class="container pt-90 pb-90">
        <div class="section-content">
            <div class="row">
                <div class="col-12 col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <h2 class="title mb-2">Detail Profil Kepengurusan</h2>
                </div>
                <div class="col-12 col-md-6 text-center text-md-end">
                    <nav class="breadcrumbs d-inline-block" role="navigation" aria-label="Breadcrumbs">
                        <div class="breadcrumbs">
                            <span><a href="{{ route('landing') }}">Beranda</a></span>
                            <span><i class="fa fa-angle-right mx-2"></i></span>
                            <span><a href="{{ route('landing.kepengurusan') }}">Kepengurusan</a></span>
                            <span><i class="fa fa-angle-right mx-2"></i></span>
                            <span class="active">{{ $kepengurusan->nama }}</span>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section: Detail -->
<section>
    <div class="container mt-30 mb-30">
        <div class="row">
        
        <!-- Kolom Kiri (Foto + Tentang) -->
        <div class="col-md-4">
            <div class="thumb text-center mb-4">
            <img src="{{ asset('storage/' . $kepengurusan->foto) }}" alt="{{ $kepengurusan->nama }}" 
                class="img-fluid rounded shadow" style="max-width: 220px;">
            </div>

            <h4 class="line-bottom">Tentang</h4>
            <ul class="list-unstyled">
            <li class="mb-3 d-flex align-items-start">
                <i class="pe-7s-id text-theme-colored font-size-20 me-2"></i>
                <div>
                <strong>Jabatan:</strong><br>{{ $kepengurusan->jabatan }}
                </div>
            </li>
            <li class="mb-3 d-flex align-items-start">
                <i class="pe-7s-study text-theme-colored font-size-20 me-2"></i>
                <div>
                <strong>Pendidikan:</strong><br>{{ $kepengurusan->pendidikan }}
                </div>
            </li>
            </ul>
        </div>


    <div class="col-md-8">
        <h3 class="mt-0">{{ $kepengurusan->nama }}</h3>

        <h4 class="line-bottom mt-3">Profil Singkat</h4>
        <p>{!! nl2br(e($kepengurusan->profil_singkat)) !!}</p>
    </div>

    </div>
  </div>
</section>
@endsection
