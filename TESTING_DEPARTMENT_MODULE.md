# Testing Department Module

## Setup Complete ✅

### Database
- ✅ 8 Departments created
- ✅ 10 Users created
- ✅ 7 Users assigned to departments
- ✅ 3 Senior Managers assigned

### Departments Data
| Code | Name | SM | Users |
|------|------|-----|-------|
| FIN | Finance | Auditee SM | 3 users |
| IT | Information Technology | Ahmad Fauzi | 2 users |
| HR | Human Resources | - | 0 users |
| OPS | Operations | Auditee EM | 2 users |
| MKT | Marketing | - | 0 users |
| PROC | Procurement | - | 0 users |
| QA | Quality Assurance | - | 0 users |
| LOG | Logistics (Inactive) | - | 0 users |

### Users Data
| Name | Username | Role | Department | Is SM |
|------|----------|------|------------|-------|
| Administrator | admin | Admin | - | No |
| Auditor Senior | auditor | Auditor | - | No |
| Pimpinan | pimpinan | Pimpinan | - | No |
| Auditee SM | auditee_sm | Auditee SM | Finance | Yes |
| Budi Santoso | budi.santoso | Auditee EM | Finance | No |
| Siti Nurhaliza | siti.nurhaliza | Auditee EM | Finance | No |
| Ahmad Fauzi | ahmad.fauzi | Auditee SM | IT | Yes |
| Dewi Lestari | dewi.lestari | Auditee EM | IT | No |
| Auditee EM | auditee_em | Auditee EM | Operations | Yes |
| Rudi Hartono | rudi.hartono | Auditee EM | Operations | No |

## Test Cases

### 1. Access Department List
**Login as:** admin / password

**Steps:**
1. Login ke aplikasi
2. Klik menu "Departemen" di navigation
3. Verify: Melihat list 8 departemen
4. Verify: Setiap departemen menampilkan:
   - Kode departemen
   - Nama departemen
   - Senior Manager (jika ada)
   - Jumlah user
   - Status aktif/tidak aktif
   - Action buttons (View, Edit, Delete)

**Expected Result:**
- ✅ Halaman department list tampil
- ✅ Data 8 departemen tampil dengan benar
- ✅ Finance menampilkan SM: Auditee SM, 3 users
- ✅ IT menampilkan SM: Ahmad Fauzi, 2 users
- ✅ Operations menampilkan SM: Auditee EM, 2 users
- ✅ Logistics menampilkan status "Tidak Aktif"

---

### 2. View Department Detail
**Login as:** admin / password

**Steps:**
1. Di halaman department list
2. Klik icon "View" (mata) pada departemen Finance
3. Verify: Melihat detail departemen
4. Verify: Melihat informasi:
   - Kode: FIN
   - Nama: Finance
   - Deskripsi
   - Status: Aktif
   - Senior Manager: Auditee SM
   - List 3 users (Auditee SM, Budi Santoso, Siti Nurhaliza)

**Expected Result:**
- ✅ Halaman detail department tampil
- ✅ Informasi department lengkap
- ✅ List users tampil dengan benar
- ✅ SM ditandai dengan badge "SM"

---

### 3. Create New Department
**Login as:** admin / password

**Steps:**
1. Di halaman department list
2. Klik button "Tambah Departemen"
3. Isi form:
   - Kode: SALES
   - Nama: Sales Department
   - Deskripsi: Departemen penjualan
   - Senior Manager: (pilih salah satu user)
   - Status: Aktif (checked)
4. Klik "Simpan Departemen"

**Expected Result:**
- ✅ Redirect ke halaman department list
- ✅ Success message tampil
- ✅ Department baru "SALES" muncul di list
- ✅ SM yang dipilih ter-assign ke department

---

### 4. Edit Department
**Login as:** admin / password

**Steps:**
1. Di halaman department list
2. Klik icon "Edit" (pensil) pada departemen HR
3. Update form:
   - Nama: Human Resources & Development
   - Deskripsi: Update deskripsi
   - Senior Manager: (pilih user)
4. Klik "Update Departemen"

**Expected Result:**
- ✅ Redirect ke halaman department list
- ✅ Success message tampil
- ✅ Data department HR ter-update
- ✅ SM baru ter-assign

---

### 5. Delete Department (Success)
**Login as:** admin / password

**Steps:**
1. Di halaman department list
2. Klik icon "Delete" (trash) pada departemen QA (yang tidak punya user)
3. Confirm delete
4. Verify: Department terhapus

**Expected Result:**
- ✅ Redirect ke halaman department list
- ✅ Success message tampil
- ✅ Department QA hilang dari list

---

### 6. Delete Department (Failed - Has Users)
**Login as:** admin / password

**Steps:**
1. Di halaman department list
2. Klik icon "Delete" (trash) pada departemen Finance (yang punya users)
3. Confirm delete
4. Verify: Error message muncul

**Expected Result:**
- ✅ Error message: "Tidak dapat menghapus departemen yang masih memiliki user"
- ✅ Department Finance masih ada di list

