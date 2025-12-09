# Setup Instructions - Sistem Informasi Audit PT KIG

## Instalasi Laravel Breeze

Fitur login telah berhasil diimplementasikan menggunakan Laravel Breeze dengan kustomisasi untuk aplikasi audit PT KIG.

## Fitur yang Telah Dibuat

### 1. Authentication System
- ✅ Login dengan username atau email
- ✅ Remember me functionality
- ✅ Forgot password
- ✅ Session management
- ✅ Rate limiting (5 attempts)
- ✅ Last login tracking

### 2. Database Schema
Tabel `users` dengan field:
- `id` - Primary key
- `name` - Nama lengkap
- `username` - Username untuk login (unique)
- `email` - Email (unique)
- `employee_id` - ID Karyawan (unique)
- `department` - Departemen
- `position` - Jabatan
- `role` - Role (admin, auditor, auditee, viewer)
- `is_active` - Status aktif
- `password` - Password (hashed)
- `last_login_at` - Timestamp login terakhir
- `email_verified_at` - Timestamp verifikasi email
- `remember_token` - Token remember me
- `timestamps` - created_at & updated_at

### 3. Tampilan Login
Desain custom dengan:
- Panel kiri biru solid (tanpa gradasi) dengan informasi sistem
- Logo KIG (icon audit)
- Form login di panel kanan
- Responsive design
- Portal alternatif (Auditor & Admin)
- Link IT Support

### 4. Seeder Data
3 user default telah dibuat:
- Admin (admin@kig.co.id / admin)
- Auditor (auditor@kig.co.id / auditor)
- Auditee (auditee@kig.co.id / auditee)

Password semua akun: `password`

## Cara Menjalankan

### 1. Install Dependencies
```bash
composer install
npm install
```

### 2. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Konfigurasi Database
Edit file `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=audit_kig
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Jalankan Migration & Seeder
```bash
php artisan migrate:fresh --seed
```

### 5. Build Assets
```bash
npm run build
# atau untuk development
npm run dev
```

### 6. Jalankan Server
```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

## File yang Telah Dimodifikasi/Dibuat

### Views
- `resources/views/layouts/guest.blade.php` - Layout login custom
- `resources/views/auth/login.blade.php` - Halaman login custom

### Controllers & Requests
- `app/Http/Requests/Auth/LoginRequest.php` - Support login dengan username/email

### Models
- `app/Models/User.php` - Tambah field audit

### Migrations
- `database/migrations/0001_01_01_000000_create_users_table.php` - Tabel users
- `database/migrations/2025_12_08_174237_add_audit_fields_to_users_table.php` - Field audit

### Seeders
- `database/seeders/UserSeeder.php` - Data user default
- `database/seeders/DatabaseSeeder.php` - Main seeder

## Kustomisasi Tambahan

### Mengubah Logo
Untuk mengganti logo KIG, edit file:
`resources/views/layouts/guest.blade.php`

Cari bagian:
```html
<div class="w-24 h-24 bg-blue-500 rounded-full flex items-center justify-center">
    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
        <!-- SVG icon -->
    </svg>
</div>
```

Ganti dengan logo image:
```html
<img src="{{ asset('images/logo-kig.png') }}" alt="Logo KIG" class="w-24 h-24">
```

### Mengubah Warna
Warna biru saat ini: `bg-blue-600`

Untuk mengubah, edit file `resources/views/layouts/guest.blade.php` dan cari semua class `bg-blue-*` dan `text-blue-*`.

### Menambah Field User
1. Buat migration baru:
```bash
php artisan make:migration add_new_field_to_users_table --table=users
```

2. Update model `app/Models/User.php` di bagian `$fillable`

3. Jalankan migration:
```bash
php artisan migrate
```

## Testing

### Login Test
1. Buka `http://localhost:8000/login`
2. Login dengan:
   - Username: `admin` atau Email: `admin@kig.co.id`
   - Password: `password`
3. Setelah login, akan redirect ke dashboard

### Logout Test
1. Klik tombol logout di navigation
2. Session akan dihapus dan redirect ke halaman login

## Troubleshooting

### Error: SQLSTATE[HY000] [1049] Unknown database
Buat database terlebih dahulu:
```sql
CREATE DATABASE audit_kig;
```

### Error: Vite manifest not found
Jalankan:
```bash
npm run build
```

### Error: Class 'UserSeeder' not found
Jalankan:
```bash
composer dump-autoload
```

## Next Steps

Setelah login berhasil, Anda dapat:
1. Membuat CRUD untuk data audit
2. Membuat dashboard dengan statistik
3. Implementasi role & permission
4. Membuat fitur laporan audit
5. Implementasi notifikasi
6. Membuat fitur upload dokumen

## Support

Untuk bantuan lebih lanjut, hubungi IT Support PT KIG.
