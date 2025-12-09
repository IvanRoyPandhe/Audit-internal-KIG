# Kredensial Login - Sistem Informasi Audit PT KIG

## Akun Default

Berikut adalah akun default yang telah dibuat untuk testing:

### 1. Administrator
- **Username**: `admin`
- **Email**: `admin@kig.co.id`
- **Password**: `password`
- **Role**: Administrator
- **Department**: IT
- **Position**: System Administrator
- **Employee ID**: KIG001

### 2. Auditor
- **Username**: `auditor`
- **Email**: `auditor@kig.co.id`
- **Password**: `password`
- **Role**: Auditor
- **Department**: Internal Audit
- **Position**: Senior Auditor
- **Employee ID**: KIG002

### 3. Auditee SM (Senior Management)
- **Username**: `auditee_sm`
- **Email**: `auditee.sm@kig.co.id`
- **Password**: `password`
- **Role**: Auditee SM
- **Department**: Finance
- **Position**: Senior Manager
- **Employee ID**: KIG003

### 4. Auditee EM (Executive Management)
- **Username**: `auditee_em`
- **Email**: `auditee.em@kig.co.id`
- **Password**: `password`
- **Role**: Auditee EM
- **Department**: Operations
- **Position**: Executive Manager
- **Employee ID**: KIG004

### 5. Pimpinan
- **Username**: `pimpinan`
- **Email**: `pimpinan@kig.co.id`
- **Password**: `password`
- **Role**: Pimpinan
- **Department**: Management
- **Position**: Direktur
- **Employee ID**: KIG005

## Cara Login

Anda dapat login menggunakan:
1. **Username** (contoh: `admin`)
2. **Email** (contoh: `admin@kig.co.id`)

Kedua metode login akan berfungsi dengan baik.

## Struktur Role

### Tabel Roles
| ID | Name | Display Name | Description |
|----|------|--------------|-------------|
| 1 | admin | Administrator | Akses penuh ke seluruh sistem |
| 2 | auditor | Auditor | Dapat membuat dan mengelola audit |
| 3 | auditee_sm | Auditee SM | Auditee Senior Management |
| 4 | auditee_em | Auditee EM | Auditee Executive Management |
| 5 | pimpinan | Pimpinan | Pimpinan perusahaan |

### Relasi Database
- Tabel `users` memiliki foreign key `role_id` yang merujuk ke tabel `roles`
- Relasi: `users.role_id` → `roles.id`
- Constraint: `onDelete('restrict')` - role tidak bisa dihapus jika masih ada user yang menggunakannya

## Fitur Keamanan

- Rate limiting: Maksimal 5 percobaan login dalam periode tertentu
- Session management dengan database
- Password hashing menggunakan bcrypt
- Remember me functionality
- Last login tracking

## Catatan Penting

⚠️ **PENTING**: Segera ubah password default setelah login pertama kali untuk keamanan sistem!

## Role & Permission

- **Administrator**: Akses penuh ke seluruh sistem
- **Auditor**: Dapat membuat dan mengelola audit
- **Auditee SM**: Auditee level Senior Management
- **Auditee EM**: Auditee level Executive Management
- **Pimpinan**: Akses untuk pimpinan perusahaan
