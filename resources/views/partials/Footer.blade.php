@php
    $kontak = \App\Models\Kontak::first();
@endphp

<footer id="footer" class="footer layer-overlay overlay-dark-9" data-tm-bg-img="{{ asset('studypress/images/bg/ponpes.jpg') }}">
    <div class="footer-widget-area">
        <div class="container pt-90 pb-60">
            <div class="row align-items-center">

                {{-- Logo --}}
                <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
                    <div class="tm-widget-contact-info contact-info-style1 contact-icon-theme-colored1">
                        <div class="thumb mb-3">
                            <img alt="Logo" src="{{ asset('public/assets/img/illustrations/logo_ponpes.png') }}" style="max-width: 150px;">
                        </div>
                    </div>
                </div>

                {{-- Alamat dan Sosmed --}}
                <div class="col-md-6 text-center text-md-end">
                    <div class="description text-white">
                        <p class="mb-1">Jl. Seberang Mesjid No.96 Rt.02, Kec. Banjarmasin Tengah</p>
                        <p class="mb-1">Kota Banjarmasin, Kalimantan Selatan 70231</p>
                        <p class="mb-1"><span class="text-theme-colored2">Telp/WA:</span> {{ $kontak->whatsapp ?? '-' }}</p>
                        <p class="mb-1"><span class="text-theme-colored2">Email:</span> {{ $kontak->email ?? '-' }}</p>

                        <ul class="styled-icons icon-dark icon-theme-colored1 icon-rounded mt-2 d-inline-flex">
                            @if($kontak->youtube)
                                <li><a class="social-link" href="{{ $kontak->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            @endif
                            @if($kontak->instagram)
                                <li><a class="social-link" href="{{ $kontak->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            @endif
                            @if($kontak->facebook)
                                <li><a class="social-link" href="{{ $kontak->facebook }}" target="_blank"><i class="fab fa-facebook"></i></a></li>
                            @endif
                            @if($kontak->tiktok)
                                <li><a class="social-link" href="{{ $kontak->tiktok }}" target="_blank"><i class="fab fa-tiktok"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="footer-bottom" data-tm-bg-color="#2A2A2A">
            <div class="container">
                <div class="row pt-20 pb-20 justify-content-center">
                    <div class="col-12 text-center">
                        <div class="footer-paragraph text-white">
                            © Copyright Ponpes Al Ihsan. All Rights Reserved
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
