<!-- Sidebar Start -->
<aside class="left-sidebar">
  <div>        
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="" style="margin-top: 20px; padding: 0 15px;">
      <ul id="sidebarnav">           
        <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <a class="sidebar-link primary-hover-bg" href="{{ route('dashboard') }}" aria-expanded="false">
            <iconify-icon icon="solar:atom-line-duotone"></iconify-icon>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>

        @if(in_array(Auth::user()->role->name, ['admin', 'auditor']))
        <li class="sidebar-item {{ request()->routeIs('rkia.*') || request()->routeIs('audit-programs.*') || request()->routeIs('audit-questions.*') ? 'active' : '' }}">
          <a class="sidebar-link primary-hover-bg" href="{{ route('rkia.program') }}" aria-expanded="false">
            <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
            <span class="hide-menu">Program Kerja Audit</span>
          </a>
        </li>
        @endif

        @if(in_array(Auth::user()->role->name, ['admin', 'auditor', 'pimpinan']))
        <li class="sidebar-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
          <a class="sidebar-link primary-hover-bg" href="{{ route('laporan.index') }}" aria-expanded="false">
            <iconify-icon icon="solar:document-text-line-duotone"></iconify-icon>
            <span class="hide-menu">Laporan Hasil Audit</span>
          </a>
        </li>
        @endif

        @if(in_array(Auth::user()->role->name, ['auditee_sm', 'auditee_em']))
        <li class="sidebar-item {{ request()->routeIs('auditee.*') ? 'active' : '' }}">
          <a class="sidebar-link primary-hover-bg" href="{{ route('auditee.dashboard') }}" aria-expanded="false">
            <iconify-icon icon="solar:clipboard-list-line-duotone"></iconify-icon>
            <span class="hide-menu">Audit Saya</span>
          </a>
        </li>
        @endif

        @if(Auth::user()->role->name === 'admin')
        <!-- Manajemen Section -->
        <li class="nav-small-cap">
          <iconify-icon icon="solar:menu-dots-line-duotone" class="nav-small-cap-icon fs-4"></iconify-icon>
          <span class="hide-menu">Manajemen</span>
        </li>

        <!-- Konfigurasi Menu -->
        <li class="sidebar-item {{ request()->routeIs('users.*') || request()->routeIs('roles.*') ? 'active' : '' }}">
          <a class="sidebar-link primary-hover-bg" href="#" aria-expanded="false">
            <iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
            <span class="hide-menu">Konfigurasi</span>
            <i class="ti ti-chevron-down dropdown-arrow"></i>
          </a>
          <ul aria-expanded="false" class="collapse first-level {{ request()->routeIs('users.*') || request()->routeIs('roles.*') ? 'show' : '' }}">
            <li class="sidebar-item">
              <a href="{{ route('users.index') }}" class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <span class="hide-menu">Users</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="{{ route('roles.index') }}" class="sidebar-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                <span class="hide-menu">Roles</span>
              </a>
            </li>
          </ul>
        </li>

        <!-- Office Menu -->
        <li class="sidebar-item {{ request()->routeIs('departments.*') || request()->routeIs('karyawan.*') ? 'active' : '' }}">
          <a class="sidebar-link primary-hover-bg" href="#" aria-expanded="false">
            <iconify-icon icon="solar:buildings-2-line-duotone"></iconify-icon>
            <span class="hide-menu">Office</span>
            <i class="ti ti-chevron-down dropdown-arrow"></i>
          </a>
          <ul aria-expanded="false" class="collapse first-level {{ request()->routeIs('departments.*') || request()->routeIs('karyawan.*') ? 'show' : '' }}">
            <li class="sidebar-item">
              <a href="{{ route('departments.index') }}" class="sidebar-link {{ request()->routeIs('departments.*') ? 'active' : '' }}">
                <span class="hide-menu">Departemen</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="{{ route('karyawan.index') }}" class="sidebar-link {{ request()->routeIs('karyawan.*') ? 'active' : '' }}">
                <span class="hide-menu">Karyawan</span>
              </a>
            </li>
          </ul>
        </li>
        @endif

        <li class="sidebar-item mt-3">
          <div class="d-flex align-items-center justify-content-between px-3 py-2">
            <span class="hide-menu text-muted small">Tampilan Mode</span>
            <div class="d-flex align-items-center gap-2">
              <i class="ti ti-sun text-warning"></i>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="darkModeToggle">
                <label class="form-check-label" for="darkModeToggle"></label>
              </div>
              <i class="ti ti-moon text-primary"></i>
            </div>
          </div>
        </li>
      </ul>
    </nav>
  </div>

  <!-- Animated Bubbles Background - Full Height -->
  <div class="sidebar-bubbles">
    <!-- Bottom bubbles -->
    <div class="bubble bubble-orange"></div>
    <div class="bubble bubble-blue"></div>
    <div class="bubble bubble-red"></div>
    <div class="bubble bubble-green"></div>
    <div class="bubble bubble-orange-2"></div>
    <div class="bubble bubble-blue-2"></div>
    
    <!-- Middle bubbles -->
    <div class="bubble bubble-red-2"></div>
    <div class="bubble bubble-green-2"></div>
    <div class="bubble bubble-blue-3"></div>
    
    <!-- Top bubbles -->
    <div class="bubble bubble-orange-3"></div>
    <div class="bubble bubble-green-3"></div>
    <div class="bubble bubble-red-3"></div>
  </div>
