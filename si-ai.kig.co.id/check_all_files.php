<?php
$files = glob('*.php');
$excludeFiles = ['check_all_files.php', 'login.php', 'logout.php', 'login_process.php', 'config.php', 'sidebar.php', 'profile_modals.php'];

echo "Checking all files for modal functionality:\n\n";

foreach ($files as $file) {
    if (!in_array($file, $excludeFiles)) {
        $content = file_get_contents($file);
        
        $hasDropdown = strpos($content, 'My Profile') !== false;
        $hasModalAttr = strpos($content, 'data-bs-toggle="modal"') !== false;
        $hasInclude = strpos($content, 'profile_modals.php') !== false;
        
        echo "$file:\n";
        echo "  - Has dropdown: " . ($hasDropdown ? "YES" : "NO") . "\n";
        echo "  - Has modal attr: " . ($hasModalAttr ? "YES" : "NO") . "\n";
        echo "  - Has include: " . ($hasInclude ? "YES" : "NO") . "\n";
        
        if ($hasDropdown && (!$hasModalAttr || !$hasInclude)) {
            echo "  - STATUS: NEEDS FIX\n";
        } else if ($hasDropdown) {
            echo "  - STATUS: OK\n";
        } else {
            echo "  - STATUS: NO DROPDOWN\n";
        }
        echo "\n";
    }
}
?>