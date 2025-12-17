<?php
$files = glob('*.php');
$excludeFiles = ['apply_to_all.php', 'login.php', 'logout.php', 'login_process.php', 'config.php', 'sidebar.php', 'profile_modals.php'];

foreach ($files as $file) {
    if (!in_array($file, $excludeFiles)) {
        $content = file_get_contents($file);
        $updated = false;
        
        // Add universal dark mode CSS if missing
        if (strpos($content, 'universal-dark-mode.css') === false && strpos($content, 'dark-mode.css') !== false) {
            $content = str_replace(
                '<link rel="stylesheet" href="assets/css/dark-mode.css" />',
                '<link rel="stylesheet" href="assets/css/dark-mode.css" />' . "\n" . '  <link rel="stylesheet" href="assets/css/universal-dark-mode.css" />',
                $content
            );
            $updated = true;
        }
        
        // Update dropdown links
        if (strpos($content, 'data-bs-toggle="modal"') === false) {
            $content = str_replace(
                '<li><a class="dropdown-item" href="#"><i class="ti ti-user me-2"></i>My Profile</a></li>',
                '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal"><i class="ti ti-user me-2"></i>My Profile</a></li>',
                $content
            );
            
            $content = str_replace(
                '<li><a class="dropdown-item" href="#"><i class="ti ti-settings me-2"></i>My Account</a></li>',
                '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#accountModal"><i class="ti ti-settings me-2"></i>My Account</a></li>',
                $content
            );
            $updated = true;
        }
        
        // Add profile modals include
        if (strpos($content, 'profile_modals.php') === false && strpos($content, '</body>') !== false) {
            $content = str_replace('</body>', '  <?php include \'profile_modals.php\'; ?>' . "\n</body>", $content);
            $updated = true;
        }
        
        if ($updated) {
            file_put_contents($file, $content);
            echo "Updated: $file\n";
        }
    }
}
echo "All files updated!\n";
?>