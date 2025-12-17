<?php
$files = glob('*.php');
$excludeFiles = ['apply_header_to_all.php', 'login.php', 'logout.php', 'login_process.php', 'config.php', 'sidebar.php', 'profile_modals.php', 'header.php'];

foreach ($files as $file) {
    if (!in_array($file, $excludeFiles)) {
        $content = file_get_contents($file);
        
        // Find and replace the header section
        $pattern = '/<div class="app-topstrip bg-primary py-3 px-3 w-100 d-flex align-items-center justify-content-between">.*?<\/div>/s';
        
        if (preg_match($pattern, $content)) {
            $content = preg_replace($pattern, '<?php include \'header.php\'; ?>', $content);
            file_put_contents($file, $content);
            echo "Updated header in: $file\n";
        }
    }
}
echo "Header applied to all files!\n";
?>