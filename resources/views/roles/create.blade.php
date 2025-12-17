<x-app-layout>
  <x-slot name="title">Tambah Role</x-slot>

  <div class="row">
    <div class="col-lg-6 mx-auto">
      <div class="card">
        <div class="card-body">
          <div class="mb-4">
            <a href="{{ route('roles.index') }}" class="btn btn-sm btn-light">
              <i class="ti ti-arrow-left me-2"></i>Kembali
            </a>
          </div>

          <h5 class="card-title fw-semibold mb-4">Form Tambah Role</h5>

          <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="name" class="form-label">Nama Role (Kode) <span class="text-danger">*</span></label>
              <input type="text" name="name" id="name" value="{{ old('name') }}" 
                     class="form-control @error('name') is-invalid @enderror" 
                     placeholder="contoh: auditor" required>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <small class="text-muted">Gunakan huruf kecil tanpa spasi</small>
            </div>

            <div class="mb-3">
              <label for="display_name" class="form-label">Display Name <span class="text-danger">*</span></label>
              <input type="text" name="display_name" id="display_name" value="{{ old('display_name') }}" 
                     class="form-control @error('display_name') is-invalid @enderror" 
                     placeholder="contoh: Auditor" required>
              @error('display_name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Deskripsi</label>
              <textarea name="description" id="description" rows="3" 
                        class="form-control @error('description') is-invalid @enderror" 
                        placeholder="Deskripsi role...">{{ old('description') }}</textarea>
              @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-flex gap-2 justify-content-end">
              <a href="{{ route('roles.index') }}" class="btn btn-light">Batal</a>
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
