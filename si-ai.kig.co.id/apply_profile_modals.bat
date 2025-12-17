@echo off
echo Applying profile modals to all PHP files...

set "files=proker_2026.php proker_2027.php proker_2028.php proker_2029.php proker_2030.php laporan_hasil_audit.php posisi.php tahun_proker_audit.php office.php konfigurasi.php manual_book.php"

for %%f in (%files%) do (
    if exist "%%f" (
        powershell -Command "(Get-Content '%%f') -replace '<li><a class=\"dropdown-item\" href=\"#\"><i class=\"ti ti-user me-2\"></i>My Profile</a></li>', '<li><a class=\"dropdown-item\" href=\"#\" data-bs-toggle=\"modal\" data-bs-target=\"#profileModal\"><i class=\"ti ti-user me-2\"></i>My Profile</a></li>' | Set-Content '%%f'"
        powershell -Command "(Get-Content '%%f') -replace '<li><a class=\"dropdown-item\" href=\"#\"><i class=\"ti ti-settings me-2\"></i>My Account</a></li>', '<li><a class=\"dropdown-item\" href=\"#\" data-bs-toggle=\"modal\" data-bs-target=\"#accountModal\"><i class=\"ti ti-settings me-2\"></i>My Account</a></li>' | Set-Content '%%f'"
        powershell -Command "(Get-Content '%%f') -replace '</body>', '  <?php include ''profile_modals.php''; ?>`n</body>' | Set-Content '%%f'"
        echo Updated: %%f
    )
)

echo Profile modals applied to all files!
pause