<x-app-layout>
  <x-slot name="title">Timeline Audit</x-slot>

  <!-- Header -->
  <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Timeline Audit</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('rkia.program') }}">Program Kerja Audit</a></li>
              <li class="breadcrumb-item active" aria-current="page">Timeline</li>
            </ol>
          </nav>
        </div>
        <div class="col-3">
          <div class="text-center mb-n5">
            <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" alt="" class="img-fluid mb-n4">
          </div>
        </div>
      </div>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="ti ti-check me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="ti ti-alert-circle me-2"></i>{{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <!-- Actions -->
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h5 class="card-title fw-semibold mb-0">Kelola Timeline Audit</h5>
          <p class="text-muted mb-0 small">Tentukan jadwal audit untuk setiap departemen</p>
        </div>
        <div class="d-flex gap-2">
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importTimelineModal">
            <i class="ti ti-file-upload me-2"></i>Import Excel
          </button>
          <a href="{{ route('rkia.timeline.create', $year) }}" class="btn btn-primary">
            <i class="ti ti-plus me-2"></i>Buat Timeline
          </a>
          <a href="{{ route('rkia.program.year', $year) }}" class="btn btn-secondary">
            <i class="ti ti-arrow-left me-2"></i>Kembali
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Year Info -->
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Timeline Audit Tahun {{ $year }}</h6>
        <span class="badge bg-primary fs-5">{{ $year }}</span>
      </div>
    </div>
  </div>

  <!-- Timeline List -->
  @if($timelines->count() > 0)
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th width="5%">No</th>
                <th>Departemen</th>
                <th>Tanggal Rencana Audit</th>
                <th>Tanggal Realisasi</th>
                <th width="10%" class="text-center">Status</th>
                <th width="12%" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($timelines as $index => $timeline)
              <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded p-2 me-2">
                      <i class="ti ti-building text-primary"></i>
                    </div>
                    <div>
                      <h6 class="mb-0">{{ $timeline->department->name }}</h6>
                      <small class="text-muted">{{ $timeline->department->code }}</small>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <i class="ti ti-calendar-event me-2 text-primary"></i>
                    <div>
                      <strong>{{ $timeline->start_date->format('d M') }}</strong> - <strong>{{ $timeline->end_date->format('d M Y') }}</strong>
                      <br>
                      <small class="text-muted">{{ $timeline->start_date->diffInDays($timeline->end_date) + 1 }} hari</small>
                    </div>
                  </div>
                </td>
                <td>
                  @if($timeline->actual_start_date && $timeline->actual_end_date)
                    <div class="d-flex align-items-center">
                      <i class="ti ti-calendar-check me-2 text-success"></i>
                      <div>
                        <strong class="text-success">{{ $timeline->actual_start_date->format('d M') }}</strong> - <strong class="text-success">{{ $timeline->actual_end_date->format('d M Y') }}</strong>
                        <br>
                        <small class="text-muted">{{ $timeline->actual_start_date->diffInDays($timeline->actual_end_date) + 1 }} hari</small>
                      </div>
                    </div>
                  @else
                    <div class="text-center">
                      <span class="badge bg-light-secondary text-secondary">
                        <i class="ti ti-clock me-1"></i>Belum Terealisasi
                      </span>
                    </div>
                  @endif
                </td>
                <td class="text-center">
                  @if($timeline->status === 'scheduled')
                    <span class="badge bg-info">Terjadwal</span>
                  @elseif($timeline->status === 'ongoing')
                    <span class="badge bg-warning">Berjalan</span>
                  @elseif($timeline->status === 'completed')
                    <span class="badge bg-success">Selesai</span>
                  @else
                    <span class="badge bg-danger">Dibatalkan</span>
                  @endif
                </td>
                <td class="text-center">
                  <div class="btn-group" role="group">
                    <a href="{{ route('rkia.timeline.edit', [$year, $timeline]) }}" class="btn btn-sm btn-warning" title="Edit">
                      <i class="ti ti-edit"></i>
                    </a>
                    @if(Auth::user()->role->name === 'admin')
                    <form action="{{ route('rkia.timeline.destroy', [$year, $timeline]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus timeline ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                        <i class="ti ti-trash"></i>
                      </button>
                    </form>
                    @endif
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  @else
    <!-- Empty State -->
    <div class="card">
      <div class="card-body text-center py-5">
        <div class="mb-3">
          <i class="ti ti-calendar-off" style="font-size: 64px; color: #ccc;"></i>
        </div>
        <h5 class="text-muted">Belum Ada Timeline</h5>
        <p class="text-muted">Mulai dengan membuat timeline audit atau import dari Excel</p>
        <div class="mt-3">
          <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#importTimelineModal">
            <i class="ti ti-file-upload me-2"></i>Import Excel
          </button>
          <a href="{{ route('rkia.timeline.create', $year) }}" class="btn btn-primary">
            <i class="ti ti-plus me-2"></i>Buat Timeline Manual
          </a>
        </div>
      </div>
    </div>
  @endif

  <!-- Gantt Chart Timeline Visual -->
  @if($timelines->count() > 0)
  <div class="card mt-4">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">
        <i class="ti ti-chart-bar me-2"></i>Timeline Visual Tahun {{ $year }}
      </h5>

      <div class="table-responsive">
        <table class="table table-bordered gantt-chart">
          <thead class="table-light">
            <tr>
              <th width="15%" class="text-center align-middle">Departemen</th>
              @php
                $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
              @endphp
              @foreach($months as $month)
                <th class="text-center" style="min-width: 60px;">{{ $month }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @php
              $colors = [
                '#5D87FF', '#49BEFF', '#13DEB9', '#FFAE1F', '#FA896B', 
                '#7C8FAC', '#FF6B9D', '#6C5DD3', '#00D4BD', '#FF9F43'
              ];
            @endphp
            @foreach($timelines->sortBy('start_date') as $index => $timeline)
              <tr>
                <td class="align-middle">
                  <div class="d-flex align-items-center">
                    <div class="rounded p-1 me-2" style="background: {{ $colors[$index % count($colors)] }}20;">
                      <i class="ti ti-building" style="color: {{ $colors[$index % count($colors)] }};"></i>
                    </div>
                    <div>
                      <strong>{{ $timeline->department->name }}</strong>
                      <br>
                      <small class="text-muted">{{ $timeline->start_date->format('d M') }} - {{ $timeline->end_date->format('d M') }}</small>
                    </div>
                  </div>
                </td>
                @for($month = 1; $month <= 12; $month++)
                  @php
                    // Check if this month is covered by the timeline
                    $startMonth = $timeline->start_date->month;
                    $endMonth = $timeline->end_date->month;
                    $startYear = $timeline->start_date->year;
                    $endYear = $timeline->end_date->year;
                    
                    $isCovered = false;
                    $isPartial = false;
                    $coveragePercent = 0;
                    
                    // Check if timeline covers this month
                    if ($startYear == $year && $endYear == $year) {
                      // Same year
                      if ($month >= $startMonth && $month <= $endMonth) {
                        $isCovered = true;
                        
                        // Calculate coverage percentage for partial months
                        $monthStart = \Carbon\Carbon::create($year, $month, 1);
                        $monthEnd = $monthStart->copy()->endOfMonth();
                        
                        $periodStart = max($timeline->start_date, $monthStart);
                        $periodEnd = min($timeline->end_date, $monthEnd);
                        
                        $daysInMonth = $monthStart->daysInMonth;
                        $coveredDays = $periodStart->diffInDays($periodEnd) + 1;
                        $coveragePercent = ($coveredDays / $daysInMonth) * 100;
                        
                        if ($coveragePercent < 100) {
                          $isPartial = true;
                        }
                      }
                    }
                    
                    $bgColor = $colors[$index % count($colors)];
                  @endphp
                  
                  <td class="text-center align-middle p-1" style="position: relative;">
                    @if($isCovered)
                      <div class="gantt-block" 
                           style="background: {{ $bgColor }}; opacity: {{ $isPartial ? '0.6' : '0.9' }}; height: 40px; border-radius: 4px; position: relative;"
                           data-bs-toggle="tooltip" 
                           data-bs-placement="top"
                           title="{{ $timeline->department->name }}: {{ $timeline->start_date->format('d M') }} - {{ $timeline->end_date->format('d M') }}">
                        @if($month == $startMonth)
                          <small class="text-white fw-bold" style="position: absolute; left: 5px; top: 50%; transform: translateY(-50%); font-size: 10px;">
                            {{ $timeline->start_date->format('d') }}
                          </small>
                        @endif
                        @if($month == $endMonth)
                          <small class="text-white fw-bold" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); font-size: 10px;">
                            {{ $timeline->end_date->format('d') }}
                          </small>
                        @endif
                      </div>
                    @else
                      <div style="height: 40px;"></div>
                    @endif
                  </td>
                @endfor
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Legend -->
      <div class="mt-3 d-flex flex-wrap gap-3 align-items-center">
        <small class="text-muted fw-semibold">Keterangan:</small>
        <div class="d-flex align-items-center">
          <div style="width: 20px; height: 20px; background: #5D87FF; opacity: 0.9; border-radius: 3px; margin-right: 5px;"></div>
          <small>Periode Audit Penuh</small>
        </div>
        <div class="d-flex align-items-center">
          <div style="width: 20px; height: 20px; background: #5D87FF; opacity: 0.6; border-radius: 3px; margin-right: 5px;"></div>
          <small>Periode Audit Sebagian</small>
        </div>
        <small class="text-muted">Angka di kotak menunjukkan tanggal mulai/selesai</small>
      </div>
    </div>
  </div>
  @endif

  <style>
    .gantt-chart {
      font-size: 12px;
    }
    .gantt-chart thead th {
      background: #f8f9fa;
      font-weight: 600;
      padding: 10px 5px;
      vertical-align: middle;
    }
    .gantt-chart tbody td {
      padding: 5px;
      vertical-align: middle;
    }
    .gantt-block {
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .gantt-block:hover {
      opacity: 1 !important;
      transform: scale(1.05);
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
  </style>

  <!-- Calendar View with Overlay Lines - Current Month Only -->
  @if($timelines->count() > 0)
  <div class="card mt-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold mb-0">
          <i class="ti ti-calendar me-2"></i>Calendar View
        </h5>
        <div class="calendar-nav-buttons">
          <button class="btn btn-sm btn-outline-primary" id="prevMonth">
            <i class="ti ti-chevron-left"></i> Prev
          </button>
          <span class="mx-3 fw-semibold" id="currentMonthDisplay"></span>
          <button class="btn btn-sm btn-outline-primary" id="nextMonth">
            Next <i class="ti ti-chevron-right"></i>
          </button>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-10 mx-auto">
          <div class="calendar-single-month">
            <!-- Calendar Header with Month/Year -->
            <div class="calendar-month-header-single" id="calendarHeader"></div>
            
            <!-- Day names -->
            <div class="calendar-days-header-single">
              <div class="calendar-day-name">Minggu</div>
              <div class="calendar-day-name">Senin</div>
              <div class="calendar-day-name">Selasa</div>
              <div class="calendar-day-name">Rabu</div>
              <div class="calendar-day-name">Kamis</div>
              <div class="calendar-day-name">Jumat</div>
              <div class="calendar-day-name">Sabtu</div>
            </div>

            <!-- Calendar grid container with overlay -->
            <div class="calendar-with-overlay-container">
              <!-- Overlay lines ABOVE calendar -->
              <div class="calendar-overlay-lines-above" id="overlayLines"></div>
              
              <!-- Calendar grid with dates -->
              <div class="calendar-grid-single" id="calendarGrid"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Legend -->
      <div class="mt-4 p-3 bg-light rounded">
        <div class="d-flex flex-wrap gap-3 align-items-center">
          <small class="text-muted fw-semibold me-2">
            <i class="ti ti-info-circle me-1"></i>Keterangan:
          </small>
          @foreach($timelines->sortBy('start_date') as $index => $timeline)
            <div class="d-flex align-items-center">
              <div style="width: 30px; height: 3px; background: {{ $colors[$index % count($colors)] }}; border-radius: 2px; margin-right: 8px;"></div>
              <small>{{ $timeline->department->name }}</small>
            </div>
          @endforeach
        </div>
        <small class="text-muted d-block mt-2">
          <i class="ti ti-calendar-event me-1"></i>
          Garis berwarna horizontal di atas kalender menunjukkan periode audit setiap departemen.
        </small>
      </div>
    </div>
  </div>

  @php
    $timelinesWithColors = $timelines->map(function($t, $index) use ($colors) {
      return [
        'id' => $t->id,
        'department' => $t->department->name,
        'start_date' => $t->start_date->format('Y-m-d'),
        'end_date' => $t->end_date->format('Y-m-d'),
        'color' => $colors[$index % count($colors)]
      ];
    })->values();
  @endphp

  <script>
    // Calendar data
    const timelinesData = @json($timelinesWithColors);

    const monthsIndo = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    let currentDisplayMonth = new Date().getMonth();
    let currentDisplayYear = {{ $year }};

    function renderCalendar() {
      const firstDay = new Date(currentDisplayYear, currentDisplayMonth, 1);
      const startDayOfWeek = firstDay.getDay();
      const totalDays = new Date(currentDisplayYear, currentDisplayMonth + 1, 0).getDate();
      const totalCells = Math.ceil((startDayOfWeek + totalDays) / 7) * 7;

      // Update header
      document.getElementById('calendarHeader').textContent = `${monthsIndo[currentDisplayMonth]} ${currentDisplayYear}`;
      document.getElementById('currentMonthDisplay').textContent = `${monthsIndo[currentDisplayMonth]} ${currentDisplayYear}`;

      // Render calendar grid
      let gridHTML = '';
      for (let i = 0; i < totalCells; i++) {
        const day = i - startDayOfWeek + 1;
        const isValidDay = day >= 1 && day <= totalDays;
        gridHTML += `<div class="calendar-date-cell-single ${!isValidDay ? 'empty' : ''}">`;
        if (isValidDay) {
          gridHTML += `<span class="date-number-single">${day}</span>`;
        }
        gridHTML += '</div>';
      }
      document.getElementById('calendarGrid').innerHTML = gridHTML;

      // Render overlay lines
      renderOverlayLines(startDayOfWeek, totalDays);
    }

    function renderOverlayLines(startDayOfWeek, totalDays) {
      const overlayContainer = document.getElementById('overlayLines');
      overlayContainer.innerHTML = '';

      // Filter timelines for current month
      const currentMonthTimelines = timelinesData.filter(timeline => {
        const start = new Date(timeline.start_date);
        const end = new Date(timeline.end_date);
        const current = new Date(currentDisplayYear, currentDisplayMonth, 1);
        
        return (start.getFullYear() <= currentDisplayYear && end.getFullYear() >= currentDisplayYear) &&
               (start.getMonth() <= currentDisplayMonth && end.getMonth() >= currentDisplayMonth ||
                start.getFullYear() < currentDisplayYear || end.getFullYear() > currentDisplayYear);
      });

      currentMonthTimelines.forEach((timeline, index) => {
        const start = new Date(timeline.start_date);
        const end = new Date(timeline.end_date);
        
        let lineStartDay = 1;
        let lineEndDay = totalDays;
        
        if (start.getMonth() === currentDisplayMonth && start.getFullYear() === currentDisplayYear) {
          lineStartDay = start.getDate();
        }
        if (end.getMonth() === currentDisplayMonth && end.getFullYear() === currentDisplayYear) {
          lineEndDay = end.getDate();
        }

        // Calculate position
        const startPosition = startDayOfWeek + lineStartDay - 1;
        const endPosition = startDayOfWeek + lineEndDay - 1;
        const cellWidth = 100 / 7;
        const totalRows = Math.ceil((startDayOfWeek + totalDays) / 7);
        
        const startRow = Math.floor(startPosition / 7);
        const endRow = Math.floor(endPosition / 7);
        
        // Draw line segments for each week row
        for (let row = startRow; row <= endRow; row++) {
          // Calculate start and end column for this row
          let segmentStartCol = 0;
          let segmentEndCol = 6;
          
          if (row === startRow) {
            segmentStartCol = startPosition % 7;
          }
          
          if (row === endRow) {
            segmentEndCol = endPosition % 7;
          }
          
          const leftPercent = segmentStartCol * cellWidth;
          const widthPercent = (segmentEndCol - segmentStartCol + 1) * cellWidth;
          const topPosition = (index * 10) + 5; // Stack lines vertically with 10px spacing
          
          const lineDiv = document.createElement('div');
          lineDiv.className = 'overlay-line-segment-above';
          lineDiv.style.cssText = `
            background: ${timeline.color};
            left: ${leftPercent}%;
            width: ${widthPercent}%;
            top: calc(${row * 100 / totalRows}% + ${topPosition}px);
          `;
          lineDiv.setAttribute('data-bs-toggle', 'tooltip');
          lineDiv.setAttribute('title', `${timeline.department}: ${lineStartDay}-${lineEndDay}`);
          
          overlayContainer.appendChild(lineDiv);
        }
      });

      // Reinitialize tooltips
      const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
      tooltips.forEach(el => new bootstrap.Tooltip(el));
    }

    // Navigation buttons
    document.getElementById('prevMonth').addEventListener('click', () => {
      currentDisplayMonth--;
      if (currentDisplayMonth < 0) {
        currentDisplayMonth = 11;
        currentDisplayYear--;
      }
      renderCalendar();
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
      currentDisplayMonth++;
      if (currentDisplayMonth > 11) {
        currentDisplayMonth = 0;
        currentDisplayYear++;
      }
      renderCalendar();
    });

    // Initial render
    renderCalendar();
  </script>
  @endif

  <style>
    .calendar-single-month {
      border: 1px solid #E9ECEF;
      border-radius: 8px;
      overflow: hidden;
      background: white;
    }
    
    .calendar-month-header-single {
      background: linear-gradient(135deg, #5D87FF 0%, #4570EA 100%);
      color: white;
      padding: 15px;
      text-align: center;
      font-weight: 600;
      font-size: 18px;
    }
    
    .calendar-days-header-single {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      background: #F8F9FA;
      border-bottom: 2px solid #E9ECEF;
    }
    
    .calendar-day-name {
      padding: 12px 8px;
      text-align: center;
      font-size: 13px;
      font-weight: 600;
      color: #64748B;
    }
    
    .calendar-with-overlay-container {
      position: relative;
      background: #E9ECEF;
      padding: 1px;
    }
    
    .calendar-overlay-lines-above {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      pointer-events: none;
      z-index: 10;
    }
    
    .overlay-line-segment-above {
      position: absolute;
      height: 6px;
      border-radius: 3px;
      opacity: 0.85;
      pointer-events: all;
      cursor: pointer;
      transition: all 0.2s ease;
      box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    .overlay-line-segment-above:hover {
      opacity: 1;
      height: 8px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.3);
      z-index: 100;
    }
    
    .calendar-grid-single {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 1px;
      position: relative;
    }
    
    .calendar-date-cell-single {
      aspect-ratio: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      background: white;
      position: relative;
      min-height: 70px;
    }
    
    .calendar-date-cell-single.empty {
      background: #F8F9FA;
    }
    
    .date-number-single {
      font-size: 16px;
      font-weight: 500;
      color: #334155;
      position: relative;
      z-index: 5;
    }
    
    .calendar-nav-buttons {
      display: flex;
      align-items: center;
      gap: 10px;
    }
  </style>

  <!-- Import Timeline Modal -->
  <div class="modal fade" id="importTimelineModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <i class="ti ti-file-upload me-2"></i>Import Timeline dari Excel
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('rkia.timeline.import', $year) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Tahun Audit</label>
              <input type="number" name="audit_year" value="{{ $year }}" class="form-control" readonly>
              <small class="text-muted">Tahun otomatis sesuai dengan tahun yang dipilih</small>
            </div>
            <div class="mb-3">
              <label class="form-label">File Excel</label>
              <input type="file" name="file" accept=".xlsx,.xls" class="form-control" required>
              <small class="text-muted">Format: .xlsx atau .xls (Max: 2MB)</small>
            </div>
            <div class="alert alert-warning" role="alert">
              <i class="ti ti-alert-triangle me-2"></i>
              <strong>Catatan:</strong> Download template Excel terlebih dahulu, isi data sesuai format, lalu upload di sini.
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <a href="{{ route('rkia.timeline.download-template', $year) }}" class="btn btn-info" target="_blank">
              <i class="ti ti-download me-2"></i>Download Template
            </a>
            <button type="submit" class="btn btn-success">
              <i class="ti ti-upload me-2"></i>Import
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Initialize tooltips for gantt chart
    document.addEventListener('DOMContentLoaded', function() {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });
  </script>

</x-app-layout>
