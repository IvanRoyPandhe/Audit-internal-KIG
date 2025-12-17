<x-app-layout>
  <x-slot name="title">Manajemen Roles</x-slot>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h5 class="card-title fw-semibold mb-2">Daftar Roles</h5>
              <p class="text-muted mb-0">Kelola role dan permission pengguna</p>
            </div>
            <a href="{{ route('roles.create') }}" class="btn btn-primary">
              <i class="ti ti-plus me-2"></i>Tambah Role
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

          <div class="row">
            @forelse($roles as $role)
            <div class="col-md-4 mb-3">
              <div class="card border">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="bg-primary bg-opacity-10 rounded p-3">
                      <i class="ti ti-shield-check text-primary fs-5"></i>
                    </div>
                    <span class="badge bg-info">{{ $role->users_count }} Users</span>
                  </div>
                  <h5 class="card-title mb-2">{{ $role->display_name }}</h5>
                  <p class="text-muted small mb-3">{{ $role->description ?? 'Tidak ada deskripsi' }}</p>
                  <div class="d-flex gap-2">
                    <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-warning flex-fill">
                      <i class="ti ti-edit me-1"></i>Edit
                    </a>
                    <form action="{{ route('roles.destroy', $role) }}" method="POST" class="flex-fill" onsubmit="return confirm('Yakin ingin menghapus role ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger w-100">
                        <i class="ti ti-trash me-1"></i>Hapus
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            @empty
            <div class="col-12">
              <div class="text-center py-5">
                <i class="ti ti-shield-off" style="font-size: 48px; color: #ccc;"></i>
                <p class="text-muted mt-2">Belum ada role</p>
              </div>
            </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
