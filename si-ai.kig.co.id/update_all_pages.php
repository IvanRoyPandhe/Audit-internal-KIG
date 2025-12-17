<?php
// Script untuk update semua halaman dengan dark mode
$pages = [
    'akun_user.php', 'departemen.php', 'karyawan.php', 'laporan_hasil_audit.php',
    'manual_book.php', 'office.php', 'posisi.php', 'program_kerja.php',
    'proker_2026.php', 'proker_2027.php', 'proker_2028.php', 'proker_2029.php',
    'proker_2030.php', 'tahun_proker_audit.php'
];

foreach ($pages as $page) {
    if (file_exists($page)) {
        $content = file_get_contents($page);
        
        // Add CSS links if not present
        if (strpos($content, 'dropdown-style.css') === false) {
            $content = str_replace(
                '<link rel="stylesheet" href="assets/css/mobile-sidebar.css" />',
                '<link rel="stylesheet" href="assets/css/mobile-sidebar.css" />
  <link rel="stylesheet" href="assets/css/dropdown-style.css" />
  <link rel="stylesheet" href="assets/css/dark-mode.css" />',
                $content
            );
        }
        
        // Add theme-manager.js if not present
        if (strpos($content, 'theme-manager.js') === false) {
            $content = str_replace(
                '<script src="assets/js/menu-functions.js"></script>',
                '<script src="assets/js/menu-functions.js"></script>
  <script src="assets/js/theme-manager.js"></script>',
                $content
            );
        }
        
        file_put_contents($page, $content);
        echo "Updated: $page\n";
    }
}

echo "All pages updated with dark mode support!";
?>