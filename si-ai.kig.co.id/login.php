<?php
// login.php - Login Page
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - SI AI KIG</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/kig.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <style>
    body {
      background: url('assets/images/logos/background.jpg') no-repeat center center fixed !important;
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
</head>
<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-5 col-xxl-4">
            <div class="card mb-0">
              <div class="card-body">
                <div class="text-center mb-4">
                  <img src="assets/images/logos/kig.png" alt="SI AI KIG" width="90">
                  <h6 class="mt-3">SISTEM INFORMASI AUDIT INTERNAL</h6>
                  
                </div>
                <form id="loginForm">
                  <div class="mb-3">
                    <label for="employee_id" class="form-label">ID Pegawai</label>
                    <input type="text" class="form-control" id="employee_id" required>
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="position-relative">
                      <input type="password" class="form-control" id="password" required>
                      <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;" id="togglePassword">
                        <i class="ti ti-eye" id="eyeIcon"></i>
                      </span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">
                        Ingat saya
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="javascript:void(0)">Lupa Password?</a>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Login</button>
                  
                </form>

                <div class="panel-footer">
												<div class="text-center">
													<p class="footer-text small">Copyright &copy; 2025. PT Kawasan Industri Gresik <br class="d-sm-none"> <span class="d-none d-sm-inline"><br></span> Developed by IT KIG</p>
												</div>
											</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $('#loginForm').on('submit', function(e) {
      e.preventDefault();
      
      const employee_id = $('#employee_id').val();
      const password = $('#password').val();
      
      // Send login request to PHP
      $.post('login_process.php', {
        employee_id: employee_id,
        password: password
      }, function(response) {
        if (response === 'success') {
          showAlert('Login berhasil!', 'success');
          setTimeout(() => {
            window.location.href = 'dashboard.php';
          }, 1500);
        } else {
          showAlert('ID Pegawai atau password salah!', 'error');
        }
      });
    });
    
    // Toggle password visibility
    $(document).on('click', '#togglePassword', function() {
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
    
    function showAlert(message, type) {
      const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
      const iconClass = type === 'success' ? 'ti-check-circle' : 'ti-alert-circle';
      
      const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show position-fixed" 
             style="top: 20px; right: 20px; z-index: 9999; min-width: 350px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
          <div class="d-flex align-items-center">
            <i class="ti ${iconClass} fs-4 me-2"></i>
            <div>
              <strong>${type === 'success' ? 'Berhasil!' : 'Error!'}</strong>
              <div>${message}</div>
            </div>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      `;
      
      $('body').append(alertHtml);
      
      setTimeout(() => {
        $('.alert').alert('close');
      }, 4000);
    }
  </script>
</body>
</html>