<?php
$files = glob('*.php');
$excludeFiles = ['replace_all_headers.php', 'login.php', 'logout.php', 'login_process.php', 'config.php', 'sidebar.php', 'profile_modals.php', 'header.php'];

foreach ($files as $file) {
    if (!in_array($file, $excludeFiles)) {
        $content = file_get_contents($file);
        $updated = false;
        
        // Pattern untuk mencari header section yang belum diganti
        if (strpos($content, 'app-topstrip bg-primary') !== false && strpos($content, "include 'header.php'") === false) {
            // Cari dan ganti seluruh div header
            $pattern = '/\s*<div class="app-topstrip bg-primary[^>]*>.*?<\/div>/s';
            if (preg_match($pattern, $content)) {
                $content = preg_replace($pattern, '    <?php include \'header.php\'; ?>', $content);
                $updated = true;
            }
        }
        
        if ($updated) {
            file_put_contents($file, $content);
            echo "Updated header in: $file\n";
        }
    }
}
echo "All headers replaced with header.php!\n";
?>