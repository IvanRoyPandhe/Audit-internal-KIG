// Enhanced Dashboard Functions
function loadDashboardData() {
    // Update statistics without notifications
    setTimeout(() => {
        updateStatistics();
    }, 1000);
}

function updateStatistics() {
    // Update the percentage display
    const percentage = Math.floor(Math.random() * 100) + 1;
    const growth = Math.floor(Math.random() * 20) + 1;
    
    $('.fw-semibold.mb-3').text(percentage + '%');
    $('.text-dark.me-1.fs-3.mb-0').text('+' + growth + '%');
}

// Initialize dashboard on page load
$(document).ready(function() {
    
    // Auto refresh every 30 seconds
    setInterval(updateStatistics, 30000);
    
    // Handle logout button in dropdown
    $('.btn-outline-primary').on('click', function(e) {
        e.preventDefault();
        if (confirm('Apakah Anda yakin ingin logout?')) {
            showNotification('Logout berhasil', 'success');
            setTimeout(() => {
                window.location.href = 'authentication-login.html';
            }, 1000);
        }
    });
    
    // Handle profile modal save
    $('#profileModal .btn-primary').on('click', function() {
        showNotification('Profil berhasil diperbarui', 'success');
        $('#profileModal').modal('hide');
    });
    
    // Handle account modal save
    $('#accountModal .btn-primary').on('click', function() {
        const oldPassword = $('#accountModal input[type="password"]').eq(0).val();
        const newPassword = $('#accountModal input[type="password"]').eq(1).val();
        const confirmPassword = $('#accountModal input[type="password"]').eq(2).val();
        
        if (!oldPassword || !newPassword || !confirmPassword) {
            showNotification('Semua field password harus diisi', 'warning');
            return;
        }
        
        if (newPassword !== confirmPassword) {
            showNotification('Password baru tidak cocok', 'danger');
            return;
        }
        
        if (newPassword.length < 6) {
            showNotification('Password minimal 6 karakter', 'warning');
            return;
        }
        
        showNotification('Pengaturan akun berhasil disimpan', 'success');
        $('#accountModal').modal('hide');
        
        // Clear form
        $('#accountModal input[type="password"]').val('');
    });
});