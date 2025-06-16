<!-- Header -->
    <header id="header" class="header header-layout-type-header-1rows-floating-header header-bg-dark-shadow">
        <div class="header-nav tm-enable-navbar-hide-on-scroll">
            <div class="header-nav-wrapper navbar-scrolltofixed">
                <div class="menuzord-container header-nav-container">
                    <div class="container position-relative">
                        <div class="header-nav-container-inner">
                            <div class="row header-nav-col-row">
                            <div class="col-sm-auto align-self-center">
                                <a class="menuzord-brand site-brand" href="{{ route('landing') }}">
                                <img class="logo-default logo-1x" src="{{ asset('studypress/images/logo-wide.png')}}" alt="Logo">
                                <img class="logo-default logo-2x retina" src="{{ asset('studypress/images/logo-wide@2x.png')}}" alt="Logo">
                                </a>
                            </div>
                            <div class="col-sm-auto ms-auto pr-0 align-self-center">
                                <nav id="top-primary-nav" class="menuzord theme-color2" data-effect="slide" data-animation="none" data-align="right">
                                <ul id="main-nav"class="menuzord-menu">
                                    <li class="active menu-item">
                                        <a href="{{ route('landing') }}#home">Beranda</a>
                                    </li>

                                    <li class="menu-item">
                                        <a href="#">Profil Ponpes</a>
                                        <ul class="dropdown">
                                            <li><a href="{{ route('landing.tentang') }}">Tentang</a></li>
                                            <li><a href="{{ route('landing') }}#teachers">Kepengurusan</a></li>
                                        </ul>
                                    </li>

                                    <li class="menu-item">
                                        <a href="#">Pendaftaran</a>
                                        <ul class="dropdown">
                                            <li><a href="{{ route('register.santri') }}">PSB Online</a></li>
                                            <li><a href="{{ route('register.donatur') }}">Daftar Sebagai Donatur</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="{{ route('landing.kalender') }}#calender">Kalender</a></li>
                                    <li><a href="{{ route('landing.galeri')}}">Galeri</a></li>

                                    <li><a href="{{ route('landing') }}#contact">Kontak</a></li>
                                    <li class="hidden-mobile-mode">
                                        <a href="{{ route('login') }}">
                                        Login
                                        </a>
                                    </li>
                                </ul>
                                </nav>
                            </div>
                            <div class="col-sm-auto align-self-center nav-side-icon-parent">
                                <ul class="list-inline nav-side-icon-list">
                                <li class="hidden-mobile-mode">
                                    <div id="side-panel-trigger" class="side-panel-trigger">
                                    <a href="#">
                                        <div class="hamburger-inner"></div>
                                        </div>
                                        </a>
                                    </div>
                                </li>
                                </ul>
                            </div>
                            </div>
                                <div class="row d-block d-xl-none">
                                    <div class="col-12">
                                        <nav id="top-primary-nav-clone" class="menuzord d-block d-xl-none default menuzord-color-default menuzord-border-boxed menuzord-responsive" data-effect="slide" data-animation="none" data-align="right">
                                        <ul id="main-nav-clone" class="menuzord-menu menuzord-right menuzord-indented scrollable">
                                        </ul>
                                        </nav>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </header>
    