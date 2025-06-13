    <header id="header" class="header header-layout-type-header-2rows">
        
        <div class="header-nav tm-enable-navbar-hide-on-scroll">
        <div class="header-nav-wrapper navbar-scrolltofixed">
            <div class="menuzord-container header-nav-container">
            <div class="container position-relative">
                <div class="row header-nav-col-row">
                <div class="col-sm-auto align-self-center">
                    <a class="menuzord-brand site-brand" href="{{ asset('studypress/index-mp-layout1.html')}}">
                    <img class="logo-default logo-1x" src="{{ asset('studypress/images/logo-wide.png')}}" alt="Logo">
                    <img class="logo-default logo-2x retina" src="{{ asset('studypress/images/logo-wide@2x.png')}}" alt="Logo">
                    </a>
                </div>
                <div class="col-sm-auto ms-auto pr-0 align-self-center">
                    <nav id="top-primary-nav" class="menuzord theme-color1" data-effect="slide" data-animation="none" data-align="right">
                    <ul class="menuzord-menu onepage-nav">
                        <li class="active"><a href="#home">Beranda</a></li>
                        <li><a href="#about">Tentang</a></li>
                        {{-- <li><a href="#courses">Courses</a></li> --}}
                        <li><a href="#teachers">Kepengurusan</a></li>
                        <li><a href="#gallery">Galeri</a></li>
                        <li><a href="#blog">Berita</a></li>
                        <li><a href="#contact">kontak</a></li>
                    </ul>
                    </nav>
                </div>
                <div class="col-sm-auto align-self-center nav-side-icon-parent">
                    <ul class="list-inline nav-side-icon-list">
                    <li class="hidden-mobile-mode">
                        <a href="#" id="top-nav-search-btn"><i class="search-icon fa fa-search"></i></a>
                    </li>
                    <li class="hidden-mobile-mode">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-theme-colored1 text-white" style="padding: 5px 15px; border-radius: 4px;">
                        <i class="fa fa-sign-in-alt me-1"></i> Login
                        </a>
                    
                        {{-- <div class="top-nav-mini-cart-icon-container">
                        <div class="top-nav-mini-cart-icon-contents">
                            <a class="mini-cart-icon" href="shop-cart.html" title="View your shopping cart">
                            <img src="{{ asset('studypress/images/shopping-cart.png')}}" width="25" alt="cart"><span class="items-count">1</span> <span class="cart-quick-info">1 item - <span class="amount"><span class="currencySymbol">&pound;</span>18.00</span></span>
                            </a>
                            <div class="dropdown-content">
                            <ul class="cart_list product_list_widget">
                                <li class="mini_cart_item">
                                <a href="#" class="remove remove_from_cart_button" aria-label="Remove this item" data-product_id="18832" data-cart_item_key="#" data-product_sku="woo-beanie">&times;</a>
                                <a href="#"> <img class="attachment-thumbnail" src="images/shop/product.jpg" width="300" height="300" alt=""/>Beanie</a>
                                <span class="quantity">1 &times; <span class="amount">
                                <span class="currencySymbol">&pound;</span>18.00</span></span>
                                </li>
                            </ul>
                            <p class="total"> <strong>Subtotal:</strong> <span class="woocommerce-Price-amount amount"><span class="currencySymbol">&pound;</span>18.00</span> </p>
                            <div class="buttons cart-action-buttons">
                                <div class="row">
                                <div class="col-6 pe-0"><a href="shop-cart.html" class="btn btn-theme-colored2 btn-block btn-sm wc-forward">View Cart</a></div>
                                <div class="col-6 ps-1"><a href="shop-checkout.html" class="btn btn-theme-colored1 btn-block btn-sm checkout wc-forward">Checkout</a></div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div> --}}
                    </li>
                    {{-- <li class="hidden-mobile-mode">
                        <div id="side-panel-trigger" class="side-panel-trigger">
                        <a href="#">
                            <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                            </div>
                            </a>
                        </div>
                    </li> --}}
                    </ul>
                    <div id="top-nav-search-form" class="clearfix">
                    <form action="#" method="GET">
                        <input type="text" name="s" value="" placeholder="Type and Press Enter..." autocomplete="off" />
                    </form>
                    <a href="#" id="close-search-btn"><i class="fa fa-times"></i></a>
                    </div>

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
    </header>