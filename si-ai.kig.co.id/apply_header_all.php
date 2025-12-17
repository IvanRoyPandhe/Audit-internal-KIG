<?php
$files = [
    'proker_2027.php', 'proker_2028.php', 'proker_2029.php', 'proker_2030.php',
    'posisi.php', 'laporan_hasil_audit.php', 'tahun_proker_audit.php', 
    'office.php', 'konfigurasi.php', 'program_kerja.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // Replace header section with include
        $pattern = '/<div class="app-topstrip bg-primary py-3 px-3 w-100 d-flex align-items-center justify-content-between">.*?<\/div>/s';
        
        if (preg_match($pattern, $content) && strpos($content, "include 'header.php'") === false) {
            $content = preg_replace($pattern, '<?php include \'header.php\'; ?>', $content);
            file_put_contents($file, $content);
            echo "Updated: $file\n";
        }
    }
}
echo "Header applied to all remaining files!\n";
?>