# Changelog - Sistem Informasi Audit PT KIG

## Update Terbaru

### Perubahan yang Dilakukan:

#### 1. Halaman Login sebagai Halaman Utama
- ✅ Route `/` sekarang redirect ke halaman login
- ✅ Login menjadi halaman pertama yang dilihat user

#### 2. Fitur Register Dihapus
- ✅ Route register dihapus dari `routes/auth.php`
- ✅ User hanya bisa dibuat melalui admin atau seeder
- ✅ Tidak ada link register di halaman login

#### 3. Dark Mode Dihilangkan
- ✅ Semua class `dark:*` dihapus dari semua view
- ✅ Tampilan menggunakan light mode dengan tema biru
- ✅ Konsisten di semua halaman (login, dashboard, profile)

#### 4. Tema Warna Biru
- ✅ Primary button: `bg-blue-600` hover `bg-blue-700`
- ✅ Focus ring: `focus:ring-blue-500`
- ✅ Border active: `border-blue-600`
- ✅ Panel kiri login: `bg-blue-600` solid (tanpa gradasi)

### File yang Dimodifikasi:

#### Routes
- `routes/web.php` - Redirect root ke login
- `routes/auth.php` - Hapus route register

#### Layouts
- `resources/views/layouts/guest.blade.php` - Custom login layout
- `resources/views/layouts/app.blade.php` - Hapus dark mode
- `resources/views/layouts/navigation.blade.php` - Hapus dark mode

#### Views
- `resources/views/auth/login.blade.php` - Custom login page
- `resources/views/dashboard.blade.php` - Dashboard dengan statistik audit
- `resources/views/profile/edit.blade.php` - Hapus dark mode
- `resources/views/profile/partials/*.blade.php` - Hapus dark mode, terjemahan Indonesia

#### Components
- `resources/views/components/text-input.blade.php` - Hapus dark mode
- `resources/views/components/input-label.blade.php` - Hapus dark mode
- `resources/views/components/primary-button.blade.php` - Tema biru
- `resources/views/components/nav-link.blade.php` - Hapus dark mode
- `resources/views/components/responsive-nav-link.blade.php` - Hapus dark mode

### Fitur yang Tersedia:

1. **Login**
   - Login dengan username atau email
   - Remember me
   - Forgot password
   - Rate limiting

2. **Dashboard**
   - Statistik audit (placeholder)
   - Informasi user yang login
   - Role-based display

3. **Profile**
   - Update informasi profil
   - Update password
   - Delete account

### Cara Mengakses:

1. Buka browser: `http://localhost:8000`
2. Otomatis redirect ke halaman login
3. Login dengan kredensial:
   - Username: `admin` / Email: `admin@kig.co.id`
   - Password: `password`

### Catatan Penting:

- ⚠️ Fitur register tidak tersedia untuk user umum
- ⚠️ User baru harus dibuat oleh admin melalui sistem
- ⚠️ Dark mode telah dihapus sepenuhnya
- ⚠️ Semua teks telah diterjemahkan ke Bahasa Indonesia

### Next Development:

1. Implementasi CRUD untuk data audit
2. Role & permission management
3. Dashboard dengan data real
4. Fitur laporan audit
5. Upload dokumen audit
6. Notifikasi sistem
