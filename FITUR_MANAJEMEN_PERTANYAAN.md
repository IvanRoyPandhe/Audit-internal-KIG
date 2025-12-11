# Fitur Manajemen Pertanyaan Audit

## Overview
Sistem lengkap untuk mengelola pertanyaan audit dengan tracking progress, status management, dan sistem komentar.

## Fitur Utama

### 1. Progress Tracking di Halaman Program
- **Lokasi**: `/audit-programs/{program}` (program-show.blade.php)
- **Fitur**:
  - Card statistik: Open, In Progress, Closed, Completion %
  - Progress bar visual
  - Real-time update berdasarkan status pertanyaan

### 2. List Pertanyaan dengan Detail Lengkap
- **Lokasi**: Halaman detail program
- **Fitur**:
  - Tampilan pertanyaan dengan badge status (Open/In Progress/Closed)
  - Badge tipe jawaban (Text/File/Both)
  - Badge wajib/opsional
  - Informasi dokumen yang dibutuhkan
  - Due date
  - Filter berdasarkan status
  - Search pertanyaan

### 3. CRUD Pertanyaan
- **Tambah Pertanyaan Manual**: Modal form dengan field lengkap
- **Edit Pertanyaan**: Update pertanyaan yang sudah ada
- **Hapus Pertanyaan**: Dengan validasi (tidak bisa hapus jika sudah dijawab)

### 4. Update Status Pertanyaan
- **3 Status**:
  - **Open**: Belum dijawab/dikerjakan
  - **In Progress**: Sedang diproses/revisi
  - **Closed**: Sudah selesai
- **Cara Update**: 
  - Dropdown di list pertanyaan
  - Button di halaman detail pertanyaan
- **Auto Update Counter**: Program counter otomatis update saat status berubah

### 5. Halaman Detail Pertanyaan
- **Lokasi**: `/audit-questions/{question}`
- **Fitur**:
  - Detail lengkap pertanyaan
  - Update status dengan button visual
  - List jawaban dari auditee
  - Sistem komentar dan diskusi

### 6. Sistem Komentar
- **Fitur**:
  - Tambah komentar di setiap pertanyaan
  - Komentar internal (hanya auditor yang bisa lihat)
  - Komentar public (semua bisa lihat)
  - Hapus komentar (owner atau admin)
  - Timestamp dan user info

## Routes

```php
// Pertanyaan
GET     /audit-questions/{question}                    - Detail pertanyaan
POST    /audit-programs/{program}/questions            - Tambah pertanyaan
PUT     /audit-questions/{question}                    - Update pertanyaan
DELETE  /audit-questions/{question}                    - Hapus pertanyaan
PATCH   /audit-questions/{question}/status             - Update status

// Komentar
POST    /audit-questions/{question}/comments           - Tambah komentar
DELETE  /question-comments/{comment}                   - Hapus komentar
```

## Database Schema

### audit_questions
- id
- audit_program_id (FK)
- order_number
- question (text)
- description (text, nullable)
- answer_type (enum: text, file, both)
- is_required (boolean)
- required_documents (string, nullable)
- status (enum: open, in_progress, closed)
- assigned_to (FK users, nullable)
- due_date (date, nullable)
- timestamps
- soft_deletes

### question_comments
- id
- audit_question_id (FK)
- user_id (FK)
- comment (text)
- is_internal (boolean)
- timestamps
- soft_deletes

## Workflow

### Untuk Auditor:
1. Buka halaman Program (`/rkia/program`)
2. Klik card departemen untuk masuk ke detail program
3. Lihat progress tracking di bagian atas
4. Tambah pertanyaan manual atau import Excel
5. Kelola pertanyaan: edit, hapus, update status
6. Klik "Detail & Komentar" untuk diskusi
7. Berikan komentar dan update status sesuai progress

### Untuk Auditee:
1. Lihat list pertanyaan yang harus dijawab
2. Jawab pertanyaan (fitur ini akan dibuat selanjutnya)
3. Upload dokumen jika diperlukan
4. Lihat komentar dari auditor
5. Balas komentar jika ada pertanyaan

## Fitur Tambahan

### Filter & Search
- Filter berdasarkan status (Open/In Progress/Closed)
- Search pertanyaan berdasarkan keyword
- Real-time filtering tanpa reload

### Visual Indicators
- Color-coded status badges
- Progress bar dengan gradient
- Icon untuk setiap tipe data
- Hover effects untuk interaktivitas

### Validasi
- Tidak bisa hapus pertanyaan yang sudah dijawab
- Required fields validation
- Permission check untuk hapus komentar

## Next Steps (Belum Diimplementasi)

1. **Import Excel Pertanyaan**: Upload bulk pertanyaan dari Excel
2. **Export Excel**: Download template dan data pertanyaan
3. **Auditee Answer Form**: Form untuk auditee menjawab pertanyaan
4. **File Upload**: Upload dokumen pendukung
5. **Notification**: Notifikasi saat ada komentar baru atau status berubah
6. **History Log**: Track perubahan status dan edit
7. **Assign to User**: Assign pertanyaan ke user tertentu
8. **Reminder**: Email reminder untuk pertanyaan yang mendekati due date

## File yang Dibuat/Dimodifikasi

### Controllers
- `app/Http/Controllers/AuditQuestionController.php` (NEW)

### Models
- `app/Models/AuditQuestion.php` (UPDATED)
- `app/Models/QuestionComment.php` (NEW)

### Views
- `resources/views/rkia/program-show.blade.php` (UPDATED)
- `resources/views/audit-questions/show.blade.php` (NEW)

### Migrations
- `database/migrations/2025_12_09_141848_create_question_comments_table.php` (NEW)

### Routes
- `routes/web.php` (UPDATED)

## Testing

Untuk testing fitur ini:

1. Buat program audit
2. Tambah beberapa pertanyaan
3. Update status pertanyaan
4. Cek apakah counter di progress tracking update
5. Tambah komentar
6. Test filter dan search
7. Test edit dan hapus pertanyaan
