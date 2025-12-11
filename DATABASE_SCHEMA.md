# Database Schema - Sistem Audit PT KIG

## Entity Relationship Diagram (ERD)

```
┌─────────────────┐
│   departments   │
├─────────────────┤
│ id              │◄──┐
│ code            │   │
│ name            │   │
│ description     │   │
│ sm_user_id      │   │
│ is_active       │   │
└─────────────────┘   │
         │            │
         │            │
         ▼            │
┌─────────────────┐   │
│ audit_timelines │   │
├─────────────────┤   │
│ id              │◄──┼──┐
│ audit_year      │   │  │
│ department_id   │───┘  │
│ start_date      │      │
│ end_date        │      │
│ is_active       │      │
│ status          │      │
│ created_by      │      │
│ email_sent      │      │
└─────────────────┘      │
         │               │
         │               │
         ▼               │
┌─────────────────┐      │
│ audit_programs  │      │
├─────────────────┤      │
│ id              │◄─────┼──┐
│ audit_timeline_id│─────┘  │
│ program_code    │         │
│ program_name    │         │
│ status          │         │
│ created_by      │         │
│ start_date      │         │
│ end_date        │         │
└─────────────────┘         │
         │                  │
         │                  │
         ▼                  │
┌─────────────────┐         │
│ audit_questions │         │
├─────────────────┤         │
│ id              │◄────────┼──┐
│ audit_program_id│─────────┘  │
│ order_number    │            │
│ question        │            │
│ question_type   │            │
│ status          │            │
│ assigned_to     │            │
│ closed_by       │            │
└─────────────────┘            │
         │                     │
         ├─────────────────────┼──┐
         │                     │  │
         ▼                     │  │
┌─────────────────┐            │  │
│ audit_answers   │            │  │
├─────────────────┤            │  │
│ id              │            │  │
│ audit_question_id│───────────┘  │
│ answer          │               │
│ answered_by     │               │
│ answer_status   │               │
│ reviewed_by     │               │
└─────────────────┘               │
                                  │
         ┌────────────────────────┤
         │                        │
         ▼                        │
┌─────────────────┐               │
│ audit_documents │               │
├─────────────────┤               │
│ id              │               │
│ audit_question_id│──────────────┘
│ audit_answer_id │
│ document_name   │
│ document_path   │
│ uploaded_by     │
│ status          │
│ reviewed_by     │
└─────────────────┘

         ┌────────────────────────┐
         │                        │
         ▼                        │
┌─────────────────┐               │
│ audit_comments  │               │
├─────────────────┤               │
│ id              │               │
│ audit_question_id│──────────────┘
│ user_id         │
│ parent_id       │
│ comment         │
│ comment_type    │
│ is_internal     │
└─────────────────┘

┌─────────────────┐
│ audit_reports   │
├─────────────────┤
│ id              │
│ audit_program_id│
│ report_number   │
│ report_title    │
│ findings        │
│ status          │
│ prepared_by     │
│ approved_by     │
└─────────────────┘

┌─────────────────┐
│     users       │
├─────────────────┤
│ id              │
│ name            │
│ username        │
│ email           │
│ role_id         │
│ department_id   │
│ is_department_head│
│ employee_id     │
│ position        │
└─────────────────┘

┌─────────────────┐
│     roles       │
├─────────────────┤
│ id              │
│ name            │
│ display_name    │
│ description     │
└─────────────────┘
```

## Tabel Details

### 1. departments
Menyimpan data departemen di perusahaan.

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| code | varchar(20) | Kode departemen (unique) |
| name | varchar | Nama departemen |
| description | text | Deskripsi departemen |
| sm_user_id | bigint | FK ke users (Senior Manager) |
| is_active | boolean | Status aktif departemen |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |
| deleted_at | timestamp | Soft delete |

**Relationships:**
- `belongsTo` User (sm_user_id)
- `hasMany` AuditTimeline
- `hasMany` User (department_id)

---

### 2. audit_timelines
Menyimpan jadwal audit per departemen per tahun.

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| audit_year | year | Tahun audit |
| department_id | bigint | FK ke departments |
| start_date | date | Tanggal mulai audit |
| end_date | date | Tanggal selesai audit |
| is_active | boolean | Departemen dapat jadwal audit atau tidak |
| status | enum | scheduled, ongoing, completed, cancelled |
| created_by | bigint | FK ke users (auditor) |
| notes | text | Catatan tambahan |
| email_sent | boolean | Status email notifikasi |
| email_sent_at | timestamp | Waktu email dikirim |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |
| deleted_at | timestamp | Soft delete |

