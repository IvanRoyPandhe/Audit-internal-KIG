@echo off
echo Updating remaining PHP files with universal dark mode CSS...

set "files=proker_2026.php proker_2027.php proker_2028.php proker_2029.php proker_2030.php laporan_hasil_audit.php posisi.php tahun_proker_audit.php office.php konfigurasi.php"

for %%f in (%files%) do (
    if exist "%%f" (
        powershell -Command "(Get-Content '%%f') -replace '  <link rel=\"stylesheet\" href=\"assets/css/dark-mode.css\" />', '  <link rel=\"stylesheet\" href=\"assets/css/dark-mode.css\" />`n  <link rel=\"stylesheet\" href=\"assets/css/universal-dark-mode.css\" />' | Set-Content '%%f'"
        echo Updated: %%f
    )
)

echo All files updated successfully!
pause