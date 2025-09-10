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
			<div class="col-md-12 col-lg-6 col-xl-6 order-1 order-lg-2 mb-4 mb-lg-0">
				@if ($tentang && $tentang->gambar)
					<img class="w-100 rounded" src="{{ asset('storage/app/public/tentang/' . $tentang->gambar) }}" alt="Foto Tentang">
				@else
					<img class="w-100 rounded" src="{{ asset('studypress/images/about/default.jpg') }}" alt="Foto Default">
				@endif
			</div>
			<div class="col-md-12 col-lg-6 col-xl-6 order-2 order-lg-1">
				<h6 class="letter-space-4 text-gray-darkgray text-uppercase mt-0 mb-0">Tentang Kami</h6>
				<h2 class="text-uppercase mt-0 line-bottom line-bottom-theme-colored1">{{ $tentang->judul ?? '-' }}</h2>
				<h4></h4>
				<p>{!! $tentang->deskripsi ?? '-' !!}</p>
				<a href="{{ route('landing.tentang') }}" class="btn btn-sm btn-theme-colored2 text-white mb-md-40">Selengkapnya</a>
			</div>
		</div>
        </div>
    </div>
</section>

	
<!-- Section: Funfacts -->
<section class="layer-overlay overlay-theme-colored1-9 bg-no-repeat bg-pos-center-center"
         data-tm-bg-img="{{ asset('LandingPage/studypress/images/bg/bg2.jpg') }}">
  <div class="container pt-100 pb-100">
    <div class="section-content">
      <div class="row justify-content-center">

        <!-- Total Santri -->
        <div class="col-md-6 col-lg-4 col-xl-4">
          <div class="funfact-item text-center mb-md-60">
            <i class="funfact-icon pe-7s-users text-white"></i>
            <h2 data-animation-duration="2000"
                data-value="{{ $totalSantri }}"
                class="text-white counter animate-number mt-0 mb-10">0</h2>
            <p class="text-white title mb-0">Total Santri</p>
          </div>
        </div>

        <!-- Total Guru -->
        <div class="col-md-6 col-lg-4 col-xl-4">
          <div class="funfact-item text-center mb-md-60">
            <i class="funfact-icon pe-7s-id text-white"></i>
            <h2 data-animation-duration="2000"
                data-value="{{ $totalGuru }}"
                class="text-white counter animate-number mt-0 mb-10">0</h2>
            <p class="text-white title mb-0">Total Guru</p>
          </div>
        </div>

        <!-- Total Kepengurusan -->
        <div class="col-md-6 col-lg-4 col-xl-4">
          <div class="funfact-item text-center mb-md-60">
            <i class="funfact-icon pe-7s-id text-white"></i>
            <h2 data-animation-duration="2000"
                data-value="{{ $totalKepengurusan }}"
                class="text-white counter animate-number mt-0 mb-10">0</h2>
            <p class="text-white title mb-0">Total Pengurus</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>


<!-- Section: Staff -->
<section id="teachers">
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
        @forelse ($kepengurusan as $item)
          <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
            <div class="staff-item mb-lg-40">
              <div class="staff-thumb">
                <img alt="{{ $item->nama }}" src="{{ asset('storage/app/public/kepengurusan/' . $item->foto) }}" class="w-100" style="height: 					300px; object-fit: cover;">
              </div>
              <div class="staff-content">
                <h4 class="staff-name text-theme-colored1 mt-0">{{ $item->nama }}<small> - {{ $item->jabatan }}</small></h4>
                <p class="mb-2">Periode:</p>
                <p class="mb-20">
                  {{ \Carbon\Carbon::parse($item->mulai)->locale('id')->translatedFormat('d F Y') }}
                  s.d
                  {{ \Carbon\Carbon::parse($item->akhir)->locale('id')->translatedFormat('d F Y') }}
                </p>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12">
            <div class="text-center">Belum ada data kepengurusan yang tersedia.</div>
          </div>
        @endforelse
		  	<div class="col-12 text-center mt-4">
			  <a href="{{ route('landing.kepengurusan') }}" class="btn btn-theme-colored2 text-white">Selengkapnya</a>
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
                                                <img class="w-100" style="height: 200px; object-fit: cover;" src="{{ asset('storage/app/public/berita/' . $item->foto) }}" alt="{{ $item->judul }}">
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
                                            {{ $item->created_at->locale('id')->translatedFormat('d F Y') }}
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
	
