<x-app-layout>
  <x-slot name="title">Program Kerja Audit - Pilih Tahun</x-slot>

  <!-- Header -->
  <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Program Kerja Audit</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Program Kerja Audit</li>
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

  <!-- Year Selection -->
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <!-- Action Button -->
      @if(Auth::user()->role->name === 'admin')
      <div class="mb-3 text-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addYearModal">
          <i class="ti ti-plus me-2"></i>Buat Tahun Baru
        </button>
      </div>
      @endif
      <div class="card">
        <div class="card-body py-5">
          <div class="text-center mb-4">
            <div class="mb-3">
              <iconify-icon icon="solar:calendar-bold-duotone" class="text-primary" style="font-size: 80px;"></iconify-icon>
            </div>
            <h3 class="fw-semibold mb-2">Pilih Tahun Program Kerja Audit</h3>
            <p class="text-muted mb-0">Pilih tahun untuk melihat atau membuat program kerja audit</p>
          </div>

          @php
            $auditYears = \App\Models\AuditYear::orderBy('year', 'desc')->get();
            $currentYear = date('Y');
          @endphp

          @if($auditYears->count() > 0)
            <!-- Year Grid -->
            <div class="row g-3 justify-content-center mt-4">
              @foreach($auditYears as $auditYear)
                @php
                  $year = $auditYear->year;
                  $isPast = $year < $currentYear;
                  $isCurrent = $year == $currentYear;
                  $isFuture = $year > $currentYear;
                @endphp

                <div class="col-md-4 col-lg-3">
                  <div class="card year-card h-100 {{ $isCurrent ? 'border-primary' : '' }} {{ !$auditYear->is_active ? 'opacity-50' : '' }}" style="transition: all 0.3s; position: relative;">
                    <div class="card-body text-center p-4">
                      <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="flex-grow-1">
                          @if($isCurrent)
                            <span class="badge bg-primary mb-2">Tahun Ini</span>
                          @elseif($isPast)
                            <span class="badge bg-secondary mb-2">Riwayat</span>
                          @else
                            <span class="badge bg-info mb-2">Mendatang</span>
                          @endif
                        </div>
                        
                        @if(Auth::user()->role->name === 'admin')
                          <div class="dropdown">
                            <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                              <i class="ti ti-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                              <li>
                                <form action="{{ route('audit-years.toggle', $auditYear) }}" method="POST">
                                  @csrf
                                  @method('PATCH')
                                  <button type="submit" class="dropdown-item">
                                    <i class="ti ti-{{ $auditYear->is_active ? 'eye-off' : 'eye' }} me-2"></i>
                                    {{ $auditYear->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                  </button>
                                </form>
                              </li>
                              <li><hr class="dropdown-divider"></li>
                              <li>
                                <button type="button" class="dropdown-item text-danger" 
                                        onclick="confirmDelete({{ $auditYear->id }}, {{ $year }}, {{ $auditYear->timeline_count }})">
                                  <i class="ti ti-trash me-2"></i>Hapus Tahun
                                </button>
                              </li>
                            </ul>
                          </div>
                        @endif
                      </div>

                      <a href="{{ route('rkia.program.year', $year) }}" class="text-decoration-none">
                        <h2 class="fw-bold mb-3 {{ $isCurrent ? 'text-primary' : 'text-dark' }}">{{ $year }}</h2>

                        @if($auditYear->description)
                          <p class="text-muted small mb-3">{{ Str::limit($auditYear->description, 50) }}</p>
                        @endif

                        <div class="d-flex justify-content-around mb-3">
                          <div>
                            <h5 class="mb-0 text-primary">{{ $auditYear->timeline_count }}</h5>
                            <small class="text-muted">Timeline</small>
                          </div>
                          <div>
                            <h5 class="mb-0 text-success">{{ $auditYear->program_count }}</h5>
                            <small class="text-muted">Program</small>
                          </div>
                        </div>

                        @if($auditYear->timeline_count > 0 || $auditYear->program_count > 0)
                          <span class="badge bg-light-success text-success">
                            <i class="ti ti-check me-1"></i>Ada Data
                          </span>
                        @else
                          <span class="badge bg-light-secondary text-secondary">
                            <i class="ti ti-plus me-1"></i>Belum Ada
                          </span>
                        @endif
                      </a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <!-- Empty State -->
            <div class="text-center py-5">
              <iconify-icon icon="solar:calendar-line-duotone" style="font-size: 100px; color: #ccc;"></iconify-icon>
              <h5 class="text-muted mt-4">Belum Ada Tahun Audit</h5>
              <p class="text-muted">Buat tahun audit terlebih dahulu untuk memulai program kerja audit</p>
              @if(Auth::user()->role->name === 'admin')
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addYearModal">
                  <i class="ti ti-plus me-2"></i>Buat Tahun Pertama
                </button>
              @endif
            </div>
          @endif

          <!-- Info -->
          <div class="alert alert-info mt-5 text-start" role="alert">
            <div class="d-flex">
              <i class="ti ti-info-circle me-2 fs-5"></i>
              <div>
                <h6 class="alert-heading mb-2">Informasi:</h6>
                <ul class="mb-0 ps-3">
                  <li><strong>Riwayat:</strong> Lihat program kerja audit tahun-tahun sebelumnya</li>
                  <li><strong>Tahun Ini:</strong> Kelola program kerja audit tahun berjalan</li>
                  <li><strong>Mendatang:</strong> Buat perencanaan program kerja audit untuk tahun depan</li>
                  <li>Klik pada tahun untuk masuk ke halaman program kerja audit tahun tersebut</li>
                  @if(Auth::user()->role->name === 'admin')
                    <li class="text-danger"><strong>Peringatan:</strong> Tahun hanya bisa dihapus jika tidak memiliki data timeline</li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Year Modal -->
  @if(Auth::user()->role->name === 'admin')
  <div class="modal fade" id="addYearModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <i class="ti ti-calendar-plus me-2"></i>Buat Tahun Audit Baru
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('audit-years.store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Tahun <span class="text-danger">*</span></label>
              <input type="number" name="year" class="form-control" min="2020" max="2100" 
                     value="{{ date('Y') }}" required placeholder="Contoh: 2025">
              <small class="text-muted">Masukkan tahun yang ingin dibuat (2020-2100)</small>
            </div>
            <div class="mb-3">
              <label class="form-label">Deskripsi</label>
              <textarea name="description" class="form-control" rows="3" 
                        placeholder="Deskripsi singkat untuk tahun audit ini (opsional)"></textarea>
            </div>
            <div class="alert alert-warning" role="alert">
              <i class="ti ti-alert-triangle me-2"></i>
              <strong>Perhatian:</strong> Pastikan tahun yang dibuat belum ada di sistem.
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">
              <i class="ti ti-check me-2"></i>Buat Tahun
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteYearModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">
            <i class="ti ti-alert-triangle me-2"></i>Konfirmasi Hapus Tahun
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger" role="alert">
            <h6 class="alert-heading">⚠️ PERINGATAN KERAS!</h6>
            <p class="mb-0">Anda akan menghapus tahun audit <strong id="deleteYearText"></strong></p>
          </div>
          <p id="deleteMessage"></p>
          <p class="text-danger fw-bold">Tindakan ini TIDAK DAPAT DIBATALKAN!</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <form id="deleteYearForm" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
              <i class="ti ti-trash me-2"></i>Ya, Hapus Tahun
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endif

  <style>
    .year-card {
      cursor: pointer;
      border: 2px solid #e0e0e0;
    }
    .year-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      border-color: #5D87FF;
    }
    .year-card.border-primary {
      border-color: #5D87FF;
      background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
    }
  </style>

  <script>
    function confirmDelete(yearId, year, timelineCount) {
      const modal = new bootstrap.Modal(document.getElementById('deleteYearModal'));
      const form = document.getElementById('deleteYearForm');
      const yearText = document.getElementById('deleteYearText');
      const message = document.getElementById('deleteMessage');
      
      yearText.textContent = year;
      form.action = '/audit-years/' + yearId;
      
      if (timelineCount > 0) {
        message.innerHTML = '<p class="text-danger">❌ <strong>TIDAK DAPAT DIHAPUS!</strong></p><p>Tahun ini memiliki <strong>' + timelineCount + ' timeline</strong>. Hapus semua timeline terlebih dahulu sebelum menghapus tahun.</p>';
        form.querySelector('button[type="submit"]').disabled = true;
      } else {
        message.innerHTML = '<p class="text-success">✅ Tahun ini tidak memiliki data dan dapat dihapus.</p>';
        form.querySelector('button[type="submit"]').disabled = false;
      }
      
      modal.show();
    }
  </script>

</x-app-layout>
