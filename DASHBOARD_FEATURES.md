# Dashboard Features - Sistem Audit PT KIG

## 🎨 Modern Colorful Dashboard

Dashboard telah diperbarui dengan style modern dan colorful yang lebih menarik secara visual.

### ✨ Fitur Dashboard Auditor

#### 1. **Top Stats Cards** (3 Cards dengan Gradient)
Menampilkan statistik utama dengan gradient warna yang menarik:

- **Program Aktif** (Orange-Pink Gradient)
  - Jumlah program audit yang sedang berjalan
  - Icon clipboard dengan animasi hover
  - Decorative circles untuk efek visual

- **Timeline Aktif** (Blue-Cyan Gradient)
  - Jumlah timeline audit tahun ini
  - Icon calendar dengan animasi hover
  - Background gradient yang smooth

- **Audit Selesai** (Green-Emerald Gradient)
  - Jumlah program audit yang sudah completed
  - Icon checkmark dengan animasi hover
  - Warna hijau yang fresh

**Fitur Visual:**
- Hover effect: scale up & shadow enhancement
- Decorative circles dengan opacity berbeda
- Icon dengan backdrop blur effect
- Smooth transitions

---

#### 2. **Bar Chart: Statistik Program Audit**
Menampilkan statistik program audit dalam 6 bulan terakhir:

- **Data yang ditampilkan:**
  - Program yang dibuat (Cyan bars)
  - Program yang selesai (Purple bars)
  
- **Fitur Interaktif:**
  - Hover tooltip menampilkan jumlah detail
  - Gradient bars dengan smooth transitions
  - Responsive height berdasarkan data
  - Label bulan di bawah setiap bar

**Warna:**
- Cyan gradient untuk "Dibuat"
- Purple gradient untuk "Selesai"

---

#### 3. **Donut Chart: Status Pertanyaan**
Visualisasi distribusi status pertanyaan audit:

- **Segments:**
  - **Open** (Pink/Red) - Pertanyaan yang belum dijawab
  - **In Progress** (Cyan) - Pertanyaan sedang dikerjakan
  - **Closed** (Green) - Pertanyaan sudah selesai

- **Center Display:**
  - Total jumlah pertanyaan
  - Font besar dan bold

- **Legend dengan Badge:**
  - Background gradient untuk setiap status
  - Hover effect yang smooth
  - Jumlah pertanyaan per status
  - Rounded corners yang modern

**Perhitungan:**
- Persentase otomatis berdasarkan total
- SVG circle dengan stroke-dasharray
- Smooth transitions

---

#### 4. **Program Terbaru**
List program audit terbaru dengan design yang menarik:

- **Card Features:**
  - Gradient background per card (5 variasi warna)
  - Department code badge dengan gradient
  - Status badge dengan warna sesuai status
  - Hover effects: scale, rotate, shadow

- **Status Colors:**
  - **Active**: Green-Emerald gradient
  - **Draft**: Gray gradient
  - **Completed**: Blue-Cyan gradient

- **Empty State:**
  - Icon dengan gradient background
  - Call-to-action button dengan gradient
  - Pesan yang friendly

**Gradient Variations:**
1. Purple-Pink
2. Blue-Cyan
3. Green-Emerald
4. Orange-Red
5. Indigo-Purple

---

## 🎯 Data yang Ditampilkan

### Auditor Dashboard
```php
- activeTimelines: Timeline aktif tahun ini
- activePrograms: Program dengan status 'active'
- draftPrograms: Program dengan status 'draft'
- completedPrograms: Program dengan status 'completed'
- questionsNeedReview: Pertanyaan dengan status 'in_progress'
- totalQuestions: Total semua pertanyaan
- openQuestions: Pertanyaan dengan status 'open'
- inProgressQuestions: Pertanyaan dengan status 'in_progress'
- closedQuestions: Pertanyaan dengan status 'closed'
- monthlyStats: Statistik 6 bulan terakhir
- questionDistribution: Distribusi persentase status
- recentPrograms: 5 program terbaru
```

---

