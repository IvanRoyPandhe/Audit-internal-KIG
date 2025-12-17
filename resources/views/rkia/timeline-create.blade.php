<x-app-layout>
  <x-slot name="title">Buat Timeline Audit</x-slot>

  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="card">
        <div class="card-body">
          <div class="mb-4 d-flex justify-content-between align-items-center">
            <a href="{{ route('rkia.timeline', $year) }}" class="btn btn-sm btn-light">
              <i class="ti ti-arrow-left me-2"></i>Kembali
            </a>
            <span class="badge bg-primary fs-5">Tahun {{ $year }}</span>
          </div>

          <h5 class="card-title fw-semibold mb-4">
            <i class="ti ti-calendar-plus me-2"></i>Buat Timeline Audit Tahun {{ $year }}
          </h5>

          <form action="{{ route('rkia.timeline.store', $year) }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="department_id" class="form-label">Departemen <span class="text-danger">*</span></label>
              <select name="department_id" id="department_id" class="form-select @error('department_id') is-invalid @enderror" required>
                <option value="">-- Pilih Departemen --</option>
                @foreach($departments as $dept)
                  <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
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

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="start_date" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                <input type="date" name="start_date" id="start_date" 
                       value="{{ old('start_date') }}" 
                       class="form-control @error('start_date') is-invalid @enderror" required>
                @error('start_date')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="end_date" class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                <input type="date" name="end_date" id="end_date" 
                       value="{{ old('end_date') }}" 
                       class="form-control @error('end_date') is-invalid @enderror" required>
                @error('end_date')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="mb-3">
              <label for="notes" class="form-label">Catatan</label>
              <textarea name="notes" id="notes" rows="3" 
                        class="form-control @error('notes') is-invalid @enderror" 
                        placeholder="Catatan tambahan untuk timeline ini...">{{ old('notes') }}</textarea>
              @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" 
                       id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                  Timeline Aktif (Departemen mendapat jadwal audit)
                </label>
              </div>
              <small class="text-muted">Hanya timeline aktif yang akan muncul di Program Audit</small>
            </div>

            <div class="alert alert-info" role="alert">
              <i class="ti ti-info-circle me-2"></i>
              <strong>Informasi:</strong> Email notifikasi akan dikirim ke Senior Manager departemen setelah timeline dibuat.
            </div>

            <div class="d-flex gap-2 justify-content-end">
              <a href="{{ route('rkia.timeline', $year) }}" class="btn btn-light">Batal</a>
              <button type="submit" class="btn btn-primary">
                <i class="ti ti-check me-2"></i>Simpan Timeline
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
