<?php
$files = glob('*.php');
$logoPattern = '<img src="assets/images/logos/kig.png" alt="SI AI KIG" width="40" class="text-white">';
$logoReplacement = '<a href="dashboard.php">
          <img src="assets/images/logos/kig.png" alt="SI AI KIG" width="40" class="text-white">
        </a>';

foreach ($files as $file) {
    if ($file !== 'update_logo_links.php' && $file !== 'apply_universal_dark_mode.php') {
        $content = file_get_contents($file);
        if (strpos($content, $logoPattern) !== false && strpos($content, '<a href="dashboard.php">') === false) {
            $content = str_replace($logoPattern, $logoReplacement, $content);
            file_put_contents($file, $content);
            echo "Updated logo link in: $file\n";
        }
    }
}
echo "Logo links updated!\n";
?>