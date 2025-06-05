<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Login')</title>

  {{-- Fonts --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />

  {{-- OverlayScrollbars --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" crossorigin="anonymous" />

  {{-- Bootstrap Icons --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" crossorigin="anonymous" />

  {{-- AdminLTE CSS --}}
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.css') }}" />
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/login.css') }}" />

  @stack('styles')
</head>
<body class="@yield('body-class', 'login-page')">

  @yield('content')

  {{-- Scripts --}}
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>

  @stack('scripts')
</body>
</html>
