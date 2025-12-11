# 📊 Dashboard Design - Sistem Audit Internal

## Overview
Dashboard telah didesain ulang dengan tampilan modern, informatif, dan menggunakan data real dari database. Setiap role memiliki dashboard yang disesuaikan dengan kebutuhan mereka.

## 🎨 Design Principles

### 1. Gradient Cards
Menggunakan gradient background untuk stats cards dengan efek bola-bola transparan:
```css
background: linear-gradient(to bottom right, from-color, to-color)
```

### 2. Glass Morphism
- Semi-transparent backgrounds
- Backdrop blur effects
- Layered circular decorations

### 3. Hover Effects
- Scale transformation pada hover
- Smooth transitions (200-300ms)
- Shadow elevation changes

### 4. Color Coding
- **Blue/Cyan**: Timeline, Primary actions
- **Purple/Pink**: Programs, Secondary actions
- **Orange/Red**: Alerts, Need attention
- **Green/Emerald**: Completed, Success states

## 📱 Dashboard by Role

### 1. Admin Dashboard

#### Welcome Card
- Gradient: Blue → Indigo
- Menampilkan tanggal lengkap
- Nama user dan role
- Decorative circles

#### Stats Cards (4 cards)
1. **Total Departemen** (Orange → Pink)
   - Total count
   - Active departments count

2. **Total Users** (Blue → Cyan)
   - Total registered users

3. **Timeline Tahun Ini** (Green → Emerald)
   - Timelines for current year

4. **Program Aktif** (Purple → Indigo)
   - Active programs count

#### Quick Actions
- Tambah Departemen (Blue gradient)
- Tambah User (Green gradient)
- Kelola Departemen (Purple gradient)
- Hover effect: scale + gradient shift

#### Recent Departments
- List 5 departemen terbaru
- Avatar dengan initial (2 huruf)
- Status badge (Aktif/Nonaktif)

### 2. Auditor Dashboard

#### Welcome Card
- Gradient: Purple → Indigo
- Similar style to admin

#### Stats Cards (4 cards)
1. **Timeline Aktif** (Blue → Cyan)
   - Active timelines for current year

2. **Program Aktif** (Purple → Pink)
   - Active programs
   - Draft programs count

3. **Perlu Review** (Orange → Red)
   - Questions with "in_progress" status
   - Needs attention indicator

4. **Audit Selesai** (Green → Emerald)
   - Completed programs

#### Questions Overview
Grid 4 kolom dengan gradient backgrounds:
- Total Pertanyaan (Gray gradient)
- Open (Red gradient)
- In Progress (Yellow gradient)
- Closed (Green gradient)

#### Workflow Steps
3 langkah dengan numbered circles:
1. Buat Timeline (Blue)
2. Buat Program (Purple)
3. Review & Laporan (Green)

#### Recent Programs
- List 5 program terbaru
- Department code avatar
- Status badge
- Clickable ke detail program

### 3. Auditee Dashboard

#### Welcome Card
- Gradient: Green → Emerald
- Menampilkan department name
- Badge untuk Senior Manager

#### Alert for SM
- Blue info box
- Notification about email alerts

#### Audit Status
Dua kondisi:
1. **Belum ada audit**
   - Empty state dengan icon
   - Informative message

2. **Ada audit aktif**
   - Progress cards
   - Questions statistics
   - Timeline information

### 4. Pimpinan Dashboard

#### Welcome Card
- Gradient: Indigo → Purple
- Executive overview style

#### Stats Cards
- Total Departemen
- Audit Tahun Ini
- Audit Selesai
- Temuan (future feature)

#### Programs Overview
- Table/list of all programs
- Progress percentage
- Department name
- Status indicators

## 🎯 Data Sources

### Admin Dashboard
```php
- totalDepartments: Department::count()
- totalUsers: User::count()
- activeDepartments: Department::where('is_active', true)->count()
- seniorManagers: User::where('is_department_head', true)->count()
- timelinesThisYear: AuditTimeline::where('audit_year', $year)->count()
- activePrograms: AuditProgram::where('status', 'active')->count()
- recentDepartments: Latest 5 departments
- recentUsers: Latest 5 users
```

### Auditor Dashboard
```php
- activeTimelines: Active timelines for current year
- activePrograms: Programs with status 'active'
- draftPrograms: Programs with status 'draft'
- completedPrograms: Programs with status 'completed'
- questionsNeedReview: Questions with status 'in_progress'
- totalQuestions: All questions count
- openQuestions: Questions with status 'open'
- inProgressQuestions: Questions with status 'in_progress'
- closedQuestions: Questions with status 'closed'
- recentPrograms: Latest 5 programs
- departmentProgress: Progress by department
```

