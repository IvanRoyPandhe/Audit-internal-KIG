<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title ?? 'Login' }} - SI AI KIG</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/kig.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
  <style>
    body {
      background: url('{{ asset('assets/images/logos/background.jpg') }}') no-repeat center center fixed !important;
      background-size: cover !important;
      min-height: 100vh;
    }
    .page-wrapper {
      background: none !important;
    }
    .alert {
      animation: slideInRight 0.3s ease-out;
    }
    @keyframes slideInRight {
      from {
        transform: translateX(100%);
        opacity: 0;
      }
      to {
        transform: translateX(0);
        opacity: 1;
      }
    }
    .card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
    }
  </style>
  @stack('styles')
</head>
<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-5 col-xxl-4">
            {{ $slot }}
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  @stack('scripts')
</body>
</html>
