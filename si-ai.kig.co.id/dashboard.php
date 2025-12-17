<?php
// dashboard.php - Main Dashboard Page
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
  <title>SI AI KIG Dashboard</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/kig.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link rel="stylesheet" href="assets/css/custom.css" />
  <link rel="stylesheet" href="assets/css/mobile-sidebar.css" />
  <link rel="stylesheet" href="assets/css/dropdown-style.css" />
  <link rel="stylesheet" href="assets/css/dark-mode.css" />
  <link rel="stylesheet" href="assets/css/universal-dark-mode.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!--  App Topstrip -->
    <?php include 'header.php'; ?>

    <?php include 'sidebar.php'; ?>
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <div class="body-wrapper-inner">
        <div class="container-fluid">
          

          <!-- Statistics Cards Row -->
          <div class="row mb-4">
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      <div class="bg-primary rounded-circle p-3">
                        <i class="ti ti-users text-white fs-5"></i>
                      </div>
                    </div>
                    <div>
                      <h6 class="mb-0">Total Users</h6>
                      <h4 class="mb-0 text-primary">1,245</h4>
                      <small class="text-success">+12% dari bulan lalu</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      <div class="bg-success rounded-circle p-3">
                        <i class="ti ti-file-text text-white fs-5"></i>
                      </div>
                    </div>
                    <div>
                      <h6 class="mb-0">Total Reports</h6>
                      <h4 class="mb-0 text-success">856</h4>
                      <small class="text-success">+8% dari bulan lalu</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      <div class="bg-warning rounded-circle p-3">
                        <i class="ti ti-clock text-white fs-5"></i>
                      </div>
                    </div>
                    <div>
                      <h6 class="mb-0">Pending Tasks</h6>
                      <h4 class="mb-0 text-warning">23</h4>
                      <small class="text-danger">-5% dari bulan lalu</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      <div class="bg-info rounded-circle p-3">
                        <i class="ti ti-chart-line text-white fs-5"></i>
                      </div>
                    </div>
                    <div>
                      <h6 class="mb-0">Performance</h6>
                      <h4 class="mb-0 text-info">94.5%</h4>
                      <small class="text-success">+2.1% dari bulan lalu</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--  Main Dashboard Row -->
          <div class="row">
            <div class="col-lg-8">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title fw-semibold mb-4">Dashboard SI AI KIG</h5>
                  <div id="profit"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="row">
                <div class="col-12 mb-3">
                  <div class="card">
                    <div class="card-body p-4">
                      <h5 class="card-title mb-3 fw-semibold">Statistik Bulanan</h5>
                      <div class="row align-items-center">
                        <div class="col-7">
                          <h4 class="fw-semibold mb-3">100%</h4>
                          <div class="d-flex align-items-center mb-2">
                            <span class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                              <i class="ti ti-arrow-up-left text-success"></i>
                            </span>
                            <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                            <p class="fs-3 mb-0">bulan ini</p>
                          </div>
                        </div>
                        <div class="col-5">
                          <div class="d-flex justify-content-center">
                            <div id="grade"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="card">
                    <div class="card-body p-4">
                      <h5 class="card-title mb-3 fw-semibold">Activity Log</h5>
                      <div class="timeline-widget">
                        <div class="timeline-item d-flex align-items-center mb-3">
                          <div class="timeline-icon bg-primary rounded-circle me-3" style="width: 8px; height: 8px;"></div>
                          <div>
                            <p class="mb-0 fs-3">New user registered</p>
                            <small class="text-muted">2 menit lalu</small>
                          </div>
                        </div>
                        <div class="timeline-item d-flex align-items-center mb-3">
                          <div class="timeline-icon bg-success rounded-circle me-3" style="width: 8px; height: 8px;"></div>
                          <div>
                            <p class="mb-0 fs-3">Report generated</p>
                            <small class="text-muted">15 menit lalu</small>
                          </div>
                        </div>
                        <div class="timeline-item d-flex align-items-center mb-3">
                          <div class="timeline-icon bg-warning rounded-circle me-3" style="width: 8px; height: 8px;"></div>
                          <div>
                            <p class="mb-0 fs-3">System maintenance</p>
                            <small class="text-muted">1 jam lalu</small>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Additional Statistics Row -->
          <div class="row mt-4">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title fw-semibold mb-4">Recent Activities</h5>
                  <div class="table-responsive">
                    <table class="table table-borderless">
                      <tbody>
                        <tr>
                          <td class="ps-0">
                            <div class="d-flex align-items-center">
                              <div class="me-2">
                                <span class="badge bg-primary rounded-circle p-2">
                                  <i class="ti ti-user fs-4"></i>
                                </span>
                              </div>
                              <div>
                                <h6 class="mb-0">User Login</h6>
                                <p class="mb-0 text-muted fs-3">Admin user logged in</p>
                              </div>
                            </div>
                          </td>
                          <td class="pe-0 text-end">
                            <small class="text-muted">5 min ago</small>
                          </td>
                        </tr>
                        <tr>
                          <td class="ps-0">
                            <div class="d-flex align-items-center">
                              <div class="me-2">
                                <span class="badge bg-success rounded-circle p-2">
                                  <i class="ti ti-check fs-4"></i>
                                </span>
                              </div>
                              <div>
                                <h6 class="mb-0">Task Completed</h6>
                                <p class="mb-0 text-muted fs-3">Data analysis finished</p>
                              </div>
                            </div>
                          </td>
                          <td class="pe-0 text-end">
                            <small class="text-muted">10 min ago</small>
                          </td>
                        </tr>
                        <tr>
                          <td class="ps-0">
                            <div class="d-flex align-items-center">
                              <div class="me-2">
                                <span class="badge bg-warning rounded-circle p-2">
                                  <i class="ti ti-alert-triangle fs-4"></i>
                                </span>
                              </div>
                              <div>
                                <h6 class="mb-0">System Alert</h6>
                                <p class="mb-0 text-muted fs-3">High CPU usage detected</p>
                              </div>
                            </div>
                          </td>
                          <td class="pe-0 text-end">
                            <small class="text-muted">30 min ago</small>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title fw-semibold mb-4">System Status</h5>
                  <div class="row">
                    <div class="col-6 mb-3">
                      <div class="text-center">
                        <div class="bg-light-success rounded-circle mx-auto mb-2" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                          <i class="ti ti-server text-success fs-5"></i>
                        </div>
                        <h6 class="mb-0">Server Status</h6>
                        <span class="badge bg-success">Online</span>
                      </div>
                    </div>
                    <div class="col-6 mb-3">
                      <div class="text-center">
                        <div class="bg-light-primary rounded-circle mx-auto mb-2" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                          <i class="ti ti-database text-primary fs-5"></i>
                        </div>
                        <h6 class="mb-0">Database</h6>
                        <span class="badge bg-primary">Connected</span>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="text-center">
                        <div class="bg-light-info rounded-circle mx-auto mb-2" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                          <i class="ti ti-wifi text-info fs-5"></i>
                        </div>
                        <h6 class="mb-0">Network</h6>
                        <span class="badge bg-info">Stable</span>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="text-center">
                        <div class="bg-light-warning rounded-circle mx-auto mb-2" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                          <i class="ti ti-shield text-warning fs-5"></i>
                        </div>
                        <h6 class="mb-0">Security</h6>
                        <span class="badge bg-warning">Protected</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>

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
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="assets/js/dashboard.js"></script>
  <script src="assets/js/menu-functions.js"></script>
  <script src="assets/js/dashboard-enhanced.js"></script>
  <script src="assets/js/theme-manager.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  <div class="sidebar-overlay"></div>
  <script>
    // Mobile sidebar toggle
    $('#sidebarToggle').on('click', function(e) {
      e.preventDefault();
      $('.left-sidebar').toggleClass('show-sidebar');
      $('.sidebar-overlay').toggleClass('show');
    });
    
    // Close sidebar when clicking overlay
    $('.sidebar-overlay').on('click', function() {
      $('.left-sidebar').removeClass('show-sidebar');
      $('.sidebar-overlay').removeClass('show');
    });
    
    // Close sidebar on window resize
    $(window).on('resize', function() {
      if ($(window).width() >= 992) {
        $('.left-sidebar').removeClass('show-sidebar');
        $('.sidebar-overlay').removeClass('show');
      }
    });
    

  </script>
</body>

</html>