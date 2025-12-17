<x-app-layout>
  <x-slot name="title">Tambah User</x-slot>

  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="card">
        <div class="card-body">
          <div class="mb-4">
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-light">
              <i class="ti ti-arrow-left me-2"></i>Kembali
            </a>
          </div>

          <h5 class="card-title fw-semibold mb-4">Form Tambah User</h5>

          <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                       class="form-control @error('name') is-invalid @enderror" required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" 
                       class="form-control @error('username') is-invalid @enderror" required>
                @error('username')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                       class="form-control @error('email') is-invalid @enderror" required>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="employee_id" class="form-label">Employee ID</label>
                <input type="text" name="employee_id" id="employee_id" value="{{ old('employee_id') }}" 
                       class="form-control @error('employee_id') is-invalid @enderror">
                @error('employee_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="department_id" class="form-label">Departemen</label>
                <select name="department_id" id="department_id" class="form-select @error('department_id') is-invalid @enderror">
                  <option value="">-- Pilih Departemen --</option>
                  @php
                    $departments = \App\Models\Department::where('is_active', true)->orderBy('name')->get();
                  @endphp
                  @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                      {{ $dept->code }} - {{ $dept->name }}
                    </option>
                  @endforeach
                </select>
                @error('department_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="position" class="form-label">Posisi</label>
                <input type="text" name="position" id="position" value="{{ old('position') }}" 
                       class="form-control @error('position') is-invalid @enderror">
                @error('position')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>
                <select name="role_id" id="role_id" class="form-select @error('role_id') is-invalid @enderror" required>
                  <option value="">-- Pilih Role --</option>
                  @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                      {{ $role->display_name }}
                    </option>
                  @endforeach
                </select>
                @error('role_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" id="password" 
                       class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Minimal 8 karakter</small>
              </div>
            </div>

            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" 
                       id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                  User Aktif
                </label>
              </div>
            </div>

            <div class="d-flex gap-2 justify-content-end">
              <a href="{{ route('users.index') }}" class="btn btn-light">Batal</a>
              <button type="submit" class="btn btn-primary">
                <i class="ti ti-check me-2"></i>Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
