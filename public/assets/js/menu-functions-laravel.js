// Menu Functions untuk Laravel - SI AI KIG Dashboard
$(document).ready(function() {
    // Highlight active menu
    highlightActiveMenu();
    
    // Handle dropdown menu toggle
    $('.sidebar-link').on('click', function(e) {
        const $this = $(this);
        const hasDropdown = $this.find('.dropdown-arrow').length > 0;
        
        // Jika menu memiliki dropdown (submenu)
        if (hasDropdown) {
            e.preventDefault();
            
            const $parent = $this.parent();
            const $submenu = $parent.find('.first-level');
            
            // Toggle submenu
            $submenu.toggleClass('show');
            
            // Toggle arrow rotation
            $this.find('.dropdown-arrow').toggleClass('rotate-180');
            
            return false;
        }
        
        // Untuk menu tanpa dropdown, biarkan navigasi normal (Laravel routing)
        // Tidak perlu preventDefault, biarkan href bekerja normal
    });
    
    // Close other submenus when opening a new one
    $('.sidebar-link').on('click', function(e) {
        const $this = $(this);
        const hasDropdown = $this.find('.dropdown-arrow').length > 0;
        
        if (hasDropdown) {
            const $parent = $this.parent();
            
            // Close other open submenus
            $('.sidebar-item').not($parent).find('.first-level').removeClass('show');
            $('.sidebar-item').not($parent).find('.dropdown-arrow').removeClass('rotate-180');
        }
    });
});

function highlightActiveMenu() {
    // Active menu sudah dihandle oleh Laravel blade dengan class 'active'
    // Tidak perlu JavaScript tambahan
    
    // Pastikan submenu yang memiliki item aktif tetap terbuka
    $('.first-level .sidebar-link.active').each(function() {
        $(this).closest('.first-level').addClass('show');
        $(this).closest('.sidebar-item').find('.dropdown-arrow').addClass('rotate-180');
    });
}

// Add rotation class for arrow
$('<style>')
    .prop('type', 'text/css')
    .html('.rotate-180 { transform: rotate(180deg); transition: transform 0.3s; }')
    .appendTo('head');
