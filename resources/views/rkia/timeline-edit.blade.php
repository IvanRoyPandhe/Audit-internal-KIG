<x-app-layout>
  <x-slot name="title">Edit Timeline Audit</x-slot>

  <div class="row">
    <div class="col-lg-10 mx-auto">
      <div class="card">
        <div class="card-body">
          <div class="mb-4 d-flex justify-content-between align-items-center">
            <a href="{{ route('rkia.timeline', $year) }}" class="btn btn-sm btn-light">
              <i class="ti ti-arrow-left me-2"></i>Kembali
            </a>
            <span class="badge bg-primary fs-5">Tahun {{ $year }}</span>
          </div>

          <h5 class="card-title fw-semibold mb-4">
            <i class="ti ti-calendar-edit me-2"></i>Edit Timeline Audit - {{ $timeline->department->name }}
          </h5>

          <form action="{{ route('rkia.timeline.update', [$year, $timeline]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label for="department_id" class="form-label">Departemen <span class="text-danger">*</span></label>
              <select name="department_id" id="department_id" class="form-select @error('department_id') is-invalid @enderror" required>
                @foreach($departments as $dept)
                  <option value="{{ $dept->id }}" {{ old('department_id', $timeline->department_id) == $dept->id ? 'selected' : '' }}>
                    {{ $dept->code }} - {{ $dept->name }}
                    @if($dept->seniorManager)
                      (SM: {{ $dept->seniorManager->name }})
                    @endif
                  </option>
                @endforeach
              </select>
              @error('department_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Tanggal Rencana Audit -->
            <div class="card mb-4 border-primary">
              <div class="card-header bg-primary text-white">
                <h6 class="mb-0"><i class="ti ti-calendar-event me-2"></i>Tanggal Rencana Audit</h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="start_date" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                    <input type="date" name="start_date" id="start_date" 
                           value="{{ old('start_date', $timeline->start_date->format('Y-m-d')) }}" 
                           class="form-control @error('start_date') is-invalid @enderror" required>
                    @error('start_date')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="end_date" class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                    <input type="date" name="end_date" id="end_date" 
                           value="{{ old('end_date', $timeline->end_date->format('Y-m-d')) }}" 
                           class="form-control @error('end_date') is-invalid @enderror" required>
                    @error('end_date')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>

            <!-- Tanggal Realisasi Audit -->
            <div class="card mb-4 border-success">
              <div class="card-header bg-success text-white">
                <h6 class="mb-0"><i class="ti ti-calendar-check me-2"></i>Tanggal Realisasi Audit</h6>
              </div>
              <div class="card-body">
                <div class="alert alert-info" role="alert">
                  <i class="ti ti-info-circle me-2"></i>
                  <strong>Info:</strong> Isi tanggal realisasi jika audit tidak berjalan sesuai jadwal rencana.
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="actual_start_date" class="form-label">Tanggal Mulai Realisasi</label>
                    <input type="date" name="actual_start_date" id="actual_start_date" 
                           value="{{ old('actual_start_date', $timeline->actual_start_date?->format('Y-m-d')) }}" 
                           class="form-control @error('actual_start_date') is-invalid @enderror">
                    @error('actual_start_date')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Kosongkan jika sesuai rencana</small>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="actual_end_date" class="form-label">Tanggal Selesai Realisasi</label>
                    <input type="date" name="actual_end_date" id="actual_end_date" 
                           value="{{ old('actual_end_date', $timeline->actual_end_date?->format('Y-m-d')) }}" 
                           class="form-control @error('actual_end_date') is-invalid @enderror">
                    @error('actual_end_date')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Kosongkan jika sesuai rencana</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="status" class="form-label">Status Timeline <span class="text-danger">*</span></label>
              <select name="status" id="status" class="form-select" required>
                <option value="scheduled" {{ old('status', $timeline->status) == 'scheduled' ? 'selected' : '' }}>Terjadwal</option>
                <option value="ongoing" {{ old('status', $timeline->status) == 'ongoing' ? 'selected' : '' }}>Berjalan</option>
                <option value="completed" {{ old('status', $timeline->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ old('status', $timeline->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="notes" class="form-label">Catatan</label>
              <textarea name="notes" id="notes" rows="3" 
                        class="form-control @error('notes') is-invalid @enderror" 
                        placeholder="Catatan tambahan untuk timeline ini...">{{ old('notes', $timeline->notes) }}</textarea>
              @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" 
                       id="is_active" {{ old('is_active', $timeline->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                  Timeline Aktif (Departemen mendapat jadwal audit)
                </label>
              </div>
              <small class="text-muted">Hanya timeline aktif yang akan muncul di Program Audit</small>
            </div>

            <div class="d-flex gap-2 justify-content-end">
              <a href="{{ route('rkia.timeline', $year) }}" class="btn btn-light">Batal</a>
              <button type="submit" class="btn btn-primary">
                <i class="ti ti-check me-2"></i>Update Timeline
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
