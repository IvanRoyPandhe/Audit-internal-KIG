# Implementation Roadmap - Sistem Audit PT KIG

## ✅ Phase 0: Foundation (COMPLETED)

- [x] Docker Compose untuk MySQL database
- [x] Database schema design
- [x] Migration files untuk semua tabel
- [x] Model files (Department, AuditTimeline, AuditProgram, dll)
- [x] Authentication system (Laravel Breeze)
- [x] Role management (Admin, Auditor, Auditee, Pimpinan)
- [x] User management structure

## 📋 Phase 1: Admin Module (PRIORITY)

### 1.1 Department Management
**Files to create:**
- `app/Http/Controllers/DepartmentController.php`
- `app/Http/Requests/StoreDepartmentRequest.php`
- `app/Http/Requests/UpdateDepartmentRequest.php`
- `resources/views/departments/index.blade.php`
- `resources/views/departments/create.blade.php`
- `resources/views/departments/edit.blade.php`

**Features:**
- CRUD departemen
- Assign SM (Senior Manager) ke departemen
- Set status aktif/non-aktif
- List users per departemen

**Routes:**
```php
Route::resource('departments', DepartmentController::class);
```

### 1.2 User Management Enhancement
**Files to update:**
- `app/Http/Controllers/UserController.php`
- `resources/views/users/index.blade.php`
- `resources/views/users/create.blade.php`
- `resources/views/users/edit.blade.php`

**Features:**
- Assign user ke departemen
- Set user sebagai SM (is_department_head)
- Filter user by role dan departemen
- Bulk import users via Excel

---

## 📋 Phase 2: RKIA Timeline Module

### 2.1 Timeline Management
**Files to create:**
- `app/Http/Controllers/RkiaController.php` (update existing)
- `app/Http/Requests/StoreTimelineRequest.php`
- `app/Http/Requests/UpdateTimelineRequest.php`
- `resources/views/rkia/timeline/index.blade.php`
- `resources/views/rkia/timeline/create.blade.php`
- `resources/views/rkia/timeline/edit.blade.php`

**Features:**
- CRUD timeline audit per departemen
- Set tahun audit, start date, end date
- Set status aktif/tidak aktif per departemen
- View timeline dalam bentuk calendar/gantt chart

### 2.2 Timeline Import Excel
**Files to create:**
- `app/Imports/TimelineImport.php`
- `app/Exports/TimelineTemplateExport.php`
- `resources/views/rkia/timeline/import.blade.php`

**Features:**
- Download template Excel dengan list departemen
- Import timeline dari Excel
- Validasi data import
- Preview sebelum save
- Error handling dan reporting

**Package needed:**
```bash
composer require maatwebsite/excel
```

### 2.3 Email Notification
**Files to create:**
- `app/Mail/AuditScheduleNotification.php`
- `app/Jobs/SendAuditNotification.php`
- `resources/views/emails/audit-schedule.blade.php`

**Features:**
- Auto send email ke SM saat timeline dibuat
- Email reminder mendekati deadline
- Queue untuk email processing

---

## 📋 Phase 3: RKIA Program Module

### 3.1 Program Management
**Files to create:**
- `app/Http/Controllers/ProgramController.php`
- `app/Http/Requests/StoreProgramRequest.php`
- `resources/views/rkia/program/index.blade.php`
- `resources/views/rkia/program/show.blade.php`
- `resources/views/rkia/program/create.blade.php`

**Features:**
- List program dari timeline yang aktif
- Create program audit per departemen
- Set status program (draft, active, completed)
- View progress program (total questions, answered, closed)

### 3.2 Question Management
**Files to create:**
- `app/Http/Controllers/QuestionController.php`
- `app/Http/Requests/StoreQuestionRequest.php`
- `resources/views/rkia/program/questions/index.blade.php`
- `resources/views/rkia/program/questions/create.blade.php`
- `resources/views/rkia/program/questions/edit.blade.php`

**Features:**
- CRUD pertanyaan audit
- Set order number (drag & drop)
- Set question type (text, file, both)
- Set required fields
- Assign question ke specific user