**Indexes:**
- `(audit_year, department_id)`
- `status`

**Relationships:**
- `belongsTo` Department
- `belongsTo` User (created_by)
- `hasMany` AuditProgram

---

### 3. audit_programs
Menyimpan program audit untuk setiap timeline.

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| audit_timeline_id | bigint | FK ke audit_timelines |
| program_code | varchar(50) | Kode program (unique) |
| program_name | varchar | Nama program audit |
| description | text | Deskripsi program |
| status | enum | draft, active, completed |
| created_by | bigint | FK ke users (auditor) |
| start_date | date | Tanggal mulai program |
| end_date | date | Tanggal selesai program |
| total_questions | int | Total pertanyaan |
| answered_questions | int | Pertanyaan terjawab |
| closed_questions | int | Pertanyaan closed |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |
| deleted_at | timestamp | Soft delete |

**Indexes:**
- `status`

**Relationships:**
- `belongsTo` AuditTimeline
- `belongsTo` User (created_by)
- `hasMany` AuditQuestion
- `hasOne` AuditReport

---

### 4. audit_questions
Menyimpan pertanyaan audit dalam program.

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| audit_program_id | bigint | FK ke audit_programs |
| order_number | int | Nomor urut pertanyaan |
| question_code | varchar(50) | Kode pertanyaan |
| question | text | Pertanyaan audit |
| description | text | Deskripsi/penjelasan |
| question_type | enum | text, file, both |
| status | enum | open, in_progress, closed |
| is_required | boolean | Wajib dijawab |
| requires_document | boolean | Memerlukan dokumen |
| document_type | varchar | Tipe dokumen yang dibutuhkan |
| assigned_to | bigint | FK ke users (auditee) |
| answered_at | timestamp | Waktu dijawab |
| closed_at | timestamp | Waktu closed |
| closed_by | bigint | FK ke users (auditor) |
| closure_notes | text | Catatan penutupan |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |
| deleted_at | timestamp | Soft delete |

**Indexes:**
- `(audit_program_id, status)`
- `order_number`

**Relationships:**
- `belongsTo` AuditProgram
- `belongsTo` User (assigned_to)
- `belongsTo` User (closed_by)
- `hasMany` AuditAnswer
- `hasMany` AuditDocument
- `hasMany` AuditComment

---

### 5. audit_answers
Menyimpan jawaban dari auditee.

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| audit_question_id | bigint | FK ke audit_questions |
| answer | text | Jawaban dari auditee |
| answered_by | bigint | FK ke users |
| answer_status | enum | draft, submitted, revision, approved |
| revision_notes | text | Catatan revisi dari auditor |
| reviewed_by | bigint | FK ke users (auditor) |
| submitted_at | timestamp | Waktu submit |
| reviewed_at | timestamp | Waktu review |
| revision_count | int | Jumlah revisi |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |
| deleted_at | timestamp | Soft delete |

**Indexes:**
- `(audit_question_id, answer_status)`

**Relationships:**
- `belongsTo` AuditQuestion
- `belongsTo` User (answered_by)
- `belongsTo` User (reviewed_by)
- `hasMany` AuditDocument

---

### 6. audit_documents
Menyimpan dokumen yang diupload.

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| audit_question_id | bigint | FK ke audit_questions |
| audit_answer_id | bigint | FK ke audit_answers |
| document_name | varchar | Nama dokumen |
| document_path | varchar | Path file |
| document_type | varchar(50) | Tipe file (pdf, xlsx, dll) |
| file_size | int | Ukuran file (bytes) |
| description | text | Deskripsi dokumen |
| uploaded_by | bigint | FK ke users |
| status | enum | pending, approved, rejected |
| reviewed_by | bigint | FK ke users (auditor) |
| review_notes | text | Catatan review |
| reviewed_at | timestamp | Waktu review |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |
| deleted_at | timestamp | Soft delete |

**Indexes:**
- `(audit_question_id, status)`

**Relationships:**
- `belongsTo` AuditQuestion
- `belongsTo` AuditAnswer
- `belongsTo` User (uploaded_by)
- `belongsTo` User (reviewed_by)

