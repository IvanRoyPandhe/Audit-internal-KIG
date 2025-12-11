# 📋 Cara Penggunaan Fitur Manajemen Pertanyaan Audit

## 🎯 Ringkasan Fitur

Sistem ini memungkinkan Anda untuk:
- ✅ Melihat progress audit secara real-time
- ✅ Mengelola pertanyaan audit (CRUD)
- ✅ Update status pertanyaan (Open → In Progress → Closed)
- ✅ Memberikan komentar dan diskusi di setiap pertanyaan
- ✅ Filter dan search pertanyaan

---

## 📍 Lokasi Fitur

### 1. Halaman Program Audit
**URL**: `/rkia/program`

Di halaman ini Anda akan melihat:
- Card untuk setiap departemen yang memiliki timeline audit
- Klik card untuk masuk ke detail program

### 2. Halaman Detail Program
**URL**: `/audit-programs/{program}`

Di halaman ini Anda akan melihat:
- **Progress Tracking** (bagian atas):
  - Jumlah pertanyaan Open (merah)
  - Jumlah pertanyaan In Progress (kuning)
  - Jumlah pertanyaan Closed (hijau)
  - Persentase completion
  - Progress bar visual

- **Filter & Search**:
  - Dropdown filter status
  - Search box untuk cari pertanyaan

- **List Pertanyaan**:
  - Setiap pertanyaan ditampilkan dengan detail lengkap
  - Badge status, tipe jawaban, wajib/opsional
  - Button untuk update status, edit, hapus
  - Button "Detail & Komentar" untuk masuk ke halaman diskusi

### 3. Halaman Detail Pertanyaan
**URL**: `/audit-questions/{question}`

Di halaman ini Anda akan melihat:
- Detail lengkap pertanyaan
- Button untuk update status (Open/In Progress/Closed)
- List jawaban dari auditee
- Form untuk menambah komentar
- List komentar yang sudah ada

---

## 🚀 Cara Menggunakan

### A. Menambah Pertanyaan Baru

1. Buka halaman detail program
2. Klik button **"Tambah Pertanyaan Manual"**
3. Isi form:
   - **Pertanyaan** (wajib)
   - **Deskripsi** (opsional)
   - **Tipe Jawaban**: Text / File / Both
   - **Due Date** (opsional)
   - **Dokumen yang Dibutuhkan** (opsional)
   - **Centang** jika pertanyaan wajib dijawab
4. Klik **"Simpan Pertanyaan"**

### B. Update Status Pertanyaan

**Cara 1: Dari List Pertanyaan**
1. Di halaman detail program
2. Cari pertanyaan yang ingin diupdate
3. Klik button **"Update Status"**
4. Pilih status baru: Open / In Progress / Closed

**Cara 2: Dari Detail Pertanyaan**
1. Klik button **"Detail & Komentar"** pada pertanyaan
2. Di bagian "Update Status Pertanyaan"
3. Klik button status yang diinginkan

### C. Memberikan Komentar

1. Buka halaman detail pertanyaan (klik "Detail & Komentar")
2. Scroll ke bagian **"Komentar & Diskusi"**
3. Tulis komentar di text area
4. **Opsional**: Centang "Komentar internal" jika hanya ingin auditor yang bisa lihat
5. Klik **"Kirim Komentar"**

### D. Edit Pertanyaan

1. Di halaman detail program
2. Cari pertanyaan yang ingin diedit
3. Klik icon **pensil** (Edit)
4. Update informasi yang diperlukan
5. Simpan perubahan

### E. Hapus Pertanyaan

1. Di halaman detail program
2. Cari pertanyaan yang ingin dihapus
3. Klik icon **tempat sampah** (Hapus)
4. Konfirmasi penghapusan

**⚠️ Catatan**: Pertanyaan yang sudah dijawab tidak bisa dihapus

### F. Filter & Search

**Filter berdasarkan Status:**
1. Gunakan dropdown "Semua Status" di bagian atas list
2. Pilih: Open / In Progress / Closed
3. List akan otomatis terfilter

**Search Pertanyaan:**
1. Gunakan search box di bagian atas list
2. Ketik keyword yang ingin dicari
3. List akan otomatis terfilter

---

## 📊 Memahami Progress Tracking

### Card Statistik

1. **Open (Merah)**: Pertanyaan yang belum dikerjakan
2. **In Progress (Kuning)**: Pertanyaan yang sedang diproses/revisi
3. **Closed (Hijau)**: Pertanyaan yang sudah selesai
4. **Completion (Biru)**: Persentase pertanyaan yang sudah closed

### Progress Bar
- Menampilkan visual progress keseluruhan
- Warna gradient dari biru ke hijau
- Update otomatis saat status pertanyaan berubah

---

## 🎨 Visual Guide

### Badge Status
- 🔴 **Open**: Background merah, pertanyaan belum dikerjakan
- 🟡 **In Progress**: Background kuning, sedang diproses
- 🟢 **Closed**: Background hijau, sudah selesai

### Badge Tipe Jawaban
- 🔵 **Text**: Jawaban berupa teks
- 🟣 **File**: Jawaban berupa file upload
- 🟣 **Text & File**: Jawaban bisa teks dan file

### Badge Lainnya
- 🟠 **Wajib**: Pertanyaan wajib dijawab
- 🟠 **Internal**: Komentar internal (hanya auditor)

---

## 💡 Tips & Best Practices

### Untuk Auditor:

1. **Gunakan Status dengan Konsisten**
   - Open: Pertanyaan baru atau belum ada progress
   - In Progress: Sudah ada jawaban tapi perlu revisi/klarifikasi
   - Closed: Jawaban sudah lengkap dan diterima

2. **Manfaatkan Komentar**
   - Berikan feedback yang jelas
   - Gunakan komentar internal untuk diskusi tim audit
   - Gunakan komentar public untuk komunikasi dengan auditee

3. **Set Due Date**
   - Tentukan due date untuk pertanyaan penting
   - Monitor pertanyaan yang mendekati deadline

4. **Dokumentasi yang Jelas**
   - Tulis pertanyaan dengan jelas dan spesifik
   - Tambahkan deskripsi jika pertanyaan kompleks
   - Sebutkan dokumen yang dibutuhkan

### Untuk Auditee:

1. **Monitor Status**
   - Fokus pada pertanyaan dengan status Open
   - Perhatikan komentar dari auditor untuk pertanyaan In Progress

2. **Komunikasi Aktif**
   - Jangan ragu bertanya via komentar jika ada yang tidak jelas
   - Informasikan jika ada kendala dalam menjawab

3. **Perhatikan Due Date**
   - Prioritaskan pertanyaan dengan due date terdekat
   - Hubungi auditor jika butuh perpanjangan waktu

---

## 🔧 Troubleshooting

### Tidak bisa hapus pertanyaan?
- Pertanyaan yang sudah dijawab tidak bisa dihapus
- Solusi: Edit pertanyaan atau ubah statusnya

### Tidak bisa hapus komentar?
- Hanya pemilik komentar atau admin yang bisa hapus
- Komentar orang lain tidak bisa dihapus

### Progress tidak update?
- Refresh halaman
- Pastikan status pertanyaan sudah tersimpan

---

## 📞 Butuh Bantuan?

Jika ada pertanyaan atau menemukan bug, hubungi:
- Tim IT Support
- Admin Sistem Audit

---

**Terakhir diupdate**: 9 Desember 2025