### Auditee Dashboard
```php
- hasAudit: Boolean check
- department: User's department
- timeline: Active timeline for department
- program: Program for timeline
- totalQuestions: Total questions in program
- openQuestions: Open questions count
- inProgressQuestions: In progress questions count
- closedQuestions: Closed questions count
- percentage: Completion percentage
```

### Pimpinan Dashboard
```php
- totalDepartments: All departments
- auditsThisYear: Timelines for current year
- completedAudits: Completed programs
- activeAudits: Active programs
- programsOverview: All programs with progress
- totalQuestions: All questions
- closedQuestions: Closed questions
```

## 🎨 Color Palette

### Gradient Combinations

#### Orange → Pink
```css
from-orange-400 to-pink-500
```
Used for: Departemen, Attention items

#### Blue → Cyan
```css
from-blue-400 to-cyan-500
```
Used for: Timeline, Users, Primary actions

#### Green → Emerald
```css
from-green-400 to-emerald-500
```
Used for: Completed, Success states

#### Purple → Indigo/Pink
```css
from-purple-400 to-indigo-500
from-purple-400 to-pink-500
```
Used for: Programs, Secondary actions

#### Orange → Red
```css
from-orange-400 to-red-500
```
Used for: Alerts, Need review

## 📐 Component Structure

### Stats Card Template
```html
<div class="relative rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
    <!-- Gradient Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-{color}-400 to-{color}-500"></div>
    
    <!-- Decorative Circles -->
    <div class="absolute top-0 right-0 w-32 h-32 bg-white/20 rounded-full -mr-16 -mt-16"></div>
    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full -ml-12 -mb-12"></div>
    
    <!-- Content -->
    <div class="relative p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <p class="text-white/80 text-sm font-medium">Label</p>
            <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                <!-- Icon -->
            </div>
        </div>
        <h3 class="text-4xl font-bold mb-1">{{ $value }}</h3>
        <p class="text-white/70 text-xs">Subtitle</p>
    </div>
</div>
```

### Welcome Card Template
```html
<div class="bg-gradient-to-br from-{color}-600 via-{color}-700 to-{color2}-800 rounded-2xl shadow-2xl p-8 text-white relative overflow-hidden">
    <!-- Decorative Circles -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -ml-24 -mb-24"></div>
    
    <!-- Content -->
    <div class="relative z-10">
        <p class="text-{color}-200 text-sm mb-2">{{ date }}</p>
        <h2 class="text-3xl font-bold mb-2">Welcome, {{ name }}</h2>
        <p class="text-{color}-100 text-lg">{{ role }}</p>
    </div>
</div>
```

## 🔄 Responsive Design

### Breakpoints
- **Mobile**: Single column layout
- **Tablet (md)**: 2 columns for stats
- **Desktop (lg)**: 4 columns for stats

### Grid System
```html
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Cards -->
</div>
```

## ✨ Animations & Transitions

### Hover Effects
```css
.group:hover {
    transform: scale(1.02);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

.group-hover\:scale-110 {
    transform: scale(1.1);
}
```

### Transition Durations
- Quick: 200ms (hover states)
- Medium: 300ms (card transforms)
- Slow: 500ms (page transitions)

## 📊 Empty States

### Design
- Large icon (w-16 h-16)
- Gray color (text-gray-400)
- Descriptive message
- Optional action button

### Example
```html
<div class="text-center py-12">
    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4">...</svg>
    <h3 class="text-lg font-medium text-gray-900 mb-2">Title</h3>
    <p class="text-gray-600 mb-6">Description</p>
    <a href="#" class="btn">Action</a>
</div>
```

## 🚀 Performance Considerations

### Optimizations
1. **Lazy Loading**: Images and heavy components
2. **CSS Animations**: GPU-accelerated transforms
3. **Efficient Queries**: Eager loading relationships
4. **Caching**: Dashboard data cached for 5 minutes

### Database Queries
- Use `count()` for simple counts
- Use `with()` for eager loading
- Use `select()` to limit columns
- Use `take()` to limit results

## 📝 Future Enhancements

### Planned Features
1. **Charts & Graphs**
   - Progress charts (Chart.js or ApexCharts)
   - Trend analysis
   - Department comparison

2. **Real-time Updates**
   - WebSocket integration
   - Live notifications
   - Auto-refresh data

3. **Customization**
   - User can choose widgets
   - Drag & drop layout
   - Color theme selection

4. **Export**
   - PDF dashboard report
   - Excel data export
   - Email scheduled reports

5. **Filters**
   - Date range selector
   - Department filter
   - Status filter

---

**Created**: 9 Desember 2025  
**Last Updated**: 9 Desember 2025  
**Version**: 1.0
