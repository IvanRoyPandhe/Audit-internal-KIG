<x-app-layout>
  <x-slot name="title">Detail Program Audit</x-slot>

  <!-- Header -->
  <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Detail Program Audit</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('rkia.program') }}">Program Kerja Audit</a></li>
              <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('rkia.program-list') }}">Daftar Program</a></li>
              <li class="breadcrumb-item active" aria-current="page">Detail</li>
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

  @if(session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      <i class="ti ti-info-circle me-2"></i>{{ session('info') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="ti ti-alert-circle me-2"></i>{{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <!-- Program Info -->
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="d-flex align-items-center">
          <div class="bg-primary bg-opacity-10 rounded p-3 me-3">
            <iconify-icon icon="solar:clipboard-list-bold-duotone" class="text-primary fs-7"></iconify-icon>
          </div>
          <div>
            <h5 class="mb-1">{{ $program->program_name }}</h5>
            <div class="d-flex gap-2 align-items-center flex-wrap">
              <span class="badge bg-light-primary text-primary">{{ $program->program_code }}</span>
              <span class="badge bg-light-info text-info">{{ $program->auditTimeline->department->name }}</span>
              <span class="text-muted">
                <i class="ti ti-calendar-event me-1"></i>
                {{ $program->start_date->format('d M Y') }} - {{ $program->end_date->format('d M Y') }}
              </span>
            </div>
          </div>
        </div>
        <div>
          @if($program->status === 'draft')
            <span class="badge bg-secondary fs-5">Draft</span>
          @elseif($program->status === 'active')
            <span class="badge bg-success fs-5">Aktif</span>
          @elseif($program->status === 'completed')
            <span class="badge bg-primary fs-5">Selesai</span>
          @endif
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <h6 class="fw-semibold mb-2">Deskripsi:</h6>
          <p class="text-muted">{{ $program->description ?? '-' }}</p>
        </div>
        <div class="col-md-6">
          <h6 class="fw-semibold mb-2">Tujuan Audit:</h6>
          <p class="text-muted">{{ $program->audit_objective ?? '-' }}</p>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-md-12">
          <h6 class="fw-semibold mb-2">Untuk Memastikan:</h6>
          <p class="text-muted">{{ $program->assurance_scope ?? '-' }}</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Tim & Risiko -->
  <div class="row">
    <!-- Tim Auditor -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-3">
            <i class="ti ti-users me-2"></i>Tim Auditor
          </h5>
          
          <div class="mb-3">
            <h6 class="text-muted mb-2">Ketua Tim:</h6>
            @if($program->teamLeader)
              <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                  <i class="ti ti-user-star text-primary"></i>
                </div>
                <div>
                  <h6 class="mb-0">{{ $program->teamLeader->name }}</h6>
                  <small class="text-muted">{{ $program->teamLeader->position ?? 'Auditor' }}</small>
                </div>
              </div>
            @else
              <span class="text-muted">-</span>
            @endif
          </div>

          <div>
            <h6 class="text-muted mb-2">Anggota Tim:</h6>
            @if($program->team_members_users->count() > 0)
              <div class="d-flex flex-wrap gap-2">
                @foreach($program->team_members_users as $member)
                  <span class="badge bg-light-info text-info">
                    <i class="ti ti-user me-1"></i>{{ $member->name }}
                  </span>
                @endforeach
              </div>
            @else
              <span class="text-muted">Tidak ada anggota</span>
            @endif
          </div>
        </div>
      </div>
    </div>

    <!-- Risiko -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-3">
            <i class="ti ti-alert-triangle me-2"></i>Identifikasi Risiko
          </h5>
          
          @if($program->risks && count($program->risks) > 0)
            <div class="list-group list-group-flush">
              @foreach($program->risks as $index => $risk)
                <div class="list-group-item px-0">
                  <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                      <h6 class="mb-1">{{ $index + 1 }}. {{ $risk['name'] }}</h6>
                      <div class="mt-2">
                        @if($risk['level'] === 'low')
                          <span class="badge bg-success">🟢 Low - Rendah</span>
                        @elseif($risk['level'] === 'medium')
                          <span class="badge bg-warning">🟡 Medium - Sedang</span>
                        @elseif($risk['level'] === 'high')
                          <span class="badge bg-orange">🟠 High - Tinggi</span>
                        @else
                          <span class="badge bg-danger">🔴 Critical - Kritis</span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <p class="text-muted">Tidak ada risiko yang diidentifikasi</p>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- Documents Section -->
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold mb-0">
          <i class="ti ti-file-text me-2"></i>Dokumen yang Dibutuhkan
        </h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDocumentModal">
          <i class="ti ti-plus me-2"></i>Tambah Dokumen
        </button>
      </div>

      @if($program->documents->count() > 0)
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-light">
              <tr>
                <th width="5%">No</th>
                <th>Nama Dokumen</th>
                <th width="15%">Status</th>
                <th width="15%">Wajib</th>
                <th width="20%">File</th>
                <th width="15%" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($program->documents as $index => $doc)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                  <div>
                    <h6 class="mb-1">{{ $doc->document_name }}</h6>
                    @if($doc->description)
                      <small class="text-muted">{{ Str::limit($doc->description, 80) }}</small>
                    @endif
                  </div>
                </td>
                <td>
                  @if($doc->status === 'required')
                    <span class="badge bg-secondary">Dibutuhkan</span>
                  @elseif($doc->status === 'uploaded')
                    <span class="badge bg-info">Terupload</span>
                  @elseif($doc->status === 'reviewed')
                    <span class="badge bg-warning">Direview</span>
                  @else
                    <span class="badge bg-success">Disetujui</span>
                  @endif
                </td>
                <td>
                  @if($doc->is_mandatory)
                    <span class="badge bg-danger">Wajib</span>
                  @else
                    <span class="badge bg-secondary">Opsional</span>
                  @endif
                </td>
                <td>
                  @if($doc->file_path)
                    <div class="d-flex align-items-center">
                      <i class="ti ti-file-check text-success me-2"></i>
                      <small>{{ $doc->file_name }}</small>
                    </div>
                  @else
                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#uploadModal{{ $doc->id }}">
                      <i class="ti ti-upload me-1"></i>Upload
                    </button>
                  @endif
                </td>
                <td class="text-center">
                  <div class="btn-group" role="group">
                    @if($doc->file_path)
                      <a href="{{ route('audit-program-documents.download', $doc) }}" class="btn btn-sm btn-success" title="Download">
                        <i class="ti ti-download"></i>
                      </a>
                    @endif
                    <form action="{{ route('audit-program-documents.destroy', $doc) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                        <i class="ti ti-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>

              <!-- Upload Modal for each document -->
              <div class="modal fade" id="uploadModal{{ $doc->id }}" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Upload: {{ $doc->document_name }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('audit-program-documents.upload', $doc) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="modal-body">
                        <div class="mb-3">
                          <label class="form-label">Pilih File</label>
                          <input type="file" name="file" class="form-control" required accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
                          <small class="text-muted">Format: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG (Max: 10MB)</small>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                          <i class="ti ti-upload me-2"></i>Upload
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="text-center py-5">
          <iconify-icon icon="solar:file-text-line-duotone" style="font-size: 64px; color: #ccc;"></iconify-icon>
          <h5 class="text-muted mt-3">Belum Ada Dokumen</h5>
          <p class="text-muted">Tambahkan dokumen yang dibutuhkan untuk program audit ini</p>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDocumentModal">
            <i class="ti ti-plus me-2"></i>Tambah Dokumen
          </button>
        </div>
      @endif
    </div>
  </div>

  <!-- Action Buttons -->
  <div class="d-flex justify-content-between mb-4">
    <a href="{{ route('rkia.program-list') }}" class="btn btn-secondary">
      <i class="ti ti-arrow-left me-2"></i>Kembali
    </a>
    @if($program->documents->count() > 0)
      <a href="{{ route('rkia.program') }}" class="btn btn-success">
        <i class="ti ti-check me-2"></i>Selesai
      </a>
    @endif
  </div>

  <!-- Add Document Modal -->
  <div class="modal fade" id="addDocumentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <i class="ti ti-plus me-2"></i>Tambah Dokumen yang Dibutuhkan
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('audit-program-documents.store', $program) }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Nama Dokumen <span class="text-danger">*</span></label>
              <input type="text" name="document_name" class="form-control" required placeholder="Contoh: Laporan Keuangan Q4 2024">
            </div>
            <div class="mb-3">
              <label class="form-label">Deskripsi</label>
              <textarea name="description" class="form-control" rows="3" placeholder="Jelaskan detail dokumen yang dibutuhkan..."></textarea>
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_mandatory" id="is_mandatory" checked>
                <label class="form-check-label" for="is_mandatory">
                  Dokumen Wajib
                </label>
              </div>
              <small class="text-muted">Centang jika dokumen ini wajib dilengkapi</small>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">
              <i class="ti ti-device-floppy me-2"></i>Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</x-app-layout>