### 3.3 Program Import Excel
**Files to create:**
- `app/Imports/QuestionImport.php`
- `app/Exports/QuestionTemplateExport.php`
- `resources/views/rkia/program/questions/import.blade.php`

**Features:**
- Download template Excel untuk pertanyaan
- Import pertanyaan dari Excel
- Bulk create questions
- Validasi dan preview

---

## 📋 Phase 4: Audit Execution Module (Auditee)

### 4.1 Auditee Dashboard
**Files to create:**
- `app/Http/Controllers/AuditeeController.php`
- `resources/views/auditee/dashboard.blade.php`
- `resources/views/auditee/programs/index.blade.php`

**Features:**
- List program audit untuk departemen user
- View deadline dan progress
- Notifikasi pertanyaan yang belum dijawab
- Filter by status

### 4.2 Answer Management
**Files to create:**
- `app/Http/Controllers/AnswerController.php`
- `app/Http/Requests/StoreAnswerRequest.php`
- `resources/views/auditee/questions/index.blade.php`
- `resources/views/auditee/questions/show.blade.php`

**Features:**
- View pertanyaan audit
- Input jawaban (text)
- Upload dokumen pendukung
- Save as draft
- Submit jawaban
- View feedback dari auditor
- Revisi jawaban

### 4.3 Document Upload
**Files to create:**
- `app/Http/Controllers/DocumentController.php`
- `app/Http/Requests/UploadDocumentRequest.php`

**Features:**
- Upload multiple files
- Preview dokumen
- Delete dokumen
- Download dokumen
- File validation (type, size)

**Storage config:**
```php
// config/filesystems.php
'audit_documents' => [
    'driver' => 'local',
    'root' => storage_path('app/audit_documents'),
],
```

---

## 📋 Phase 5: Review Module (Auditor)

### 5.1 Review Dashboard
**Files to create:**
- `app/Http/Controllers/ReviewController.php`
- `resources/views/auditor/review/index.blade.php`
- `resources/views/auditor/review/show.blade.php`

**Features:**
- List program yang perlu direview
- View jawaban dan dokumen auditee
- Filter by status (pending, in progress, closed)
- Bulk actions

### 5.2 Answer Review
**Files to create:**
- `app/Http/Controllers/ReviewAnswerController.php`
- `resources/views/auditor/review/answer.blade.php`

**Features:**
- Review jawaban auditee
- Approve atau request revision
- Give feedback/comments
- Change question status (open → in_progress → closed)
- Review dokumen (approve/reject)

---

## 📋 Phase 6: Comment & Feedback System

### 6.1 Comment Management
**Files to create:**
- `app/Http/Controllers/CommentController.php`
- `app/Http/Requests/StoreCommentRequest.php`
- `resources/views/components/comment-thread.blade.php`

**Features:**
- Add comment per question
- Reply to comment (nested)
- Comment type (question, feedback, revision)
- Internal comment (auditor only)
- Real-time notification
- Mark as read

### 6.2 Notification System
**Files to create:**
- `app/Notifications/NewCommentNotification.php`
- `app/Notifications/AnswerReviewedNotification.php`
- `app/Notifications/DeadlineReminderNotification.php`

**Features:**
- Email notification
- In-app notification
- Notification badge
- Mark all as read

---

## 📋 Phase 7: Report Module

### 7.1 Report Generation
**Files to create:**
- `app/Http/Controllers/ReportController.php`
- `app/Services/ReportGeneratorService.php`
- `resources/views/reports/index.blade.php`
- `resources/views/reports/show.blade.php`
- `resources/views/reports/pdf.blade.php`

**Features:**
- Generate laporan audit
- Executive summary
- List findings (pertanyaan status open)
- Recommendations
- Export to PDF
- Export to Excel

**Package needed:**
```bash
composer require barryvdh/laravel-dompdf
composer require maatwebsite/excel
```

### 7.2 Report Workflow
**Files to create:**
- `app/Http/Controllers/ReportWorkflowController.php`
- `resources/views/reports/workflow.blade.php`

**Features:**
- Draft → Review → Approve → Publish
- Reviewer assignment
- Approver assignment
- Version control
- Audit trail

---

## 📋 Phase 8: Dashboard & Analytics

