# 🗄️ Struktur Database - Sistem Audit Internal

## 📊 Entity Relationship Diagram (Simplified)

```
departments
    ↓ (1:N)
audit_timelines
    ↓ (1:N)
audit_programs
    ↓ (1:N)
audit_questions
    ↓ (1:N)
    ├── audit_answers
    │       ↓ (1:N)
    │   audit_documents
    └── question_comments
```

---

## 📋 Tabel dan Relasi

### 1. departments
**Deskripsi**: Master data departemen

**Kolom**:
- `id`: Primary key
- `code`: Kode departemen (unique)
- `name`: Nama departemen
- `description`: Deskripsi
- `senior_manager_id`: FK ke users (Senior Manager)
- `is_active`: Status aktif

**Relasi**:
- `hasMany` → audit_timelines
- `hasMany` → users (department members)
- `belongsTo` → users (senior manager)

---

### 2. audit_timelines
**Deskripsi**: Jadwal audit untuk setiap departemen per tahun

**Kolom**:
- `id`: Primary key
- `department_id`: FK ke departments
- `audit_year`: Tahun audit
- `start_date`: Tanggal mulai
- `end_date`: Tanggal selesai
- `status`: enum(draft, active, completed)
- `notes`: Catatan

**Relasi**:
- `belongsTo` → departments
- `hasMany` → audit_programs

**Index**:
- `department_id`
- `audit_year`
- `status`

---

### 3. audit_programs
**Deskripsi**: Program audit untuk setiap timeline

**Kolom**:
- `id`: Primary key
- `audit_timeline_id`: FK ke audit_timelines
- `program_code`: Kode program (unique)
- `program_name`: Nama program
- `description`: Deskripsi
- `status`: enum(draft, active, completed)
- `created_by`: FK ke users (auditor)
- `start_date`: Tanggal mulai
- `end_date`: Tanggal selesai
- `total_questions`: Total pertanyaan
- `answered_questions`: Pertanyaan terjawab
- `closed_questions`: Pertanyaan closed

**Relasi**:
- `belongsTo` → audit_timelines
- `belongsTo` → users (creator)
- `hasMany` → audit_questions

**Index**:
- `audit_timeline_id`
- `status`

**Soft Deletes**: Ya

---

### 4. audit_questions ⭐ (NEW)
**Deskripsi**: Pertanyaan audit dalam sebuah program

**Kolom**:
- `id`: Primary key
- `audit_program_id`: FK ke audit_programs
- `order_number`: Nomor urut pertanyaan
- `question`: Pertanyaan (text)
- `description`: Penjelasan tambahan (text, nullable)
- `answer_type`: enum(text, file, both)
- `is_required`: boolean (wajib dijawab)
- `required_documents`: Dokumen yang dibutuhkan (string, nullable)
- `status`: enum(open, in_progress, closed)
- `assigned_to`: FK ke users (nullable)
- `due_date`: Tanggal deadline (date, nullable)

**Relasi**:
- `belongsTo` → audit_programs
- `belongsTo` → users (assigned to)
- `hasMany` → audit_answers
- `hasMany` → question_comments
- `hasOne` → audit_answers (latest)

**Index**:
- `audit_program_id`
- `status`
- `assigned_to`

**Soft Deletes**: Ya

---

### 5. audit_answers
**Deskripsi**: Jawaban dari auditee untuk setiap pertanyaan

**Kolom**:
- `id`: Primary key
- `audit_question_id`: FK ke audit_questions
- `user_id`: FK ke users (auditee)
- `answer_text`: Jawaban teks (text, nullable)
- `status`: enum(draft, submitted, approved, rejected)
- `submitted_at`: Waktu submit
- `reviewed_by`: FK ke users (auditor)
- `reviewed_at`: Waktu review
- `review_notes`: Catatan review

**Relasi**:
- `belongsTo` → audit_questions
- `belongsTo` → users (answerer)
- `belongsTo` → users (reviewer)
- `hasMany` → audit_documents

**Index**:
- `audit_question_id`
- `user_id`
- `status`

**Soft Deletes**: Ya

---

### 6. audit_documents
**Deskripsi**: Dokumen pendukung untuk jawaban

**Kolom**:
- `id`: Primary key
- `audit_answer_id`: FK ke audit_answers
- `file_name`: Nama file
- `file_path`: Path file di storage
- `file_size`: Ukuran file (bytes)
- `file_type`: Tipe file (mime type)
- `uploaded_by`: FK ke users

