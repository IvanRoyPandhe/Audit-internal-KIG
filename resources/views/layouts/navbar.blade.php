<!-- Header Start -->
<div class="app-topstrip bg-primary py-3 px-3 w-100 d-flex align-items-center justify-content-between">
  <div class="d-flex align-items-center gap-3">
    <button class="btn btn-link text-white d-lg-none p-0 me-2" id="sidebarToggle">
      <i class="ti ti-menu-2 fs-5"></i>
    </button>
    <a href="{{ route('dashboard') }}">
      <img src="{{ asset('assets/images/logos/kig.png') }}" alt="SI AI KIG" width="40" class="text-white">
    </a>
    <h5 class="text-white mb-0 fw-bold d-none d-md-block">SI AI (Sistem Informasi Audit Internal)</h5>
    <h6 class="text-white mb-0 fw-bold d-md-none">SI AI</h6>
  </div>
  <div class="d-flex align-items-center gap-3">
    <span class="text-white small">{{ Auth::user()->name }}</span>
    <div class="dropdown">
      <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
        <img src="{{ asset('assets/images/profile/user1.jpg') }}" alt="Profile" width="32" height="32" class="rounded-circle">
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal"><i class="ti ti-user me-2"></i>My Profile</a></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#accountModal"><i class="ti ti-settings me-2"></i>My Account</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dropdown-item"><i class="ti ti-logout me-2"></i>Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- Header End -->
