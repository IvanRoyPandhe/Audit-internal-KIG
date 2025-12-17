<?php
// template.php - Template for all pages
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{TITLE}} - SI AI KIG</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/kig.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link rel="stylesheet" href="assets/css/custom.css" />
</head>
<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    
    <!--  App Topstrip -->
    <div class="app-topstrip bg-primary py-3 px-3 w-100 d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center gap-3">
        <img src="assets/images/logos/kig.png" alt="SI AI KIG" width="40" class="text-white">
        <h5 class="text-white mb-0 fw-bold">SI AI (Sistem Informasi Audit Internal)</h5>
      </div>
      <div class="d-flex align-items-center gap-3">
        <span class="text-white fs-6">Admin</span>
        <div class="dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
            <img src="assets/images/profile/user1.jpg" alt="Profile" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal"><i class="ti ti-user me-2"></i>My Profile</a></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#accountModal"><i class="ti ti-settings me-2"></i>My Account</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php"><i class="ti ti-logout me-2"></i>Logout</a></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>        
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="" style="margin-top: 30px;">
          <ul id="sidebarnav">           
            <li class="sidebar-item {{DASHBOARD_ACTIVE}}">
              <a class="sidebar-link primary-hover-bg" href="dashboard.php" aria-expanded="false">
                <iconify-icon icon="solar:atom-line-duotone"></iconify-icon>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item {{BUTTONS_ACTIVE}}">
              <a class="sidebar-link primary-hover-bg" href="buttons.php" aria-expanded="false">
                <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
                <span class="hide-menu">Buttons</span>
              </a>
            </li>
            <li class="sidebar-item {{ALERTS_ACTIVE}}">
              <a class="sidebar-link primary-hover-bg" href="alerts.php" aria-expanded="false">
                <iconify-icon icon="solar:danger-circle-line-duotone"></iconify-icon>
                <span class="hide-menu">Alerts</span>
              </a>
            </li>
            <li class="sidebar-item {{CARDS_ACTIVE}}">
              <a class="sidebar-link primary-hover-bg" href="cards.php" aria-expanded="false">
                <iconify-icon icon="solar:bookmark-square-minimalistic-line-duotone"></iconify-icon>
                <span class="hide-menu">Card</span>
              </a>
            </li>
            <li class="sidebar-item {{FORMS_ACTIVE}}">
              <a class="sidebar-link primary-hover-bg" href="forms.php" aria-expanded="false">
                <iconify-icon icon="solar:file-text-line-duotone"></iconify-icon>
                <span class="hide-menu">Forms</span>
              </a>
            </li>
            <li class="sidebar-item {{TYPOGRAPHY_ACTIVE}}">
              <a class="sidebar-link primary-hover-bg" href="typography.php" aria-expanded="false">
                <iconify-icon icon="solar:text-field-focus-line-duotone"></iconify-icon>
                <span class="hide-menu">Typography</span>
              </a>
            </li>
            
            
            <li class="sidebar-item {{ICONS_ACTIVE}}">
              <a class="sidebar-link primary-hover-bg" href="icons.php" aria-expanded="false">
                <iconify-icon icon="solar:sticker-smile-circle-2-line-duotone"></iconify-icon>
                <span class="hide-menu">Tabler Icon</span>
              </a>
            </li>
            <li class="sidebar-item {{SAMPLE_ACTIVE}}">
              <a class="sidebar-link primary-hover-bg" href="sample.php" aria-expanded="false">
                <iconify-icon icon="solar:planet-3-line-duotone"></iconify-icon>
                <span class="hide-menu">Sample Page</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    
    <div class="body-wrapper">
      <div class="body-wrapper-inner">
        <div class="container-fluid">
          {{CONTENT}}
        </div>
      </div>
    </div>
  </div>
  
  <!-- Profile Modal -->
  <div class="modal fade" id="profileModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Profil Pengguna</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="text-center mb-3">
            <img src="assets/images/profile/user1.jpg" alt="Profile" class="rounded-circle" width="80" height="80">
          </div>
          <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" value="Admin User" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" value="admin@kig.co.id" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Role</label>
            <input type="text" class="form-control" value="Administrator" readonly>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary">Edit Profil</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Account Modal -->
  <div class="modal fade" id="accountModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pengaturan Akun</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Password Lama</label>
            <input type="password" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Password Baru</label>
            <input type="password" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Konfirmasi Password Baru</label>
            <input type="password" class="form-control">
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="notifications">
            <label class="form-check-label" for="notifications">
              Terima notifikasi email
            </label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </div>
    </div>
  </div>
  
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>
</html>