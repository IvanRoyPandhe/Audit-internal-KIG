# Setup Docker Database untuk Sistem Audit PT KIG

## Layanan yang Tersedia

Docker Compose ini menyediakan:
- **MySQL 8.0** - Database server di port 3306
- **phpMyAdmin** - Web interface untuk manage database di port 8080

## Cara Menjalankan

### 1. Start Docker Container

```bash
docker-compose up -d
```

Perintah ini akan:
- Download image MySQL dan phpMyAdmin (pertama kali)
- Membuat container dan menjalankannya di background
- Membuat database `audit_kig` secara otomatis
- Membuat volume untuk persistent data

### 2. Cek Status Container

```bash
docker-compose ps
```

Pastikan status kedua container adalah "Up" dan healthy.

### 3. Setup Laravel Environment

Copy file environment:
```bash
cp .env.example .env
```

File `.env` sudah dikonfigurasi dengan kredensial:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=audit_kig
DB_USERNAME=root
DB_PASSWORD=root
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Jalankan Migration & Seeder

```bash
php artisan migrate:fresh --seed
```

Ini akan membuat:
- Semua tabel database
- 5 user default (admin, auditor, auditee_sm, auditee_em, pimpinan)
- 5 role default

### 6. Install Dependencies & Build Assets

```bash
composer install
npm install
npm run build
```

### 7. Jalankan Laravel Server

```bash
php artisan serve
```

Aplikasi akan berjalan di: `http://localhost:8000`

## Akses Database

### Via phpMyAdmin
- URL: `http://localhost:8080`
- Server: `mysql`
- Username: `root`
- Password: `root`

### Via MySQL Client
```bash
mysql -h 127.0.0.1 -P 3306 -u root -proot audit_kig
```

### Via Laravel Tinker
```bash
php artisan tinker
```

## Kredensial Database

### Root User
- Username: `root`
- Password: `root`
- Database: `audit_kig`

### Application User (Optional)
- Username: `audit_user`
- Password: `audit_password`
- Database: `audit_kig`

## Perintah Docker Compose

### Start containers
```bash
docker-compose up -d
```

### Stop containers
```bash
docker-compose stop
```

### Stop dan hapus containers
```bash
docker-compose down
```

### Stop dan hapus containers + volumes (HATI-HATI: Data akan hilang!)
```bash
docker-compose down -v
```

### Lihat logs
```bash
docker-compose logs -f mysql
```

### Restart containers
```bash
docker-compose restart
```

## Troubleshooting

### Port 3306 sudah digunakan
Jika port 3306 sudah digunakan oleh MySQL lokal, ubah di `docker-compose.yml`:
```yaml
ports:
  - "3307:3306"  # Ubah port host menjadi 3307
```

Lalu update `.env`:
```
DB_PORT=3307
```

### Container tidak bisa start
```bash
# Cek logs untuk error
docker-compose logs mysql

# Restart container
docker-compose restart mysql
```

### Reset database
```bash
# Stop dan hapus volume
docker-compose down -v

# Start ulang
docker-compose up -d

# Jalankan migration lagi
php artisan migrate:fresh --seed
```

### Koneksi ditolak
Tunggu beberapa detik setelah `docker-compose up` karena MySQL butuh waktu untuk initialize. Cek health status:
```bash
docker-compose ps
```

## Data Persistence

Data MySQL disimpan di Docker volume `mysql_data`. Data akan tetap ada meskipun container di-restart atau di-stop. Data hanya hilang jika Anda jalankan `docker-compose down -v`.

## Network

Semua service terhubung via network `audit_network`. Ini memungkinkan container saling berkomunikasi menggunakan nama service sebagai hostname.

## Health Check

MySQL container memiliki health check yang akan memastikan database siap menerima koneksi sebelum status menjadi "healthy".

## Tips

1. **Backup Database**
   ```bash
   docker exec audit_kig_mysql mysqldump -u root -proot audit_kig > backup.sql
   ```

2. **Restore Database**
   ```bash
   docker exec -i audit_kig_mysql mysql -u root -proot audit_kig < backup.sql
   ```

3. **Akses MySQL Shell**
   ```bash
   docker exec -it audit_kig_mysql mysql -u root -proot audit_kig
   ```

4. **Monitor Resource Usage**
   ```bash
   docker stats audit_kig_mysql
   ```

## Next Steps

Setelah database berjalan:
1. ✅ Database MySQL siap
2. ✅ Laravel terkoneksi ke database
3. ✅ Migration & seeder berhasil
4. ✅ Login dengan user default
5. 🚀 Mulai development fitur audit

Selamat coding! 🎉
