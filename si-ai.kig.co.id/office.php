<?php
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
  <title>Office - SI AI KIG</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/kig.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link rel="stylesheet" href="assets/css/custom.css" />
  <link rel="stylesheet" href="assets/css/mobile-sidebar.css" />
  <link rel="stylesheet" href="assets/css/dropdown-style.css" />
  <link rel="stylesheet" href="assets/css/dark-mode.css" />
  <link rel="stylesheet" href="assets/css/universal-dark-mode.css" />
</head>
<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <?php include 'header.php'; ?>

    <?php include 'sidebar.php'; ?>

    <div class="body-wrapper">
      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title fw-semibold mb-4">Office</h5>
                  <p>Halaman untuk mengelola data kantor dan departemen.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="sidebar-overlay"></div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/menu-functions.js"></script>
  <script src="assets/js/theme-manager.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  <script>
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
  <?php include 'profile_modals.php'; ?>
</body>
</html>