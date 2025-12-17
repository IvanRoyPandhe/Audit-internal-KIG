<x-guest-layout>
  <x-slot name="title">Login</x-slot>

  <div class="card mb-0 login-card-with-bubbles">
    <!-- Bubble Animation Inside Card -->
    <div class="bubbles-container-card">
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
    </div>

    <div class="card-body">
      <div class="text-center mb-4">
        <img src="{{ asset('assets/images/logos/kig.png') }}" alt="SI AI KIG" width="90">
        <h6 class="mt-3">SISTEM INFORMASI AUDIT INTERNAL</h6>
      </div>

      <!-- Session Status -->
      @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('status') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="mb-3">
          <label for="email" class="form-label">Email / Username</label>
          <input type="text" class="form-control @error('email') is-invalid @enderror" 
                 id="email" name="email" value="{{ old('email') }}" required autofocus>
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="password" class="form-label">Password</label>
          <div class="position-relative">
            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                   id="password" name="password" required>
            <span class="position-absolute top-50 end-0 translate-middle-y me-3" 
                  style="cursor: pointer;" id="togglePassword">
              <i class="ti ti-eye" id="eyeIcon"></i>
            </span>
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mb-4">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
            <label class="form-check-label" for="remember_me">
              Ingat saya
            </label>
          </div>
          @if (Route::has('password.request'))
            <a class="text-primary fw-bold" href="{{ route('password.request') }}">Lupa Password?</a>
          @endif
        </div>

        <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Login</button>
      </form>

      <div class="panel-footer">
        <div class="text-center">
          <p class="footer-text small">Copyright &copy; {{ date('Y') }}. PT Kawasan Industri Gresik <br class="d-sm-none"> <span class="d-none d-sm-inline"><br></span> Developed by IT KIG</p>
        </div>
      </div>
    </div>
  </div>

  @push('styles')
  <style>
    .login-card-with-bubbles {
      position: relative;
      overflow: hidden;
    }

    .bubbles-container-card {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 0;
      pointer-events: none;
    }

    .bubbles-container-card .bubble {
      position: absolute;
      bottom: -100px;
      background: linear-gradient(135deg, rgba(93, 135, 255, 0.15), rgba(73, 190, 255, 0.15));
      border-radius: 50%;
      opacity: 0.7;
      animation: riseInCard 15s infinite ease-in;
      box-shadow: 0 4px 15px rgba(93, 135, 255, 0.2);
    }

    .bubbles-container-card .bubble:nth-child(1) {
      width: 60px;
      height: 60px;
      left: 5%;
      animation-duration: 12s;
      animation-delay: 0s;
    }

    .bubbles-container-card .bubble:nth-child(2) {
      width: 45px;
      height: 45px;
      left: 15%;
      animation-duration: 14s;
      animation-delay: 2s;
    }

    .bubbles-container-card .bubble:nth-child(3) {
      width: 70px;
      height: 70px;
      left: 25%;
      animation-duration: 16s;
      animation-delay: 4s;
    }

    .bubbles-container-card .bubble:nth-child(4) {
      width: 50px;
      height: 50px;
      left: 35%;
      animation-duration: 13s;
      animation-delay: 1s;
    }

    .bubbles-container-card .bubble:nth-child(5) {
      width: 65px;
      height: 65px;
      left: 50%;
      animation-duration: 15s;
      animation-delay: 3s;
    }

    .bubbles-container-card .bubble:nth-child(6) {
      width: 55px;
      height: 55px;
      left: 60%;
      animation-duration: 14s;
      animation-delay: 5s;
    }

    .bubbles-container-card .bubble:nth-child(7) {
      width: 60px;
      height: 60px;
      left: 70%;
      animation-duration: 17s;
      animation-delay: 2s;
    }

    .bubbles-container-card .bubble:nth-child(8) {
      width: 48px;
      height: 48px;
      left: 80%;
      animation-duration: 13s;
      animation-delay: 4s;
    }

    .bubbles-container-card .bubble:nth-child(9) {
      width: 58px;
      height: 58px;
      left: 10%;
      animation-duration: 16s;
      animation-delay: 6s;
    }

    .bubbles-container-card .bubble:nth-child(10) {
      width: 42px;
      height: 42px;
      left: 90%;
      animation-duration: 12s;
      animation-delay: 3s;
    }

    @keyframes riseInCard {
      0% {
        bottom: -100px;
        transform: translateX(0) rotate(0deg);
        opacity: 0;
      }
      10% {
        opacity: 0.7;
      }
      90% {
        opacity: 0.7;
      }
      100% {
        bottom: 110%;
        transform: translateX(50px) rotate(360deg);
        opacity: 0;
      }
    }

    /* Make sure card content is above bubbles */
    .card-body {
      position: relative;
      z-index: 1;
    }
  </style>
  @endpush

  @push('scripts')
  <script>
    // Toggle password visibility
    $('#togglePassword').on('click', function() {
      const passwordField = $('#password');
      const eyeIcon = $('#eyeIcon');
      
      if (passwordField.attr('type') === 'password') {
        passwordField.attr('type', 'text');
        eyeIcon.removeClass('ti-eye').addClass('ti-eye-off');
      } else {
        passwordField.attr('type', 'password');
        eyeIcon.removeClass('ti-eye-off').addClass('ti-eye');
      }
    });
  </script>
  @endpush
</x-guest-layout>