## 🎨 Color Palette

### Gradient Combinations
```css
/* Warm */
from-orange-300 via-pink-400 to-pink-500

/* Cool Blue */
from-blue-400 via-blue-500 to-cyan-400

/* Fresh Green */
from-emerald-300 via-green-400 to-teal-400

/* Purple */
from-purple-400 to-pink-500

/* Cyan */
from-blue-400 to-cyan-500

/* Emerald */
from-green-400 to-emerald-500

/* Orange-Red */
from-orange-400 to-red-500

/* Indigo */
from-indigo-400 to-purple-500
```

### Status Colors
```css
/* Open - Pink/Red */
bg-gradient-to-r from-pink-50 to-red-50
from-pink-400 to-red-400

/* In Progress - Cyan/Blue */
bg-gradient-to-r from-cyan-50 to-blue-50
from-cyan-400 to-blue-400

/* Closed - Green/Emerald */
bg-gradient-to-r from-green-50 to-emerald-50
from-green-400 to-emerald-400
```

---

## 🔄 Animations & Transitions

### Hover Effects
- **Cards**: `hover:scale-105` + `hover:shadow-2xl`
- **Icons**: `hover:rotate-12`
- **Badges**: `hover:scale-110`
- **Buttons**: Shadow enhancement

### Transition Durations
- Cards: `duration-300`
- Charts: `duration-500`
- Tooltips: `transition-opacity`

---

## 📱 Responsive Design

### Breakpoints
- **Mobile**: 1 column layout
- **Tablet (md)**: 2-3 columns for stats
- **Desktop (lg)**: Full 3 columns + 2-column charts

### Grid System
```html
<!-- Top Stats -->
grid-cols-1 md:grid-cols-3

<!-- Charts Section -->
grid-cols-1 lg:grid-cols-3
lg:col-span-2 (for bar chart)
```

---

## 🚀 Performance

### Optimizations
- CSS-based charts (no JavaScript libraries)
- SVG for donut chart (lightweight)
- Tailwind JIT compilation
- Minimal DOM elements

### Loading
- Data fetched once per page load
- Cached calculations in controller
- Efficient database queries with eager loading

---

## 📊 Chart Calculations

### Monthly Stats
```php
// Last 6 months data
for ($i = 5; $i >= 0; $i--) {
    $month = now()->subMonths($i);
    // Count created and completed programs
}
```

### Question Distribution
```php
$questionDistribution = [
    'open' => round(($openQuestions / $totalQuestions) * 100),
    'in_progress' => round(($inProgressQuestions / $totalQuestions) * 100),
    'closed' => round(($closedQuestions / $totalQuestions) * 100),
];
```

### Donut Chart SVG
```php
$circumference = 2 * π * radius;
$segmentLength = (percentage / 100) * circumference;
stroke-dasharray="{{ $segmentLength }} {{ $circumference }}"
```

---

## 🎯 Next Improvements

### Potential Enhancements
1. **Real-time Updates**: WebSocket untuk live data
2. **More Charts**: Line chart untuk trends
3. **Filters**: Filter by department, date range
4. **Export**: Download dashboard as PDF
5. **Drill-down**: Click chart untuk detail
6. **Notifications**: Alert untuk pending reviews
7. **Dark Mode**: Toggle dark/light theme

---

## 🔧 Technical Stack

- **Backend**: Laravel 12 + Blade Templates
- **Styling**: Tailwind CSS 3
- **Charts**: Pure CSS + SVG (no libraries)
- **Icons**: Heroicons (SVG)
- **Animations**: Tailwind transitions

---

## 📝 Usage

### Accessing Dashboard
```
URL: /dashboard
Route: dashboard
Controller: DashboardController@index
View: resources/views/dashboard.blade.php
```

### Role-based Display
Dashboard automatically shows different content based on user role:
- Admin: Department & user management
- Auditor: Program & question statistics (COLORFUL VERSION)
- Auditee: Assigned questions & progress
- Pimpinan: Overall audit overview

---

Last Updated: 9 Desember 2025