### 8.1 Admin Dashboard
**Features:**
- Total departemen
- Total users by role
- Active audits
- Completed audits
- Charts & graphs

### 8.2 Auditor Dashboard
**Features:**
- My programs
- Pending reviews
- Upcoming deadlines
- Progress tracking

### 8.3 Auditee Dashboard
**Features:**
- My assignments
- Pending answers
- Deadline alerts
- Progress per program

### 8.4 Pimpinan Dashboard
**Features:**
- Overview all audits
- Department performance
- Findings summary
- Reports library

---

## 📋 Phase 9: Additional Features

### 9.1 Search & Filter
- Global search
- Advanced filters
- Saved filters
- Export filtered data

### 9.2 Activity Log
- User activity tracking
- Audit trail
- Change history
- Export logs

### 9.3 Settings
- Email templates
- Notification preferences
- System configuration
- Backup & restore

---

## 🛠️ Technical Stack

### Backend
- Laravel 12
- MySQL 8.0
- Queue (database driver)
- Mail (SMTP)

### Frontend
- Blade Templates
- Tailwind CSS 3
- Alpine.js
- Chart.js (for graphs)

### Additional Packages
```bash
# Excel Import/Export
composer require maatwebsite/excel

# PDF Generation
composer require barryvdh/laravel-dompdf

# Image Intervention (optional)
composer require intervention/image

# Activity Log
composer require spatie/laravel-activitylog

# Permission (optional, jika perlu granular permission)
composer require spatie/laravel-permission
```

---

## 📝 Development Guidelines

### Coding Standards
- Follow PSR-12
- Use Laravel best practices
- Write meaningful comments
- Use type hints
- Write tests (optional but recommended)

### Git Workflow
```bash
# Feature branch
git checkout -b feature/department-management
git commit -m "feat: add department CRUD"
git push origin feature/department-management

# Merge to main
git checkout main
git merge feature/department-management
```

### Database
- Always use migrations
- Use seeders for test data
- Use factories for dummy data
- Backup before major changes

### Security
- Validate all inputs
- Use CSRF protection
- Sanitize file uploads
- Use authorization (policies/gates)
- Encrypt sensitive data

---

## 🚀 Quick Start Next Steps

### Step 1: Department Management (Start Here)
```bash
# Create controller
php artisan make:controller DepartmentController --resource

# Create requests
php artisan make:request StoreDepartmentRequest
php artisan make:request UpdateDepartmentRequest

# Create views
mkdir -p resources/views/departments
touch resources/views/departments/{index,create,edit,show}.blade.php

# Add routes
# Edit routes/web.php
```

### Step 2: Update Models with Relationships
Edit model files dan tambahkan relationships sesuai DATABASE_SCHEMA.md

### Step 3: Create Seeders
```bash
php artisan make:seeder DepartmentSeeder
```

### Step 4: Test
- Create department
- Assign SM
- Assign users to department

---

## 📚 Documentation

- [SYSTEM_FLOW.md](SYSTEM_FLOW.md) - Alur sistem lengkap
- [DATABASE_SCHEMA.md](DATABASE_SCHEMA.md) - Schema database & ERD
- [DOCKER_SETUP.md](DOCKER_SETUP.md) - Setup Docker
- [SETUP_INSTRUCTIONS.md](SETUP_INSTRUCTIONS.md) - Setup Laravel
- [LOGIN_CREDENTIALS.md](LOGIN_CREDENTIALS.md) - Kredensial login

---

## 🎯 Priority Order

1. **HIGH**: Department Management (Admin)
2. **HIGH**: User Management Enhancement (Admin)
3. **HIGH**: Timeline Management (Auditor)
4. **MEDIUM**: Program & Question Management (Auditor)
5. **MEDIUM**: Answer & Document Upload (Auditee)
6. **MEDIUM**: Review System (Auditor)
7. **LOW**: Comment System
8. **LOW**: Report Generation
9. **LOW**: Dashboard Analytics

---

## 💡 Tips

- Mulai dari modul yang paling sederhana (Department)
- Test setiap fitur sebelum lanjut ke fitur berikutnya
- Gunakan seeder untuk data dummy
- Commit sering dengan message yang jelas
- Dokumentasikan setiap perubahan penting

Good luck! 🚀
