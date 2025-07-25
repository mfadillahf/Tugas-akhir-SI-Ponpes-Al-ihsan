<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ponpes Al-Ihsan Banjarmasin Tengah</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('studypress/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('studypress/css/style-main.css') }}">
    <link rel="stylesheet" href="{{ asset('studypress/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('studypress/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('studypress/css/javascript-plugins-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('studypress/js/menuzord/css/menuzord.css') }}">
    <link rel="stylesheet" href="{{ asset('studypress/css/colors/theme-skin-color-set1.css') }}">
    <link rel="stylesheet" href="{{ asset('studypress/css/menuzord-skins/menuzord-rounded-boxed.css') }}">
    <link rel="stylesheet" href="{{ asset('studypress/js/revolution-slider/css/rs6.css') }}">
    <link rel="stylesheet" href="{{ asset('studypress/js/revolution-slider/extra-rev-slider1.css') }}">
    <link rel="stylesheet" href="{{ asset('studypress/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('studypress/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('studypress/css/lightgallery.min.css') }}">

    @stack('styles')
    <!-- Tambahkan stylesheet lainnya sesuai kebutuhan -->
    </head>
    <body class="tm-container-1340px has-side-panel side-panel-right">

    <!-- Preloader -->
    @include('partials.preloader')

    <div id="wrapper" class="clearfix">
    <!-- Header -->
    @include('partials.header')

        <div class="main-content-area">
            @yield('content')
        </div>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('studypress/js/jquery.js') }}"></script>
    <script src="{{ asset('studypress/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('studypress/js/owl.carousel2.thumbs.min.js') }}"></script>
    <script src="{{ asset('studypress/js/owl-init.js') }}"></script>
    <script src="{{ asset('studypress/js/popper.min.js') }}"></script>
    <script src="{{ asset('studypress/js/bootstrap.min.js') }}"></script>
    <!-- plugin bundle -->
    <script src="{{ asset('studypress/js/javascript-plugins-bundle.js') }}"></script>
    <!-- menu -->
    <script src="{{ asset('studypress/js/menuzord/js/menuzord.js') }}"></script>
    <!-- revolution slider -->
    <script src="{{ asset('studypress/js/revolution-slider/js/revolution.tools.min.js') }}"></script>
    <script src="{{ asset('studypress/js/revolution-slider/js/rs6.min.js') }}"></script>
    <script src="{{ asset('studypress/js/revolution-slider/extra-rev-slider1.js') }}"></script>
    <script src="{{ asset('studypress/js/custom.js') }}"></script>
    <script src="{{ asset('studypress/js/custom-script.js') }}"></script>
    <script src="{{ asset('studypress/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('studypress/js/lightgallery.js') }}"></script>

    <script>
  $(document).ready(function () {
	// Toggle dropdown di mobile saat klik parent menu
	  $('.menuzord-menu > li > a').on('click', function (e) {
		var submenu = $(this).next('ul');
		if ($(window).width() <= 991 && submenu.length) {
		  e.preventDefault(); // Jangan lanjut ke href
		  submenu.slideToggle(); // Tampilkan submenu
		  $(this).parent().toggleClass('open'); // Tambahkan class .open
		  return false;
		}
	  });

	  // Hanya tutup menu jika klik ke link yang bukan dropdown parent
	  $('.menuzord-menu li a').on('click', function () {
		var hasSubmenu = $(this).next('ul').length > 0;
		if ($(window).width() <= 1199 && !hasSubmenu) {
		  $('.menuzord-responsive .showhide').trigger('click');
		}
	  });
  });

</script>
 @stack('scripts')
</body>
</html>