**Relasi**:
- `belongsTo` → audit_answers
- `belongsTo` → users (uploader)

**Index**:
- `audit_answer_id`

**Soft Deletes**: Ya

---

### 7. question_comments ⭐ (NEW)
**Deskripsi**: Komentar dan diskusi untuk setiap pertanyaan

**Kolom**:
- `id`: Primary key
- `audit_question_id`: FK ke audit_questions
- `user_id`: FK ke users (commenter)
- `comment`: Isi komentar (text)
- `is_internal`: boolean (komentar internal/public)

**Relasi**:
- `belongsTo` → audit_questions
- `belongsTo` → users (commenter)

**Index**:
- `audit_question_id`
- `user_id`

**Soft Deletes**: Ya

---

### 8. users
**Deskripsi**: Master data user

**Kolom**:
- `id`: Primary key
- `name`: Nama lengkap
- `username`: Username (unique)
- `email`: Email (unique)
- `employee_id`: NIP/ID karyawan
- `department_id`: FK ke departments
- `position`: Jabatan
- `role_id`: FK ke roles
- `is_department_head`: boolean
- `is_active`: boolean
- `password`: Password (hashed)
- `last_login_at`: Waktu login terakhir

**Relasi**:
- `belongsTo` → roles
- `belongsTo` → departments
- `hasMany` → audit_programs (as creator)
- `hasMany` → audit_questions (as assigned)
- `hasMany` → audit_answers
- `hasMany` → question_comments

---

### 9. roles
**Deskripsi**: Master data role/peran user

**Kolom**:
- `id`: Primary key
- `name`: Nama role (Admin, Auditor, Auditee, Pimpinan)
- `description`: Deskripsi role
- `permissions`: JSON permissions

**Relasi**:
- `hasMany` → users

---

## 🔄 Workflow Data Flow

### 1. Membuat Program Audit
```
Timeline (Active) 
    → Create Program 
    → Add Questions 
    → Activate Program
```

### 2. Proses Audit
```
Question (Open)
    → Auditee Submit Answer
    → Question (In Progress)
    → Auditor Review
    → Add Comments
    → Question (Closed)
```

### 3. Progress Tracking
```
audit_programs.total_questions = COUNT(audit_questions)
audit_programs.answered_questions = COUNT(audit_answers WHERE submitted)
audit_programs.closed_questions = COUNT(audit_questions WHERE status = closed)
```

---

## 📈 Counter & Aggregation

### Program Level
- `total_questions`: Auto increment saat tambah pertanyaan
- `answered_questions`: Update saat auditee submit jawaban
- `closed_questions`: Update saat status pertanyaan = closed

### Question Level
- `status`: Manual update oleh auditor
- `order_number`: Auto increment per program

---

## 🔐 Soft Deletes

Tabel dengan soft deletes:
- ✅ audit_programs
- ✅ audit_questions
- ✅ audit_answers
- ✅ audit_documents
- ✅ question_comments
- ✅ departments
- ✅ audit_timelines

**Keuntungan**:
- Data tidak benar-benar terhapus
- Bisa di-restore jika diperlukan
- Audit trail tetap terjaga

---

## 🎯 Index Strategy

### Primary Indexes
- Foreign keys (untuk JOIN performance)
- Status fields (untuk filtering)
- Date fields (untuk sorting)

### Composite Indexes (Future)
- `(audit_program_id, status)` di audit_questions
- `(audit_question_id, user_id)` di audit_answers
- `(department_id, audit_year)` di audit_timelines

---

## 📊 Query Examples

### Get Program with Progress
```php
$program = AuditProgram::with([
    'auditQuestions' => function($q) {
        $q->selectRaw('audit_program_id, status, COUNT(*) as count')
          ->groupBy('audit_program_id', 'status');
    }
])->find($id);
```

### Get Questions with Comments Count
```php
$questions = AuditQuestion::withCount('comments')
    ->where('audit_program_id', $programId)
    ->orderBy('order_number')
    ->get();
```

### Get Unanswered Questions
```php
$questions = AuditQuestion::whereDoesntHave('auditAnswers')
    ->where('status', 'open')
    ->get();
```

---

## 🔄 Migration Order

1. ✅ roles
2. ✅ users
3. ✅ departments
4. ✅ audit_timelines
5. ✅ audit_programs
6. ✅ audit_questions
7. ✅ audit_answers
8. ✅ audit_documents
9. ✅ question_comments ⭐ (NEW)

---

**Terakhir diupdate**: 9 Desember 2025
