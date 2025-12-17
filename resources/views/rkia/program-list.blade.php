<x-app-layout>
  <x-slot name="title">Daftar Program Audit</x-slot>

  <!-- Header -->
  <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Daftar Program Audit</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('rkia.program') }}">Program Kerja Audit</a></li>
              <li class="breadcrumb-item active" aria-current="page">Daftar Program</li>
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

  <!-- Filter and Actions -->
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h5 class="card-title fw-semibold mb-0">Program Audit Tahun {{ $year }}</h5>
        </div>
        <div class="d-flex gap-2">
          <form method="GET" action="{{ route('rkia.program-list') }}">
            <select name="year" onchange="this.form.submit()" class="form-select">
              @foreach($years as $y)
                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
              @endforeach
            </select>
          </form>
          <a href="{{ route('rkia.program') }}" class="btn btn-secondary">
            <i class="ti ti-arrow-left me-2"></i>Kembali
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Program List -->
  @if($timelines->count() > 0)
    @foreach($timelines as $timeline)
    <div class="card mb-3">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-3">
          <div class="d-flex align-items-center">
            <div class="bg-primary bg-opacity-10 rounded p-3 me-3">
              <iconify-icon icon="solar:buildings-2-bold-duotone" class="text-primary fs-7"></iconify-icon>
            </div>
            <div>
              <h5 class="mb-1">{{ $timeline->department->name }}</h5>
              <div class="d-flex gap-2 align-items-center">
                <span class="badge bg-light-primary text-primary">{{ $timeline->department->code }}</span>
                <span class="text-muted">
                  <i class="ti ti-calendar-event me-1"></i>
                  {{ $timeline->start_date->format('d M Y') }} - {{ $timeline->end_date->format('d M Y') }}
                </span>
              </div>
            </div>
          </div>
          <div>
            @if($timeline->auditPrograms->count() > 0)
              <span class="badge bg-success">{{ $timeline->auditPrograms->count() }} Program</span>
            @else
              <a href="{{ route('audit-programs.create', $timeline) }}" class="btn btn-primary btn-sm">
                <i class="ti ti-plus me-1"></i>Buat Program
              </a>
            @endif
          </div>
        </div>

        @if($timeline->auditPrograms->count() > 0)
          <div class="table-responsive">
            <table class="table table-sm">
              <thead class="table-light">
                <tr>
                  <th>Program Audit</th>
                  <th>Auditor</th>
                  <th class="text-center">Pertanyaan</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($timeline->auditPrograms as $program)
                <tr>
                  <td>
                    <div>
                      <h6 class="mb-0">{{ $program->title }}</h6>
                      <small class="text-muted">{{ Str::limit($program->description, 50) }}</small>
                    </div>
                  </td>
                  <td>
                    @if($program->auditor)
                      <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 rounded-circle p-1 me-2" style="width: 32px; height: 32px;">
                          <i class="ti ti-user text-info"></i>
                        </div>
                        <small>{{ $program->auditor->name }}</small>
                      </div>
                    @else
                      <span class="text-muted">-</span>
                    @endif
                  </td>
                  <td class="text-center">
                    <span class="badge bg-light-info text-info">
                      {{ $program->auditQuestions->count() }} Pertanyaan
                    </span>
                  </td>
                  <td class="text-center">
                    @if($program->status === 'draft')
                      <span class="badge bg-secondary">Draft</span>
                    @elseif($program->status === 'active')
                      <span class="badge bg-success">Aktif</span>
                    @elseif($program->status === 'completed')
                      <span class="badge bg-primary">Selesai</span>
                    @else
                      <span class="badge bg-danger">Dibatalkan</span>
                    @endif
                  </td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <a href="{{ route('audit-programs.show', $program) }}" class="btn btn-sm btn-info" title="Detail">
                        <i class="ti ti-eye"></i>
                      </a>
                      <form action="{{ route('audit-programs.destroy', $program) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus program ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                          <i class="ti ti-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @else
          <div class="alert alert-warning mb-0" role="alert">
            <i class="ti ti-alert-triangle me-2"></i>
            Belum ada program audit untuk departemen ini. 
            <a href="{{ route('audit-programs.create', $timeline) }}" class="alert-link">Buat program sekarang</a>
          </div>
        @endif
      </div>
    </div>
    @endforeach
  @else
    <!-- Empty State -->
    <div class="card">
      <div class="card-body text-center py-5">
        <div class="mb-3">
          <iconify-icon icon="solar:clipboard-list-line-duotone" style="font-size: 64px; color: #ccc;"></iconify-icon>
        </div>
        <h5 class="text-muted">Belum Ada Timeline</h5>
        <p class="text-muted">Buat timeline terlebih dahulu sebelum membuat program audit</p>
        <a href="{{ route('rkia.timeline') }}" class="btn btn-primary">
          <i class="ti ti-calendar me-2"></i>Buat Timeline
        </a>
      </div>
    </div>
  @endif

</x-app-layout>
