// Theme Manager - Global dark/light mode functionality
$(document).ready(function() {
    // Load saved theme on page load
    const savedTheme = localStorage.getItem('theme') || 'light';
    applyTheme(savedTheme);
    
    // Dark mode toggle handler
    $(document).on('change', '#darkModeToggle', function() {
        const theme = $(this).is(':checked') ? 'dark' : 'light';
        applyTheme(theme);
        localStorage.setItem('theme', theme);
    });
});

function applyTheme(theme) {
    $('html').attr('data-theme', theme);
    
    if (theme === 'dark') {
        $('#darkModeToggle').prop('checked', true);
    } else {
        $('#darkModeToggle').prop('checked', false);
    }
}