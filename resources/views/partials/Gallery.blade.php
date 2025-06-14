<!-- Gallery Grid 3 -->
<section id="gallery" class="bg-silver-light">
    <div class="container">
        <div class="section-title">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-60">
                        <div class="tm-sc tm-sc-section-title section-title">
                            <div class="title-wrapper">
                                <h2 class="text-uppercase line-bottom line-bottom-theme-colored1">
                                    Galleri <span class="text-theme-colored2">Al-Ihsan</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="tm-sc-gallery tm-sc-gallery-grid gallery-style1-current-theme">

                        <!-- Filter Kategori -->
                        <div class="isotope-layout-filter filter-style-4 cat-filter-default" data-link-with="gallery-holder-618422">
                            <a href="#" class="active" data-filter="*">All</a>
                            @foreach ($kategoriGaleri as $katg)
                                <a href="#" data-filter=".katg-{{ $katg->id }}">{{ $katg->nama_kategori }}</a>
                            @endforeach
                        </div>
                        <!-- End Filter -->

                        <!-- Galeri Grid -->
                        <div id="gallery-holder-618422" class="isotope-layout grid-4 gutter-5 clearfix lightgallery-lightbox">
                            <div class="isotope-layout-inner">
                                @foreach ($galeri as $item)
                                    <div class="isotope-item katg-{{ $item->kategori_galeri_id }}">
                                        <div class="isotope-item-inner">
                                            <div class="tm-gallery">
                                                <div class="tm-gallery-inner">
                                                    <div class="thumb">
                                                        <a href="#">
                                                            <img width="672" height="448" src="{{ asset('storage/galeri/' . $item->foto) }}" alt="{{ $item->judul }}" />
                                                        </a>
                                                    </div>
                                                    <div class="tm-gallery-content-wrapper">
                                                        <div class="tm-gallery-content">
                                                            <div class="tm-gallery-content-inner">
                                                                <div class="icons-holder-inner">
                                                                    <div class="styled-icons icon-dark icon-circled icon-theme-colored1">
                                                                        <a class="lightgallery-trigger styled-icons-item"
                                                                            data-exthumbimage="{{ asset('storage/galeri/' . $item->foto) }}"
                                                                            data-src="{{ asset('storage/galeri/' . $item->foto) }}"
                                                                            title="{{ $item->judul }}"
                                                                            href="{{ asset('storage/galeri/' . $item->foto) }}"><i class="fa fa-plus"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="title-holder">
                                                                    <h5 class="title"><a href="#">{{ $item->judul }}</a></h5>
                                                                    <small class="text-muted">{{ $item->kategoriGaleri->nama_kategori ?? '-' }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- /.tm-gallery-inner -->
                                            </div> <!-- /.tm-gallery -->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Galeri Grid -->
                        <!-- Tombol Lihat Semua Galeri -->
                        <div class="text-center mt-4">
                            <a href="{{ route('landing.galeri') }}" class="btn btn-theme-colored1 btn-sm">Lihat Semua Galeri</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
