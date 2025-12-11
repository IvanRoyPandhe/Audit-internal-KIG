# Cara Import Timeline Audit dari Excel

## Langkah-langkah:

### 1. Download Template Excel
- Login sebagai Auditor
- Masuk ke menu **RKIA → Timeline**
- Klik tombol **"Download Template Excel"**
- File `template-timeline-audit.xlsx` akan terdownload

### 2. Isi Template Excel

Template akan berisi kolom-kolom berikut:

| Kode Departemen | Nama Departemen | Tanggal Mulai YYYY-MM-DD | Tanggal Selesai YYYY-MM-DD | Aktif YaTidak | Catatan |
|-----------------|-----------------|--------------------------|----------------------------|---------------|---------|
| FIN | Finance | 2025-01-15 | 2025-02-28 | Ya | Audit keuangan Q1 |
| IT | Information Technology | 2025-03-01 | 2025-04-15 | Ya | Audit IT security |
| HR | Human Resources | | | Tidak | Tidak diaudit tahun ini |

**Penjelasan Kolom:**

1. **Kode Departemen** (Otomatis terisi)
   - Kode departemen dari database
   - JANGAN DIUBAH!

2. **Nama Departemen** (Otomatis terisi)
   - Nama departemen dari database
   - Hanya untuk referensi

3. **Tanggal Mulai YYYY-MM-DD** (Wajib diisi jika Aktif = Ya)
   - Format: YYYY-MM-DD
   - Contoh: 2025-01-15
   - Tanggal mulai audit

4. **Tanggal Selesai YYYY-MM-DD** (Wajib diisi jika Aktif = Ya)
   - Format: YYYY-MM-DD
   - Contoh: 2025-02-28
   - Tanggal selesai audit
   - Harus lebih besar dari tanggal mulai

5. **Aktif YaTidak** (Wajib diisi)
   - Isi dengan: **Ya** atau **Tidak**
   - **Ya** = Departemen mendapat jadwal audit tahun ini
   - **Tidak** = Departemen tidak diaudit tahun ini
   - Hanya departemen dengan status "Ya" yang akan diimport

6. **Catatan** (Opsional)
   - Catatan tambahan untuk timeline
   - Boleh dikosongkan

### 3. Contoh Pengisian

**Departemen yang DIAUDIT:**
```
FIN | Finance | 2025-01-15 | 2025-02-28 | Ya | Audit keuangan Q1 2025
IT  | Information Technology | 2025-03-01 | 2025-04-15 | Ya | Audit IT security
OPS | Operations | 2025-05-01 | 2025-06-30 | Ya | Audit operasional
```

**Departemen yang TIDAK DIAUDIT:**
```
HR  | Human Resources | | | Tidak | Tidak ada jadwal audit
MKT | Marketing | | | Tidak | 
LOG | Logistics | | | Tidak | Departemen tidak aktif
```

### 4. Import ke Sistem

- Kembali ke menu **RKIA → Timeline**
- Klik tombol **"Import dari Excel"**
- Modal akan muncul
- Pilih **Tahun Audit** (contoh: 2025)
- Klik **"Choose File"** dan pilih file Excel yang sudah diisi
- Klik **"Import Timeline"**

### 5. Hasil Import

Sistem akan:
- ✅ Membaca file Excel
- ✅ Validasi data (format tanggal, kode departemen, dll)
- ✅ Hanya import departemen dengan status "Ya"
- ✅ Skip departemen yang sudah ada timeline di tahun yang sama
- ✅ Menampilkan jumlah timeline yang berhasil diimport

## ⚠️ Catatan Penting:

1. **Format Tanggal Harus Benar**
   - Gunakan format: YYYY-MM-DD
   - Contoh BENAR: 2025-01-15
   - Contoh SALAH: 15/01/2025, 15-01-2025, 2025/01/15

2. **Kode Departemen Jangan Diubah**
   - Kode departemen harus sesuai dengan database
   - Jika diubah, sistem tidak akan menemukan departemen

3. **Status Aktif Harus "Ya" atau "Tidak"**
   - Huruf besar/kecil tidak masalah (ya, Ya, YA semua valid)
   - Jangan gunakan nilai lain (1, 0, true, false, dll)

4. **Departemen dengan Status "Tidak" Akan Diskip**
   - Tidak akan diimport ke sistem
   - Tidak akan muncul di Program Audit

5. **Duplikasi Akan Diskip**
   - Jika departemen sudah punya timeline di tahun yang sama
   - Sistem akan skip dan lanjut ke baris berikutnya

## 🐛 Troubleshooting

### Error: "Tanggal mulai harus berformat YYYY-MM-DD"
**Solusi:** 
- Pastikan format tanggal benar: 2025-01-15
- Jangan gunakan format lain seperti 15/01/2025
- Di Excel, format cell sebagai "Text" atau "Date" dengan format custom "yyyy-mm-dd"

### Error: "Departemen dengan kode 'XXX' tidak ditemukan"
**Solusi:**
- Jangan ubah kode departemen di template
- Download template baru jika ada perubahan departemen

### Error: "Tidak ada timeline yang diimport"
**Solusi:**
- Pastikan ada minimal 1 departemen dengan status "Ya"
- Cek apakah tanggal sudah diisi untuk departemen yang aktif

### Import Berhasil Tapi Jumlahnya Sedikit
**Kemungkinan:**
- Beberapa departemen sudah punya timeline di tahun yang sama (diskip)
- Beberapa departemen status "Tidak" (diskip)
- Beberapa baris ada error validasi (diskip)

## 📧 Email Notifikasi

Setelah timeline diimport:
- Senior Manager (SM) dari setiap departemen akan menerima email notifikasi
- Email berisi informasi jadwal audit
- SM dapat langsung akses sistem untuk melihat detail

## 🔄 Update Timeline

Jika perlu update timeline yang sudah diimport:
- Gunakan tombol **Edit** di halaman Timeline
- Atau hapus timeline lama dan import ulang

---

**Tips:** Simpan file Excel sebagai backup untuk tahun-tahun berikutnya!
