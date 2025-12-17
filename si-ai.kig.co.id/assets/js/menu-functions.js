// Menu Functions untuk SI AI KIG Dashboard
$(document).ready(function() {
    // Highlight active menu
    highlightActiveMenu();
    
    // Handle sidebar menu clicks
    $('.sidebar-link').on('click', function(e) {
        e.preventDefault();
        
        const href = $(this).attr('href');
        const menuText = $(this).find('.hide-menu').text();
        
        // Remove active class from all sub menu items only
        $('.first-level .sidebar-link').removeClass('active');
        
        // Add active class to clicked sub menu item if it's a sub menu
        if ($(this).closest('.first-level').length > 0) {
            $(this).addClass('active');
            return; // Don't navigate for sub menu clicks in this handler
        }
        
        // Handle different menu actions
        switch(href) {
            case 'dashboard.php':
                // Navigate to dashboard without showing notification
                window.location.href = 'dashboard.php';
                break;
            case 'program_kerja.php':
                window.location.href = 'program_kerja.php';
                break;
            case 'alerts.php':
                window.location.href = 'alerts.php';
                break;
            case 'cards.php':
                window.location.href = 'cards.php';
                break;
            case 'forms.php':
                window.location.href = 'forms.php';
                break;
            case 'typography.php':
                window.location.href = 'typography.php';
                break;
            case 'login.php':
                handleLogin();
                break;
            case 'register.php':
                handleRegister();
                break;
            case 'icons.php':
                window.location.href = 'icons.php';
                break;
            case 'sample.php':
                window.location.href = 'sample.php';
                break;
            case 'konfigurasi.php':
                window.location.href = 'konfigurasi.php';
                break;
            case 'office.php':
                window.location.href = 'office.php';
                break;
            case 'laporan_hasil_audit.php':
                window.location.href = 'laporan_hasil_audit.php';
                break;
            case 'manual_book.php':
                window.location.href = 'manual_book.php';
                break;
            default:
                console.log('Menu clicked:', menuText);
        }
    });
    
    // Profile dropdown functions
    $('.dropdown-item').on('click', function(e) {
        const text = $(this).find('p').text();
        
        if (text === 'My Profile') {
            showProfile();
        } else if (text === 'My Account') {
            showAccount();
        }
    });
    
    // Handle sub menu clicks separately
    $('.first-level .sidebar-link').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Remove active from all sub menus
        $('.first-level .sidebar-link').removeClass('active');
        
        // Add active to clicked sub menu
        $(this).addClass('active');
        
        // Navigate to the page
        const href = $(this).attr('href');
        if (href && href !== '#') {
            window.location.href = href;
        }
    });
});

function highlightActiveMenu() {
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';
    $(`.sidebar-link[href="${currentPage}"]`).closest('.sidebar-item').addClass('active');
}

function loadDashboard() {
    // Refresh dashboard content without showing notification
    if (typeof loadDashboardData === 'function') {
        loadDashboardData();
    }
}

function loadButtons() {
    showNotification('Halaman Buttons dimuat', 'info');
    // Load buttons page content
    loadPageContent('buttons');
}

function loadAlerts() {
    showNotification('Halaman Alerts dimuat', 'info');
    loadPageContent('alerts');
}

function loadCards() {
    showNotification('Halaman Cards dimuat', 'info');
    loadPageContent('cards');
}

function loadForms() {
    showNotification('Halaman Forms dimuat', 'info');
    loadPageContent('forms');
}

function loadTypography() {
    showNotification('Halaman Typography dimuat', 'info');
    loadPageContent('typography');
}

function handleLogin() {
    if (confirm('Apakah Anda ingin logout dari sistem?')) {
        showNotification('Logout berhasil', 'success');
        setTimeout(() => {
            window.location.href = 'login.php';
        }, 1000);
    }
}

function handleRegister() {
    showNotification('Halaman Register dimuat', 'info');
    window.location.href = 'register.php';
}

function loadIcons() {
    showNotification('Halaman Icons dimuat', 'info');
    loadPageContent('icons');
}

function loadSamplePage() {
    showNotification('Sample Page dimuat', 'info');
    loadPageContent('sample');
}

function showProfile() {
    showNotification('Profil pengguna', 'info');
    // Show profile modal or navigate to profile page
    $('#profileModal').modal('show');
}

function showAccount() {
    showNotification('Pengaturan akun', 'info');
    // Show account settings
    $('#accountModal').modal('show');
}

function loadPageContent(page) {
    // Simulate loading page content
    const mainContent = $('.container-fluid .row').first();
    
    switch(page) {
        case 'buttons':
            mainContent.html(`
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">UI Buttons</h5>
                            <button class="btn btn-primary me-2">Primary</button>
                            <button class="btn btn-secondary me-2">Secondary</button>
                            <button class="btn btn-success me-2">Success</button>
                            <button class="btn btn-danger me-2">Danger</button>
                            <button class="btn btn-warning me-2">Warning</button>
                            <button class="btn btn-info me-2">Info</button>
                        </div>
                    </div>
                </div>
            `);
            break;
        case 'alerts':
            mainContent.html(`
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">UI Alerts</h5>
                            <div class="alert alert-primary">Primary Alert</div>
                            <div class="alert alert-success">Success Alert</div>
                            <div class="alert alert-danger">Danger Alert</div>
                            <div class="alert alert-warning">Warning Alert</div>
                        </div>
                    </div>
                </div>
            `);
            break;
        case 'cards':
            mainContent.html(`
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">UI Cards</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Card 1</h6>
                                            <p class="card-text">Sample card content</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
            break;
        case 'forms':
            mainContent.html(`
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">UI Forms</h5>
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            `);
            break;
        default:
            mainContent.html(`
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">${page.charAt(0).toUpperCase() + page.slice(1)} Page</h5>
                            <p>Konten untuk halaman ${page}</p>
                        </div>
                    </div>
                </div>
            `);
    }
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = $(`
        <div class="alert alert-${type} alert-dismissible fade show position-fixed" 
             style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `);
    
    $('body').append(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.alert('close');
    }, 3000);
}