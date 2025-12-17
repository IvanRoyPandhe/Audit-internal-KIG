<?php
// Script untuk menambahkan universal dark mode CSS ke semua file PHP
$files = [
    'akun_user.php',
    'departemen.php', 
    'karyawan.php',
    'konfigurasi.php',
    'laporan_hasil_audit.php',
    'manual_book.php',
    'office.php',
    'posisi.php',
    'program_kerja.php',
    'proker_2026.php',
    'proker_2027.php',
    'proker_2028.php',
    'proker_2029.php',
    'proker_2030.php',
    'tahun_proker_audit.php'
];

$cssLink = '  <link rel="stylesheet" href="assets/css/universal-dark-mode.css" />';

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // Cek apakah sudah ada universal-dark-mode.css
        if (strpos($content, 'universal-dark-mode.css') === false) {
            // Cari posisi setelah dark-mode.css atau sebelum </head>
            if (strpos($content, 'dark-mode.css') !== false) {
                $content = str_replace('dark-mode.css" />', 'dark-mode.css" />' . "\n" . $cssLink, $content);
            } else if (strpos($content, '</head>') !== false) {
                $content = str_replace('</head>', $cssLink . "\n</head>", $content);
            }
            
            file_put_contents($file, $content);
            echo "Updated: $file\n";
        } else {
            echo "Already updated: $file\n";
        }
    }
}

echo "Universal dark mode applied to all files!\n";
?>