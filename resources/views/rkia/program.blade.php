<x-app-layout>
  <x-slot name="title">Program Kerja Audit</x-slot>

  <!-- Header -->
  <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Program Kerja Audit - Tahun {{ $year }}</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('rkia.program') }}">Program Kerja Audit</a></li>
              <li class="breadcrumb-item active" aria-current="page">Tahun {{ $year }}</li>
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

  <!-- Back to Year Selection -->
  <div class="mb-3">
    <a href="{{ route('rkia.program') }}" class="btn btn-light">
      <i class="ti ti-arrow-left me-2"></i>Kembali ke Pilihan Tahun
    </a>
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

  <!-- Main Menu Cards -->
  <div class="row">
    <!-- Timeline Card -->
    <div class="col-md-6 mb-4">
      <div class="card hover-card h-100" style="transition: all 0.3s;">
        <div class="card-body text-center p-5">
          <div class="mb-4">
            <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
              <iconify-icon icon="solar:calendar-line-duotone" class="text-primary" style="font-size: 48px;"></iconify-icon>
            </div>
          </div>
          <h4 class="fw-semibold mb-3">Timeline Audit</h4>
          <p class="text-muted mb-4">
            Kelola jadwal audit untuk setiap departemen. Tentukan periode audit dan departemen yang akan diaudit.
          </p>
          <div class="d-flex justify-content-center gap-3 mb-3">
            <div class="text-center">
              <h5 class="mb-0 text-primary">{{ $timelines->count() }}</h5>
              <small class="text-muted">Timeline</small>
            </div>
            <div class="text-center">
              <h5 class="mb-0 text-success">{{ $timelines->where('is_active', true)->count() }}</h5>
              <small class="text-muted">Aktif</small>
            </div>
          </div>
          <a href="{{ route('rkia.timeline', $year) }}" class="btn btn-primary">
            <i class="ti ti-calendar me-2"></i>Kelola Timeline
          </a>
        </div>
      </div>
    </div>

    <!-- Program Audit Card -->
    <div class="col-md-6 mb-4">
      <div class="card hover-card h-100" style="transition: all 0.3s;">
        <div class="card-body text-center p-5">
          <div class="mb-4">
            <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
              <iconify-icon icon="solar:clipboard-list-line-duotone" class="text-success" style="font-size: 48px;"></iconify-icon>
            </div>
          </div>
          <h4 class="fw-semibold mb-3">Program Audit</h4>
          <p class="text-muted mb-4">
            Buat dan kelola program audit untuk setiap departemen. Input pertanyaan audit dan monitor progress.
          </p>
          <div class="d-flex justify-content-center gap-3 mb-3">
            <div class="text-center">
              <h5 class="mb-0 text-success">{{ $timelines->sum(function($t) { return $t->auditPrograms->count(); }) }}</h5>
              <small class="text-muted">Program</small>
            </div>
            <div class="text-center">
              <h5 class="mb-0 text-warning">{{ $timelines->sum(function($t) { return $t->auditPrograms->sum(function($p) { return $p->auditQuestions->count(); }); }) }}</h5>
              <small class="text-muted">Pertanyaan</small>
            </div>
          </div>
          <a href="{{ route('rkia.program-list', $year) }}" class="btn btn-success">
            <i class="ti ti-clipboard-list me-2"></i>Kelola Program
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Info -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-3">
            <i class="ti ti-info-circle me-2"></i>Alur Kerja Program Audit
          </h5>
          <div class="row">
            <div class="col-md-4 mb-3">
              <div class="d-flex align-items-start">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; min-width: 40px;">
                  <span class="fw-bold">1</span>
                </div>
                <div>
                  <h6 class="fw-semibold mb-1">Buat Timeline</h6>
                  <p class="text-muted mb-0 small">Tentukan jadwal audit untuk setiap departemen melalui menu Timeline Audit</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="d-flex align-items-start">
                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; min-width: 40px;">
                  <span class="fw-bold">2</span>
                </div>
                <div>
                  <h6 class="fw-semibold mb-1">Input Program Audit</h6>
                  <p class="text-muted mb-0 small">Buat program audit dan pertanyaan untuk setiap departemen yang sudah dijadwalkan</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="d-flex align-items-start">
                <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; min-width: 40px;">
                  <span class="fw-bold">3</span>
                </div>
                <div>
                  <h6 class="fw-semibold mb-1">Monitor & Laporan</h6>
                  <p class="text-muted mb-0 small">Pantau progress audit dan buat laporan hasil audit</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Statistics -->
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <iconify-icon icon="solar:calendar-bold-duotone" class="fs-8 text-primary"></iconify-icon>
            </div>
            <div>
              <h6 class="mb-0 text-muted">Total Timeline</h6>
              <h3 class="mb-0 fw-semibold">{{ $timelines->count() }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <iconify-icon icon="solar:clipboard-list-bold-duotone" class="fs-8 text-success"></iconify-icon>
            </div>
            <div>
              <h6 class="mb-0 text-muted">Total Program</h6>
              <h3 class="mb-0 fw-semibold">{{ $timelines->sum(function($t) { return $t->auditPrograms->count(); }) }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <iconify-icon icon="solar:document-text-bold-duotone" class="fs-8 text-warning"></iconify-icon>
            </div>
            <div>
              <h6 class="mb-0 text-muted">Total Pertanyaan</h6>
              <h3 class="mb-0 fw-semibold">{{ $timelines->sum(function($t) { return $t->auditPrograms->sum(function($p) { return $p->auditQuestions->count(); }); }) }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <iconify-icon icon="solar:buildings-2-bold-duotone" class="fs-8 text-info"></iconify-icon>
            </div>
            <div>
              <h6 class="mb-0 text-muted">Departemen</h6>
              <h3 class="mb-0 fw-semibold">{{ $timelines->pluck('department_id')->unique()->count() }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    .hover-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
  </style>

</x-app-layout>
