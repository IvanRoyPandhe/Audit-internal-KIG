<x-app-layout>
  <x-slot name="title">Buat Program Audit</x-slot>

  <!-- Header -->
  <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Buat Program Audit</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('rkia.program') }}">Program Kerja Audit</a></li>
              <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('rkia.program-list') }}">Daftar Program</a></li>
              <li class="breadcrumb-item active" aria-current="page">Buat Program</li>
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

  <!-- Timeline Info -->
  <div class="card mb-4">
    <div class="card-body">
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
            <span class="badge bg-info">Tahun {{ $timeline->audit_year }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Form -->
  <form action="{{ route('audit-programs.store', $timeline) }}" method="POST" id="programForm">
    @csrf

    <!-- Informasi Program -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">
          <i class="ti ti-clipboard-list me-2"></i>Informasi Program Audit
        </h5>

        <div class="row">
          <div class="col-md-12 mb-3">
            <label for="program_name" class="form-label">Nama Program Audit <span class="text-danger">*</span></label>
            <input 
              type="text" 
              class="form-control @error('program_name') is-invalid @enderror" 
              id="program_name" 
              name="program_name" 
              value="{{ old('program_name') }}"
              placeholder="Contoh: Audit Sistem Manajemen Mutu ISO 9001"
              required
            >
            @error('program_name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-12 mb-3">
            <label for="description" class="form-label">Deskripsi Program</label>
            <textarea 
              class="form-control @error('description') is-invalid @enderror" 
              id="description" 
              name="description" 
              rows="3"
              placeholder="Jelaskan deskripsi singkat program audit..."
            >{{ old('description') }}</textarea>
            @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-12 mb-3">
            <label for="audit_objective" class="form-label">Tujuan Audit <span class="text-danger">*</span></label>
            <textarea 
              class="form-control @error('audit_objective') is-invalid @enderror" 
              id="audit_objective" 
              name="audit_objective" 
              rows="4"
              placeholder="Jelaskan tujuan audit secara detail..."
              required
            >{{ old('audit_objective') }}</textarea>
            @error('audit_objective')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="text-muted">Contoh: Memastikan kepatuhan terhadap standar ISO 9001:2015, mengevaluasi efektivitas sistem manajemen mutu</small>
          </div>

          <div class="col-md-12 mb-3">
            <label for="assurance_scope" class="form-label">Untuk Memastikan <span class="text-danger">*</span></label>
            <textarea 
              class="form-control @error('assurance_scope') is-invalid @enderror" 
              id="assurance_scope" 
              name="assurance_scope" 
              rows="4"
              placeholder="Jelaskan scope assurance yang ingin dipastikan..."
              required
            >{{ old('assurance_scope') }}</textarea>
            @error('assurance_scope')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="text-muted">Contoh: Proses operasional berjalan sesuai SOP, dokumentasi lengkap dan terkini, tidak ada temuan major</small>
          </div>
        </div>
      </div>
    </div>

    <!-- Tim Auditor -->
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">
          <i class="ti ti-users me-2"></i>Tim Auditor / Pelaksana
        </h5>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="team_leader_id" class="form-label">Ketua Tim <span class="text-danger">*</span></label>
            <select 
              class="form-select @error('team_leader_id') is-invalid @enderror" 
              id="team_leader_id" 
              name="team_leader_id"
              required
            >
              <option value="">Pilih Ketua Tim</option>
              @php
                $auditors = \App\Models\User::whereHas('role', function($q) {
                    $q->whereIn('name', ['admin', 'auditor']);
                })->get();
              @endphp
              @foreach($auditors as $auditor)
                <option value="{{ $auditor->id }}" {{ old('team_leader_id') == $auditor->id ? 'selected' : '' }}>
                  {{ $auditor->name }} - {{ $auditor->position ?? 'Auditor' }}
                </option>
              @endforeach
            </select>
            @error('team_leader_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6 mb-3">
            <label for="team_members" class="form-label">Anggota Tim</label>
            <select 
              class="form-select @error('team_members') is-invalid @enderror" 
              id="team_members" 
              name="team_members[]"
              multiple
              size="5"
            >
              @foreach($auditors as $auditor)
                <option value="{{ $auditor->id }}" {{ in_array($auditor->id, old('team_members', [])) ? 'selected' : '' }}>
                  {{ $auditor->name }} - {{ $auditor->position ?? 'Auditor' }}
                </option>
              @endforeach
            </select>
            @error('team_members')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="text-muted">Tekan Ctrl/Cmd untuk memilih multiple anggota</small>
          </div>
        </div>
      </div>
    </div>

    <!-- Risiko (Dynamic List) -->
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="card-title fw-semibold mb-0">
            <i class="ti ti-alert-triangle me-2"></i>Identifikasi Risiko
          </h5>
          <button type="button" class="btn btn-primary btn-sm" onclick="addRisk()">
            <i class="ti ti-plus me-1"></i>Tambah Risiko
          </button>
        </div>

        <div id="riskContainer">
          <!-- Risk items will be added here -->
          <div class="risk-item mb-3 p-3 border rounded" data-index="0">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <h6 class="mb-0">Risiko #1</h6>
              <button type="button" class="btn btn-sm btn-danger" onclick="removeRisk(0)" style="display: none;">
                <i class="ti ti-trash"></i>
              </button>
            </div>
            <div class="row">
              <div class="col-md-8 mb-2">
                <label class="form-label">Nama Risiko <span class="text-danger">*</span></label>
                <input 
                  type="text" 
                  class="form-control" 
                  name="risks[0][name]" 
                  placeholder="Contoh: Ketidaksesuaian dengan standar ISO 9001"
                  required
                >
              </div>
              <div class="col-md-4 mb-2">
                <label class="form-label">Level Risiko <span class="text-danger">*</span></label>
                <select class="form-select" name="risks[0][level]" required>
                  <option value="">Pilih Level</option>
                  <option value="low">🟢 Low - Rendah</option>
                  <option value="medium">🟡 Medium - Sedang</option>
                  <option value="high">🟠 High - Tinggi</option>
                  <option value="critical">🔴 Critical - Kritis</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        @error('risks')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>
    </div>

    <!-- Info Box -->
    <div class="alert alert-info mb-4" role="alert">
      <div class="d-flex">
        <i class="ti ti-info-circle me-2 fs-5"></i>
        <div>
          <h6 class="alert-heading mb-2">Informasi:</h6>
          <ul class="mb-0 ps-3">
            <li>Kode program akan digenerate otomatis: <strong>{{ strtoupper($timeline->department->code) }}-{{ $timeline->audit_year }}-XXXX</strong></li>
            <li>Periode audit akan mengikuti timeline: <strong>{{ $timeline->start_date->format('d M Y') }} - {{ $timeline->end_date->format('d M Y') }}</strong></li>
            <li>Anda dapat menambahkan <strong>lebih dari satu risiko</strong> dengan klik tombol "Tambah Risiko"</li>
            <li>Setelah program dibuat, Anda dapat menambahkan <strong>dokumen yang dibutuhkan</strong></li>
            <li>Status awal program adalah <strong>Draft</strong></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-between mb-4">
      <a href="{{ route('rkia.program-list') }}" class="btn btn-secondary">
        <i class="ti ti-arrow-left me-2"></i>Kembali
      </a>
      <button type="submit" class="btn btn-primary btn-lg">
        <i class="ti ti-device-floppy me-2"></i>Simpan Program Audit
      </button>
    </div>
  </form>

  <script>
    let riskIndex = 1;

    function addRisk() {
      const container = document.getElementById('riskContainer');
      const newRisk = document.createElement('div');
      newRisk.className = 'risk-item mb-3 p-3 border rounded';
      newRisk.setAttribute('data-index', riskIndex);
      newRisk.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-2">
          <h6 class="mb-0">Risiko #${riskIndex + 1}</h6>
          <button type="button" class="btn btn-sm btn-danger" onclick="removeRisk(${riskIndex})">
            <i class="ti ti-trash"></i>
          </button>
        </div>
        <div class="row">
          <div class="col-md-8 mb-2">
            <label class="form-label">Nama Risiko <span class="text-danger">*</span></label>
            <input 
              type="text" 
              class="form-control" 
              name="risks[${riskIndex}][name]" 
              placeholder="Contoh: Ketidaksesuaian dengan standar ISO 9001"
              required
            >
          </div>
          <div class="col-md-4 mb-2">
            <label class="form-label">Level Risiko <span class="text-danger">*</span></label>
            <select class="form-select" name="risks[${riskIndex}][level]" required>
              <option value="">Pilih Level</option>
              <option value="low">🟢 Low - Rendah</option>
              <option value="medium">🟡 Medium - Sedang</option>
              <option value="high">🟠 High - Tinggi</option>
              <option value="critical">🔴 Critical - Kritis</option>
            </select>
          </div>
        </div>
      `;
      container.appendChild(newRisk);
      riskIndex++;
      
      // Show delete button on first item if more than one risk
      updateDeleteButtons();
    }

    function removeRisk(index) {
      const riskItem = document.querySelector(`.risk-item[data-index="${index}"]`);
      if (riskItem) {
        riskItem.remove();
        updateDeleteButtons();
        updateRiskNumbers();
      }
    }

    function updateDeleteButtons() {
      const riskItems = document.querySelectorAll('.risk-item');
      riskItems.forEach((item, idx) => {
        const deleteBtn = item.querySelector('.btn-danger');
        if (deleteBtn) {
          deleteBtn.style.display = riskItems.length > 1 ? 'inline-block' : 'none';
        }
      });
    }

    function updateRiskNumbers() {
      const riskItems = document.querySelectorAll('.risk-item');
      riskItems.forEach((item, idx) => {
        const title = item.querySelector('h6');
        if (title) {
          title.textContent = `Risiko #${idx + 1}`;
        }
      });
    }
  </script>

</x-app-layout>