</aside>
<!--  Sidebar End -->

<style>
/* Sidebar Background Enhancement */
.left-sidebar {
  background: linear-gradient(180deg, #f8f9ff 0%, #ffffff 50%, #f5f9ff 100%) !important;
  box-shadow: 2px 0 15px rgba(93, 135, 255, 0.08);
}

.sidebar-bubbles {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  pointer-events: none;
  z-index: 0;
}

.bubble {
  position: absolute;
  border-radius: 50%;
  opacity: 0.12;
  animation: float-up 15s infinite ease-in-out;
  filter: blur(3px);
}

/* Bottom Section Bubbles */
.bubble-orange {
  width: 80px;
  height: 80px;
  left: 10%;
  bottom: -100px;
  background: linear-gradient(135deg, #ff6b35, #ff9068);
  animation-delay: 0s;
  animation-duration: 12s;
}

.bubble-blue {
  width: 60px;
  height: 60px;
  left: 30%;
  bottom: -80px;
  background: linear-gradient(135deg, #5D87FF, #7ea5ff);
  animation-delay: 2s;
  animation-duration: 14s;
}

.bubble-red {
  width: 70px;
  height: 70px;
  left: 50%;
  bottom: -90px;
  background: linear-gradient(135deg, #FA896B, #fc9f87);
  animation-delay: 4s;
  animation-duration: 16s;
}

.bubble-green {
  width: 90px;
  height: 90px;
  left: 70%;
  bottom: -110px;
  background: linear-gradient(135deg, #13DEB9, #4ee8ca);
  animation-delay: 1s;
  animation-duration: 13s;
}

.bubble-orange-2 {
  width: 50px;
  height: 50px;
  left: 20%;
  bottom: -70px;
  background: linear-gradient(135deg, #ff6b35, #ff9068);
  animation-delay: 6s;
  animation-duration: 15s;
}

.bubble-blue-2 {
  width: 65px;
  height: 65px;
  left: 85%;
  bottom: -85px;
  background: linear-gradient(135deg, #5D87FF, #7ea5ff);
  animation-delay: 3s;
  animation-duration: 17s;
}

/* Middle Section Bubbles */
.bubble-red-2 {
  width: 75px;
  height: 75px;
  left: 15%;
  bottom: 40%;
  background: linear-gradient(135deg, #FA896B, #fc9f87);
  animation-delay: 5s;
  animation-duration: 18s;
}

.bubble-green-2 {
  width: 55px;
  height: 55px;
  left: 60%;
  bottom: 45%;
  background: linear-gradient(135deg, #13DEB9, #4ee8ca);
  animation-delay: 7s;
  animation-duration: 16s;
}

.bubble-blue-3 {
  width: 85px;
  height: 85px;
  left: 40%;
  bottom: 50%;
  background: linear-gradient(135deg, #5D87FF, #7ea5ff);
  animation-delay: 2.5s;
  animation-duration: 19s;
}

/* Top Section Bubbles */
.bubble-orange-3 {
  width: 70px;
  height: 70px;
  left: 25%;
  bottom: 75%;
  background: linear-gradient(135deg, #ff6b35, #ff9068);
  animation-delay: 8s;
  animation-duration: 14s;
}

.bubble-green-3 {
  width: 60px;
  height: 60px;
  left: 75%;
  bottom: 80%;
  background: linear-gradient(135deg, #13DEB9, #4ee8ca);
  animation-delay: 4.5s;
  animation-duration: 15s;
}

.bubble-red-3 {
  width: 65px;
  height: 65px;
  left: 50%;
  bottom: 85%;
  background: linear-gradient(135deg, #FA896B, #fc9f87);
  animation-delay: 9s;
  animation-duration: 17s;
}

@keyframes float-up {
  0% {
    transform: translateY(0) translateX(0) scale(1) rotate(0deg);
    opacity: 0;
  }
  10% {
    opacity: 0.12;
  }
  50% {
    transform: translateY(-200px) translateX(30px) scale(1.2) rotate(180deg);
    opacity: 0.18;
  }
  100% {
    transform: translateY(-400px) translateX(-20px) scale(0.7) rotate(360deg);
    opacity: 0;
  }
}

/* Ensure sidebar content is above bubbles */
.sidebar-nav {
  position: relative;
  z-index: 1;
}

/* Enhanced hover effect */
.sidebar-item:hover ~ .sidebar-bubbles .bubble {
  opacity: 0.2;
  filter: blur(2px);
  transition: all 0.3s ease;
}

/* Menu item styling enhancement */
.sidebar-link {
  background: rgba(255, 255, 255, 0.5);
  backdrop-filter: blur(10px);
  transition: all 0.3s ease;
}

.sidebar-link:hover {
  background: rgba(93, 135, 255, 0.08);
  transform: translateX(3px);
}

.sidebar-item.active .sidebar-link {
  background: rgba(93, 135, 255, 0.12);
  border-left: 3px solid #5D87FF;
}
</style>