<!-- Section: Laporan Infaq -->
@if($setting?->show_laporan_infaq)
<section id="laporan" class="layer-overlay overlay-theme-colored1-9 bg-no-repeat bg-pos-center-center"
         data-tm-bg-img="{{ asset('LandingPage/studypress/images/bg/bg2.jpg') }}">
  <div class="container pt-100 pb-100">
    <div class="section-content">
      <div class="text-center mb-5">
        <h2 class="text-white fw-bold">Laporan Infaq Bulan Ini</h2>
        <p class="text-white">Data donatur dan nominal infaq yang masuk selama bulan ini.</p>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-10">
          <!-- Flex: tabel dan card menyatu dan sejajar -->
          <div class="d-lg-flex border rounded overflow-hidden bg-white shadow-sm">
            
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
                  @forelse ($laporanInfaq as $index => $infaq)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ \Carbon\Carbon::parse($infaq->tanggal_terakhir)->translatedFormat('d F Y') }}</td>
                      <td>{{ $infaq->nama ?? 'Hamba Allah' }}</td>
                      <td>Rp {{ number_format($infaq->total_infaq, 0, ',', '.') }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="4">Belum ada infaq bulan ini.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            <!-- Card -->
			 <div class="border-start bg-light p-4 d-flex align-items-center justify-content-center" style="min-width: 250px;">
              <div class="text-center">
                <h6 class="text-muted mb-1">Total Pemasukan</h6>
				   <h4 class="fw-bold text-danger mb-0">
					  Rp {{ number_format($totalInfaq, 0, ',', '.') }}
					</h4>
                <a href="{{ route('laporan.infaq') }}" class="btn btn-sm btn-theme-colored1 text-white mt-3">
                  Lihat Semua Pemasukan
                </a>
              </div>
            </div>

          </div> <!-- end d-flex -->
        </div>
      </div>
    </div>
  </div>
</section>
@endif
	
<!-- Section: Laporan Pengeluaran -->
@if($setting?->show_laporan_pengeluaran)
<section id="pengeluaran" class="layer-overlay overlay-theme-colored2-9 bg-no-repeat bg-pos-center-center"
         data-tm-bg-img="{{ asset('LandingPage/studypress/images/bg/bg3.jpg') }}">
  <div class="container pt-100 pb-100">
    <div class="section-content">
      <div class="text-center mb-5">
        <h2 class="text-white fw-bold">Laporan Pengeluaran Bulan Ini</h2>
        <p class="text-white">Data pengeluaran dan kebutuhan selama bulan ini.</p>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-10">
          <!-- Flex: tabel dan card menyatu dan sejajar -->
          <div class="d-lg-flex border rounded overflow-hidden bg-white shadow-sm">
            
            <!-- Tabel -->
            <div class="flex-grow-1 table-responsive">
              <table class="table table-bordered m-0 text-center align-middle h-100">
                <thead class="table-dark">
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Nominal</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($laporanPengeluaran as $index => $item)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                      <td>{{ $item->keterangan }}</td>
                      <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="4">Belum ada pengeluaran bulan ini.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            <!-- Card Total -->
            <div class="border-start bg-light p-4 d-flex align-items-center justify-content-center" style="min-width: 250px;">
              <div class="text-center">
                <h6 class="text-muted mb-1">Total Pengeluaran</h6>
				   <h4 class="fw-bold text-danger mb-0">
					  Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
				</h4>
                <a href="{{ route('laporan.pengeluaran') }}" class="btn btn-sm btn-theme-colored2 text-white mt-3">
                  Lihat Semua Pengeluaran
                </a>
              </div>
            </div>

          </div> <!-- end d-flex -->
        </div>
      </div>
    </div>
  </div>
</section>
@endif
    @include('partials.contact')
</div>
</body>

@endsection
