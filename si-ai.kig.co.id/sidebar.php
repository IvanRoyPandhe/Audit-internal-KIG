<?php
// sidebar.php - Sidebar Menu Component
?>
<!-- Sidebar Start -->
<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>        
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="" style="margin-top: 20px; padding: 0 15px;">
      <ul id="sidebarnav">           
        <li class="sidebar-item">
          <a class="sidebar-link primary-hover-bg" href="dashboard.php" aria-expanded="false">
            <iconify-icon icon="solar:atom-line-duotone"></iconify-icon>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link primary-hover-bg" href="#" aria-expanded="false">
            <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
            <span class="hide-menu">Program Kerja Audit</span>
            <i class="ti ti-chevron-down dropdown-arrow"></i>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a href="proker_2026.php" class="sidebar-link">
                <span class="hide-menu">2026</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="proker_2027.php" class="sidebar-link">
                <span class="hide-menu">2027</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="proker_2028.php" class="sidebar-link">
                <span class="hide-menu">2028</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="proker_2029.php" class="sidebar-link">
                <span class="hide-menu">2029</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="proker_2030.php" class="sidebar-link">
                <span class="hide-menu">2030</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link primary-hover-bg" href="#" aria-expanded="false">
            <iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
            <span class="hide-menu">Konfigurasi</span>
            <i class="ti ti-chevron-down dropdown-arrow"></i>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a href="akun_user.php" class="sidebar-link">
                <span class="hide-menu">Akun User</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="tahun_proker_audit.php" class="sidebar-link">
                <span class="hide-menu">Tahun Proker Audit</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link primary-hover-bg" href="#" aria-expanded="false">
            <iconify-icon icon="solar:buildings-2-line-duotone"></iconify-icon>
            <span class="hide-menu">Office</span>
            <i class="ti ti-chevron-down dropdown-arrow"></i>
          </a>
          <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
              <a href="departemen.php" class="sidebar-link">
                <span class="hide-menu">Departemen</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="posisi.php" class="sidebar-link">
                <span class="hide-menu">Posisi</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="karyawan.php" class="sidebar-link">
                <span class="hide-menu">Karyawan</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link primary-hover-bg" href="laporan_hasil_audit.php" aria-expanded="false">
            <iconify-icon icon="solar:document-text-line-duotone"></iconify-icon>
            <span class="hide-menu">Laporan Hasil Audit</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link primary-hover-bg" href="manual_book.php" aria-expanded="false">
            <iconify-icon icon="solar:book-line-duotone"></iconify-icon>
            <span class="hide-menu">Manual Book</span>
          </a>
        </li>
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
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->