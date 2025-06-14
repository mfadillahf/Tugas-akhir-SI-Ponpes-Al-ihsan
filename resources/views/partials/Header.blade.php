    <header id="header" class="header header-layout-type-header-2rows">
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
                            <div class="col-sm-auto align-self-center top-nav-parent">
                                <nav id="top-primary-nav" class="menuzord theme-color2" data-effect="slide" data-animation="none" data-align="right">
                                <ul id="main-nav" class="menuzord-menu">
                                    <li class="active"><a href="{{ route('landing') }}#home">Beranda</a></li>
                                    <li><a href="{{ route('landing') }}#about">Tentang</a></li>
                                    <li><a href="{{ route('landing') }}#teachers">Kepengurusan</a></li>
                                    <li><a href="{{ route('landing') }}#gallery">Galeri</a></li>
                                    <li><a href="{{ route('landing') }}#blog">Berita</a></li>
                                    <li><a href="#contact">kontak</a></li>
                                </ul>
                                </nav>
                            </div>
                            <div class="col-sm-auto align-self-center nav-side-icon-parent">
                                <ul class="list-inline nav-side-icon-list">
                                <li class="hidden-mobile-mode">
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-theme-colored1 text-white" style="padding: 5px 15px; border-radius: 4px;">
                                    <i class="fa fa-sign-in-alt me-1"></i> Login
                                    </a>
                                
                                </li>
                                <li class="hidden-mobile-mode">
                                    <div id="side-panel-trigger" class="side-panel-trigger">
                                    <a href="#">
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
                                    <li class="active"><a href="{{ route('landing') }}#home">Beranda</a></li>
                                    <li><a href="{{ route('landing') }}#about">Tentang</a></li>
                                    <li><a href="{{ route('landing') }}#teachers">Kepengurusan</a></li>
                                    <li><a href="{{ route('landing') }}#gallery">Galeri</a></li>
                                    <li><a href="{{ route('landing') }}#blog">Berita</a></li>
                                    <li><a href="#contact">kontak</a></li>
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
    