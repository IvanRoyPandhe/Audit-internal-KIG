<x-app-layout>
  <x-slot name="title">Dashboard</x-slot>

  @php
    $userRole = Auth::user()->role->name;
    // Set default values jika variabel belum ada
    $activePrograms = $activePrograms ?? 0;
    $activeTimelines = $activeTimelines ?? 0;
    $openQuestions = $openQuestions ?? 0;
    $completedPrograms = $completedPrograms ?? 0;
    $progressPercentage = $progressPercentage ?? 0;
  @endphp

  @if($userRole === 'auditor' || $userRole === 'admin')
  <!-- Statistics Cards Row -->
  <div class="row mb-4">
    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <div class="bg-primary rounded-circle p-3">
                <i class="ti ti-clipboard-list text-white fs-5"></i>
              </div>
            </div>
            <div>
              <h6 class="mb-0">Program Aktif</h6>
              <h4 class="mb-0 text-primary">{{ $activePrograms ?? 0 }}</h4>
              <small class="text-success">Sedang berjalan</small>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <div class="bg-success rounded-circle p-3">
                <i class="ti ti-calendar text-white fs-5"></i>
              </div>
            </div>
            <div>
              <h6 class="mb-0">Timeline Aktif</h6>
              <h4 class="mb-0 text-success">{{ $activeTimelines ?? 0 }}</h4>
              <small class="text-success">Tahun {{ date('Y') }}</small>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <div class="bg-warning rounded-circle p-3">
                <i class="ti ti-clock text-white fs-5"></i>
              </div>
            </div>
            <div>
              <h6 class="mb-0">Pertanyaan Open</h6>
              <h4 class="mb-0 text-warning">{{ $openQuestions ?? 0 }}</h4>
              <small class="text-danger">Perlu perhatian</small>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <div class="bg-info rounded-circle p-3">
                <i class="ti ti-check text-white fs-5"></i>
              </div>
            </div>
            <div>
              <h6 class="mb-0">Audit Selesai</h6>
              <h4 class="mb-0 text-info">{{ $completedPrograms ?? 0 }}</h4>
              <small class="text-success">Program completed</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Gantt Chart Timeline Visual -->
  @if(isset($timelines) && $timelines->count() > 0)
  <div class="card mb-4">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">
        <i class="ti ti-chart-bar me-2"></i>Timeline Visual Tahun {{ $year ?? date('Y') }}
      </h5>

      <div class="table-responsive">
        <table class="table table-bordered gantt-chart">
          <thead class="table-light">
            <tr>
              <th width="15%" class="text-center align-middle">Departemen</th>
              @php
                $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
                $colors = [
                  '#5D87FF', '#49BEFF', '#13DEB9', '#FFAE1F', '#FA896B', 
                  '#7C8FAC', '#FF6B9D', '#6C5DD3', '#00D4BD', '#FF9F43'
                ];
              @endphp
              @foreach($months as $month)
                <th class="text-center" style="min-width: 60px;">{{ $month }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
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
                    $startMonth = $timeline->start_date->month;
                    $endMonth = $timeline->end_date->month;
                    $isCovered = false;
                    $coveragePercent = 0;
                    
                    if ($month >= $startMonth && $month <= $endMonth) {
                      $isCovered = true;
                      $monthStart = \Carbon\Carbon::create($year ?? date('Y'), $month, 1);
                      $monthEnd = $monthStart->copy()->endOfMonth();
                      $periodStart = max($timeline->start_date, $monthStart);
                      $periodEnd = min($timeline->end_date, $monthEnd);
                      $daysInMonth = $monthStart->daysInMonth;
                      $coveredDays = $periodStart->diffInDays($periodEnd) + 1;
                      $coveragePercent = ($coveredDays / $daysInMonth) * 100;
                    }
                    $bgColor = $colors[$index % count($colors)];
                  @endphp
                  
                  <td class="text-center align-middle p-1" style="position: relative;">
                    @if($isCovered)
                      <div class="gantt-block" 
                           style="background: {{ $bgColor }}; opacity: {{ $coveragePercent < 100 ? '0.6' : '0.9' }}; height: 40px; border-radius: 4px; position: relative;"
                           data-bs-toggle="tooltip" 
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
    </div>
  </div>
  @endif

  <!-- Calendar View with Overlay Lines -->
  @if(isset($timelines) && $timelines->count() > 0)
  <div class="card mb-4">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">
        <i class="ti ti-calendar me-2"></i>Calendar View - Timeline Audit {{ $year ?? date('Y') }}
      </h5>

      <div class="row">
        @php
          $monthsIndo = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
          $daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
          $currentYear = $year ?? date('Y');
          
          if (($currentYear % 4 == 0 && $currentYear % 100 != 0) || ($currentYear % 400 == 0)) {
            $daysInMonth[1] = 29;
          }
        @endphp

        @foreach($monthsIndo as $monthIndex => $monthName)
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="calendar-month-card">
              <div class="calendar-month-header">
                {{ $monthName }} {{ $currentYear }}
              </div>
              
              <div class="calendar-days-header">
                <div class="calendar-day-name">Min</div>
                <div class="calendar-day-name">Sen</div>
                <div class="calendar-day-name">Sel</div>
                <div class="calendar-day-name">Rab</div>
                <div class="calendar-day-name">Kam</div>
                <div class="calendar-day-name">Jum</div>
                <div class="calendar-day-name">Sab</div>
              </div>

              <div class="calendar-grid-container">
                @php
                  $firstDay = \Carbon\Carbon::create($currentYear, $monthIndex + 1, 1);
                  $startDayOfWeek = $firstDay->dayOfWeek;
                  $totalDays = $daysInMonth[$monthIndex];
                @endphp

                <div class="calendar-dates-grid">
                  @for($i = 0; $i < $startDayOfWeek; $i++)
                    <div class="calendar-date-cell empty"></div>
                  @endfor

                  @for($day = 1; $day <= $totalDays; $day++)
                    <div class="calendar-date-cell">
                      <span class="date-number">{{ $day }}</span>
                    </div>
                  @endfor
                </div>

                <div class="calendar-overlay-container">
                  @foreach($timelines->sortBy('start_date') as $index => $timeline)
                    @php
                      $startMonth = $timeline->start_date->month;
                      $endMonth = $timeline->end_date->month;
                      $startDay = $timeline->start_date->day;
                      $endDay = $timeline->end_date->day;
                      $currentMonth = $monthIndex + 1;
                      
                      $shouldDraw = false;
                      $lineStartDay = 1;
                      $lineEndDay = $totalDays;
                      
                      if ($currentMonth >= $startMonth && $currentMonth <= $endMonth) {
                        $shouldDraw = true;
                        if ($currentMonth == $startMonth) {
                          $lineStartDay = $startDay;
                        }
                        if ($currentMonth == $endMonth) {
                          $lineEndDay = $endDay;
                        }
                      }
                      
                      $bgColor = $colors[$index % count($colors)];
                    @endphp

                    @if($shouldDraw)
                      @php
                        $cellWidth = 100 / 7;
                        $rowHeight = 40;
                        $startPosition = $startDayOfWeek + $lineStartDay - 1;
                        $endPosition = $startDayOfWeek + $lineEndDay - 1;
                        $currentPos = $startPosition;
                        $segments = [];
                        
                        while ($currentPos <= $endPosition) {
                          $row = floor($currentPos / 7);
                          $col = $currentPos % 7;
                          $segmentStart = $col;
                          $segmentEnd = 6;
                          
                          if ($row == floor($endPosition / 7)) {
                            $segmentEnd = $endPosition % 7;
                          }
                          
                          $segments[] = [
                            'left' => $segmentStart * $cellWidth,
                            'width' => ($segmentEnd - $segmentStart + 1) * $cellWidth,
                            'top' => $row * $rowHeight + 15
                          ];
                          
                          $currentPos = ($row + 1) * 7;
                        }
                      @endphp

                      @foreach($segments as $segment)
                        <div class="overlay-line-segment" 
                             style="background: {{ $bgColor }}; 
                                    left: {{ $segment['left'] }}%; 
                                    width: {{ $segment['width'] }}%; 
                                    top: {{ $segment['top'] }}px;"
                             data-bs-toggle="tooltip"
                             title="{{ $timeline->department->name }}: {{ $timeline->start_date->format('d M') }} - {{ $timeline->end_date->format('d M') }}">
                        </div>
                      @endforeach
                    @endif
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="mt-3 p-3 bg-light rounded">
        <div class="d-flex flex-wrap gap-3">
          @foreach($timelines->sortBy('start_date') as $index => $timeline)
            <div class="d-flex align-items-center">
              <div style="width: 30px; height: 8px; background: {{ $colors[$index % count($colors)] }}; border-radius: 2px; margin-right: 8px;"></div>
              <small>{{ $timeline->department->name }}</small>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  @endif

  <!-- Main Dashboard Row -->
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Dashboard SI AI KIG</h5>
          <div id="profit"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="row">
        <div class="col-12 mb-3">
          <div class="card">
            <div class="card-body p-4">
              <h5 class="card-title mb-3 fw-semibold">Statistik Bulanan</h5>
              <div class="row align-items-center">
                <div class="col-7">
                  <h4 class="fw-semibold mb-3">{{ $progressPercentage ?? 0 }}%</h4>
                  <div class="d-flex align-items-center mb-2">
                    <span class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                      <i class="ti ti-arrow-up-left text-success"></i>
                    </span>
                    <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                    <p class="fs-3 mb-0">bulan ini</p>
                  </div>
                </div>
                <div class="col-5">
                  <div class="d-flex justify-content-center">
                    <div id="grade"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-body p-4">
              <h5 class="card-title mb-3 fw-semibold">Activity Log</h5>
              <div class="timeline-widget">
                <div class="timeline-item d-flex align-items-center mb-3">
                  <div class="timeline-icon bg-primary rounded-circle me-3" style="width: 8px; height: 8px;"></div>
                  <div>
                    <p class="mb-0 fs-3">Program audit dibuat</p>
                    <small class="text-muted">2 menit lalu</small>
                  </div>
                </div>
                <div class="timeline-item d-flex align-items-center mb-3">
                  <div class="timeline-icon bg-success rounded-circle me-3" style="width: 8px; height: 8px;"></div>
                  <div>
                    <p class="mb-0 fs-3">Timeline diupdate</p>
                    <small class="text-muted">15 menit lalu</small>
                  </div>
                </div>
                <div class="timeline-item d-flex align-items-center mb-3">
                  <div class="timeline-icon bg-warning rounded-circle me-3" style="width: 8px; height: 8px;"></div>
                  <div>
                    <p class="mb-0 fs-3">User login</p>
                    <small class="text-muted">1 jam lalu</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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
    
    .calendar-month-card {
      border: 1px solid #E9ECEF;
      border-radius: 8px;
      overflow: hidden;
      background: white;
    }
    .calendar-month-header {
      background: linear-gradient(135deg, #5D87FF 0%, #4570EA 100%);
      color: white;
      padding: 12px;
      text-align: center;
      font-weight: 600;
      font-size: 14px;
    }
    .calendar-days-header {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      background: #F8F9FA;
      border-bottom: 1px solid #E9ECEF;
    }
    .calendar-day-name {
      padding: 8px 4px;
      text-align: center;
      font-size: 11px;
      font-weight: 600;
      color: #64748B;
    }
    .calendar-grid-container {
      position: relative;
      padding: 5px;
    }
    .calendar-dates-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 2px;
    }
    .calendar-date-cell {
      aspect-ratio: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #F1F5F9;
      border-radius: 4px;
      position: relative;
      min-height: 35px;
    }
    .calendar-date-cell.empty {
      border: none;
    }
    .date-number {
      font-size: 12px;
      font-weight: 500;
      color: #334155;
      z-index: 1;
      position: relative;
    }
    .calendar-overlay-container {
      position: absolute;
      top: 5px;
      left: 5px;
      right: 5px;
      bottom: 5px;
      pointer-events: none;
    }
    .overlay-line-segment {
      position: absolute;
      height: 8px;
      border-radius: 4px;
      opacity: 0.7;
      pointer-events: all;
      cursor: pointer;
      transition: all 0.2s ease;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .overlay-line-segment:hover {
      opacity: 1;
      height: 10px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.2);
      z-index: 100;
    }
  </style>

  @push('scripts')
  <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });
  </script>
  @endpush

  @else
  <!-- Dashboard untuk role lain -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Selamat Datang, {{ Auth::user()->name }}</h5>
          <p>Anda login sebagai <strong>{{ Auth::user()->role->display_name }}</strong></p>
        </div>
      </div>
    </div>
  </div>
  @endif

</x-app-layout>