---

### 7. Validation Test - Duplicate Code
**Login as:** admin / password

**Steps:**
1. Klik "Tambah Departemen"
2. Isi form dengan kode yang sudah ada:
   - Kode: FIN (sudah ada)
   - Nama: Test Department
3. Klik "Simpan Departemen"

**Expected Result:**
- ✅ Validation error tampil
- ✅ Error message: "Kode departemen sudah digunakan"
- ✅ Form tidak ter-submit

---

### 8. Validation Test - Required Fields
**Login as:** admin / password

**Steps:**
1. Klik "Tambah Departemen"
2. Kosongkan field Kode dan Nama
3. Klik "Simpan Departemen"

**Expected Result:**
- ✅ Validation error tampil
- ✅ Error message untuk field yang required
- ✅ Form tidak ter-submit

---

### 9. Navigation Menu Test
**Login as:** admin / password

**Steps:**
1. Login sebagai admin
2. Verify menu navigation tampil:
   - Dashboard
   - Departemen
   - Users
   - Roles
   - RKIA (dropdown)
   - Laporan

**Expected Result:**
- ✅ Semua menu tampil untuk admin
- ✅ Menu aktif ter-highlight

---

### 10. Access Control Test
**Login as:** auditor / password

**Steps:**
1. Login sebagai auditor
2. Coba akses URL: /departments
3. Verify: Access denied atau redirect

**Expected Result:**
- ✅ Auditor tidak bisa akses department management
- ✅ Error 403 atau redirect ke dashboard

---

## Manual Testing Checklist

### UI/UX
- [ ] Layout responsive di mobile
- [ ] Layout responsive di tablet
- [ ] Layout responsive di desktop
- [ ] Button hover effects working
- [ ] Icons tampil dengan benar
- [ ] Colors sesuai tema (blue)
- [ ] Typography readable
- [ ] Spacing consistent

### Functionality
- [ ] List departments working
- [ ] Pagination working (jika > 10 departments)
- [ ] View detail working
- [ ] Create department working
- [ ] Edit department working
- [ ] Delete department working
- [ ] Validation working
- [ ] Success messages tampil
- [ ] Error messages tampil

### Data Integrity
- [ ] SM ter-assign dengan benar
- [ ] User count akurat
- [ ] Status aktif/tidak aktif working
- [ ] Soft delete working
- [ ] Timestamps ter-record

### Performance
- [ ] Page load < 2 seconds
- [ ] No N+1 query issues
- [ ] Eager loading working (with, withCount)

---

## Bug Report Template

```
**Bug Title:** [Short description]

**Severity:** Critical / High / Medium / Low

**Steps to Reproduce:**
1. 
2. 
3. 

**Expected Result:**


**Actual Result:**


**Screenshots:**
[Attach if applicable]

**Environment:**
- Browser: 
- OS: 
- Laravel Version: 12
- PHP Version: 8.2
```

---

## Test Results

### Test Date: [Fill in]
### Tester: [Fill in]

| Test Case | Status | Notes |
|-----------|--------|-------|
| 1. Access Department List | ⬜ Pass / ⬜ Fail | |
| 2. View Department Detail | ⬜ Pass / ⬜ Fail | |
| 3. Create New Department | ⬜ Pass / ⬜ Fail | |
| 4. Edit Department | ⬜ Pass / ⬜ Fail | |
| 5. Delete Department (Success) | ⬜ Pass / ⬜ Fail | |
| 6. Delete Department (Failed) | ⬜ Pass / ⬜ Fail | |
| 7. Validation - Duplicate Code | ⬜ Pass / ⬜ Fail | |
| 8. Validation - Required Fields | ⬜ Pass / ⬜ Fail | |
| 9. Navigation Menu Test | ⬜ Pass / ⬜ Fail | |
| 10. Access Control Test | ⬜ Pass / ⬜ Fail | |

**Overall Status:** ⬜ All Pass / ⬜ Some Failed

**Notes:**


---

## Next Steps After Testing

1. ✅ Fix any bugs found
2. ✅ Optimize queries if needed
3. ✅ Add more test data if needed
4. ✅ Document any edge cases
5. ✅ Move to next module (User Management Enhancement)

---

## Quick Test Commands

```bash
# Check database
php artisan tinker --execute="echo 'Departments: ' . \App\Models\Department::count();"

# Check users with departments
php artisan tinker --execute="\App\Models\User::whereNotNull('department_id')->with('department')->get(['name', 'department_id'])->each(function(\$u) { echo \$u->name . ' -> ' . \$u->department->name . PHP_EOL; });"

# Check SMs
php artisan tinker --execute="\App\Models\User::where('is_department_head', true)->with('department')->get(['name', 'department_id'])->each(function(\$u) { echo \$u->name . ' (SM of ' . \$u->department->name . ')' . PHP_EOL; });"

# Reset and reseed
php artisan migrate:fresh --seed
```
