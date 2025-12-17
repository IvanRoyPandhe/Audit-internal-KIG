<?php
$files = glob('*.php');
$excludeFiles = ['final_complete_fix.php', 'login.php', 'logout.php', 'login_process.php', 'config.php', 'sidebar.php', 'profile_modals.php'];

foreach ($files as $file) {
    if (!in_array($file, $excludeFiles)) {
        $content = file_get_contents($file);
        $updated = false;
        
        // Check if dropdown exists but doesn't have modal attributes
        if (strpos($content, 'My Profile') !== false && strpos($content, 'data-bs-toggle="modal"') === false) {
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
        
        // Check if profile_modals.php include is missing
        if (strpos($content, 'profile_modals.php') === false && strpos($content, '</body>') !== false) {
            $content = str_replace('</body>', '  <?php include \'profile_modals.php\'; ?>' . "\n</body>", $content);
            $updated = true;
        }
        
        if ($updated) {
            file_put_contents($file, $content);
            echo "Fixed: $file\n";
        }
    }
}
echo "Final fix completed!\n";
?>