---

### 7. audit_comments
Menyimpan komentar dan feedback.

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| audit_question_id | bigint | FK ke audit_questions |
| user_id | bigint | FK ke users |
| parent_id | bigint | FK ke audit_comments (reply) |
| comment | text | Isi komentar |
| comment_type | enum | question, feedback, revision, general |
| is_internal | boolean | Komentar internal auditor |
| is_read | boolean | Status sudah dibaca |
| read_at | timestamp | Waktu dibaca |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |
| deleted_at | timestamp | Soft delete |

**Indexes:**
- `(audit_question_id, created_at)`
- `parent_id`

**Relationships:**
- `belongsTo` AuditQuestion
- `belongsTo` User
- `belongsTo` AuditComment (parent)
- `hasMany` AuditComment (replies)

---

### 8. audit_reports
Menyimpan laporan audit final.

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| audit_program_id | bigint | FK ke audit_programs |
| report_number | varchar(50) | Nomor laporan (unique) |
| report_title | varchar | Judul laporan |
| report_date | date | Tanggal laporan |
| executive_summary | text | Ringkasan eksekutif |
| audit_scope | text | Ruang lingkup audit |
| audit_methodology | text | Metodologi audit |
| findings | text | Temuan audit (JSON) |
| recommendations | text | Rekomendasi |
| conclusion | text | Kesimpulan |
| status | enum | draft, review, approved, published |
| prepared_by | bigint | FK ke users (auditor) |
| reviewed_by | bigint | FK ke users |
| approved_by | bigint | FK ke users |
| reviewed_at | timestamp | Waktu review |
| approved_at | timestamp | Waktu approve |
| published_at | timestamp | Waktu publish |
| pdf_path | varchar | Path file PDF |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |
| deleted_at | timestamp | Soft delete |

**Indexes:**
- `status`
- `report_date`

**Relationships:**
- `belongsTo` AuditProgram
- `belongsTo` User (prepared_by)
- `belongsTo` User (reviewed_by)
- `belongsTo` User (approved_by)

---

### 9. users (Updated)
Tambahan field untuk departemen.

| New Field | Type | Description |
|-----------|------|-------------|
| department_id | bigint | FK ke departments |
| is_department_head | boolean | Apakah SM/Kepala Departemen |

**Relationships:**
- `belongsTo` Department
- `belongsTo` Role

---

## Status Flow

### Timeline Status
```
scheduled → ongoing → completed
                   ↘ cancelled
```

### Program Status
```
draft → active → completed
```

### Question Status
```
open → in_progress → closed
```

### Answer Status
```
draft → submitted → revision → approved
              ↑         ↓
              └─────────┘
```

### Document Status
```
pending → approved
       ↘ rejected
```

### Report Status
```
draft → review → approved → published
```

## Import Templates

### Timeline Import (Excel)
| Column | Type | Description |
|--------|------|-------------|
| department_code | string | Kode departemen |
| department_name | string | Nama departemen (readonly) |
| start_date | date | Tanggal mulai (YYYY-MM-DD) |
| end_date | date | Tanggal selesai (YYYY-MM-DD) |
| is_active | boolean | Ya/Tidak |
| notes | text | Catatan |

### Program Import (Excel)
| Column | Type | Description |
|--------|------|-------------|
| order_number | int | Nomor urut |
| question_code | string | Kode pertanyaan |
| question | text | Pertanyaan audit |
| description | text | Deskripsi |
| question_type | enum | text/file/both |
| is_required | boolean | Ya/Tidak |
| requires_document | boolean | Ya/Tidak |
| document_type | string | Tipe dokumen |

## Indexes & Performance

### Composite Indexes
- `audit_timelines`: (audit_year, department_id)
- `audit_questions`: (audit_program_id, status)
- `audit_answers`: (audit_question_id, answer_status)
- `audit_documents`: (audit_question_id, status)
- `audit_comments`: (audit_question_id, created_at)

### Single Indexes
- All status fields
- All foreign keys (auto-indexed)
- report_date in audit_reports

## Soft Deletes
Semua tabel menggunakan soft delete untuk audit trail dan recovery data.

## Timestamps
Semua tabel memiliki `created_at` dan `updated_at` untuk tracking.
