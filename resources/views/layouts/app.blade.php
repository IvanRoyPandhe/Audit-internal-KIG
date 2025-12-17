<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title ?? 'Dashboard' }} - SI AI KIG</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/kig.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/mobile-sidebar.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/dropdown-style.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/dark-mode.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/universal-dark-mode.css') }}" />
  @stack('styles')
</head>
<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    
    @include('layouts.navbar')
    
    @include('layouts.sidebar')
    
    <div class="body-wrapper">
      <div class="body-wrapper-inner">
        <div class="container-fluid">
          {{ $slot }}
        </div>
      </div>
    </div>
  </div>

  @include('layouts.footer')
  @include('layouts.profile-modals')
  
  <div class="sidebar-overlay"></div>
  
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <script src="{{ asset('assets/js/menu-functions-laravel.js') }}"></script>
  <script src="{{ asset('assets/js/theme-manager.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  
  <script>
    // Mobile sidebar toggle
    $('#sidebarToggle').on('click', function(e) {
      e.preventDefault();
      $('.left-sidebar').toggleClass('show-sidebar');
      $('.sidebar-overlay').toggleClass('show');
    });
    
    $('.sidebar-overlay').on('click', function() {
      $('.left-sidebar').removeClass('show-sidebar');
      $('.sidebar-overlay').removeClass('show');
    });
    
    $(window).on('resize', function() {
      if ($(window).width() >= 992) {
        $('.left-sidebar').removeClass('show-sidebar');
        $('.sidebar-overlay').removeClass('show');
      }
    });
  </script>
  
  @stack('scripts')
</body>
</html>
