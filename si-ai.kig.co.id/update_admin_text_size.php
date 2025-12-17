<?php
$files = glob('*.php');
$excludeFiles = ['update_admin_text_size.php', 'login.php', 'logout.php', 'login_process.php', 'config.php', 'sidebar.php', 'profile_modals.php'];

foreach ($files as $file) {
    if (!in_array($file, $excludeFiles)) {
        $content = file_get_contents($file);
        
        if (strpos($content, 'fs-6">Admin</span>') !== false) {
            $content = str_replace(
                '<span class="text-white fs-6">Admin</span>',
                '<span class="text-white small">Admin</span>',
                $content
            );
            file_put_contents($file, $content);
            echo "Updated: $file\n";
        }
    }
}
echo "Admin text size updated in all files!\n";
?>