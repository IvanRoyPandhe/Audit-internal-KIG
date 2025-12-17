<x-app-layout>
  <x-slot name="title">Edit Departemen</x-slot>

  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="card">
        <div class="card-body">
          <div class="mb-4">
            <a href="{{ route('departments.index') }}" class="btn btn-sm btn-light">
              <i class="ti ti-arrow-left me-2"></i>Kembali
            </a>
          </div>

          <h5 class="card-title fw-semibold mb-4">Form Edit Departemen</h5>

          <form action="{{ route('departments.update', $department) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="code" class="form-label">Kode Departemen <span class="text-danger">*</span></label>
                <input type="text" name="code" id="code" value="{{ old('code', $department->code) }}" 
                       class="form-control @error('code') is-invalid @enderror" required>
                @error('code')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nama Departemen <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $department->name) }}" 
                       class="form-control @error('name') is-invalid @enderror" required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Deskripsi</label>
              <textarea name="description" id="description" rows="3" 
                        class="form-control @error('description') is-invalid @enderror">{{ old('description', $department->description) }}</textarea>
              @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="sm_user_id" class="form-label">Senior Manager (SM)</label>
              <select name="sm_user_id" id="sm_user_id" class="form-select @error('sm_user_id') is-invalid @enderror">
                <option value="">-- Pilih Senior Manager --</option>
                @foreach($users as $user)
                  <option value="{{ $user->id }}" {{ old('sm_user_id', $department->sm_user_id) == $user->id ? 'selected' : '' }}>
                    {{ $user->name }} ({{ $user->email }}) - {{ $user->role->display_name }}
                  </option>
                @endforeach
              </select>
              @error('sm_user_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" 
                       id="is_active" {{ old('is_active', $department->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                  Departemen Aktif
                </label>
              </div>
            </div>

            <div class="d-flex gap-2 justify-content-end">
              <a href="{{ route('departments.index') }}" class="btn btn-light">Batal</a>
              <button type="submit" class="btn btn-primary">
                <i class="ti ti-check me-2"></i>Update Departemen
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
