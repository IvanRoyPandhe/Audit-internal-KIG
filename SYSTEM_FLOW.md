# Alur Sistem Audit PT KIG

## Role & Akses

### 1. Admin
- Manajemen departemen
- Manajemen user (semua role)
- Assign user ke departemen
- Set SM (Senior Manager) untuk setiap departemen

### 2. Auditor
- Membuat timeline audit per departemen
- Import timeline via Excel
- Membuat program audit (pertanyaan & data requirement)
- Import program audit via Excel
- Review jawaban auditee
- Memberikan feedback & komentar
- Mengubah status pertanyaan (Open → In Progress → Closed)
- Generate laporan audit

### 3. Auditee
**SM (Senior Manager/Pimpinan Departemen):**
- Menerima notifikasi email saat departemen dapat jadwal audit
- Menjawab pertanyaan audit
- Upload dokumen/data
- Memberikan komentar
- Melihat feedback dari auditor

**Employee:**
- Menjawab pertanyaan audit (bersamaan dengan SM)
- Upload dokumen/data
- Memberikan komentar
- Melihat feedback dari auditor

### 4. Direktur/Pimpinan
- Melihat laporan audit
- Monitoring progress audit
- Dashboard overview

## Alur Proses Audit

### Phase 1: Setup (Admin)
1. Admin membuat/manage departemen
2. Admin membuat/manage user
3. Admin assign user ke departemen
4. Admin set SM untuk setiap departemen

### Phase 2: Timeline (Auditor)
1. Auditor masuk ke menu RKIA → Timeline
2. Auditor input timeline audit per departemen:
   - Departemen
   - Tanggal mulai
   - Tanggal selesai
   - Status aktif/tidak aktif (tidak semua departemen diaudit setiap tahun)
3. **Alternatif:** Import timeline via Excel
   - Download template Excel
   - Template berisi list departemen dari database
   - Isi tanggal start, end, dan status aktif
   - Import ke sistem
4. Departemen dengan status aktif otomatis muncul di Program

### Phase 3: Program Audit (Auditor)
1. Auditor masuk ke menu RKIA → Program
2. Auditor pilih departemen yang akan diaudit
3. Auditor input pertanyaan & data requirement:
   - Input manual: tambah pertanyaan satu per satu
   - Import Excel: upload file dengan template pertanyaan
4. Setiap pertanyaan memiliki:
   - Nomor urut
   - Pertanyaan/requirement
   - Tipe data yang dibutuhkan
   - Status: Open (default)

### Phase 4: Notifikasi (Sistem)
1. Sistem mengirim email ke SM departemen yang mendapat jadwal audit
2. Email berisi:
   - Informasi jadwal audit
   - Link ke sistem
   - Deadline pengumpulan

### Phase 5: Pengerjaan Audit (Auditee)
1. SM dan Employee login ke sistem
2. Melihat daftar pertanyaan audit
3. Menjawab pertanyaan:
   - Input jawaban/penjelasan
   - Upload dokumen/data pendukung
   - Submit jawaban
4. Status pertanyaan berubah menjadi "In Progress"
5. Auditee bisa memberikan komentar di setiap pertanyaan

### Phase 6: Review (Auditor)
1. Auditor review jawaban & dokumen dari auditee
2. Auditor memberikan feedback/komentar
3. Auditor mengubah status:
   - **In Progress**: Data sedang direview/perlu revisi
   - **Closed**: Data sudah sesuai dan diterima
4. Jika perlu revisi:
   - Auditor beri komentar revisi
   - Auditee revisi jawaban
   - Proses review ulang

### Phase 7: Laporan (Auditor)
1. Auditor generate laporan audit
2. Laporan menampilkan:
   - Summary audit
   - Status setiap pertanyaan
   - Temuan (pertanyaan dengan status Open)
   - Dokumen pendukung
   - Timeline komentar & feedback
3. Laporan bisa di-export (PDF/Excel)

## Status Pertanyaan

### Open (Merah)
- Pertanyaan belum dijawab
- Atau pertanyaan belum selesai sampai deadline
- **Menjadi temuan di laporan akhir**

### In Progress (Kuning)
- Auditee sudah submit jawaban
- Auditor sedang review
- Atau data perlu revisi

### Closed (Hijau)
- Pertanyaan sudah dijawab dengan lengkap
- Data sudah direview dan diterima auditor
- Tidak ada revisi lagi

## Fitur Komentar

Setiap pertanyaan memiliki thread komentar:
- Auditee bisa komen (tanya/klarifikasi)
- Auditor bisa komen (feedback/revisi)
- Timestamp setiap komentar
- Notifikasi saat ada komentar baru

## Database Entities

1. **Departments** - Data departemen
2. **Users** - Data user dengan role
3. **Audit_Timelines** - Jadwal audit per departemen per tahun
4. **Audit_Programs** - Program audit per departemen
5. **Audit_Questions** - Pertanyaan audit per program
6. **Audit_Answers** - Jawaban dari auditee
7. **Audit_Documents** - Dokumen upload
8. **Audit_Comments** - Komentar & feedback
9. **Audit_Reports** - Laporan audit final

## Notifikasi Email

1. **Saat timeline dibuat**: Email ke SM departemen
2. **Saat mendekati deadline**: Reminder email
3. **Saat ada komentar baru**: Email notifikasi
4. **Saat audit selesai**: Email laporan final
