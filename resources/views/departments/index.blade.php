<x-app-layout>
  <x-slot name="title">Manajemen Departemen</x-slot>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h5 class="card-title fw-semibold mb-2">Daftar Departemen</h5>
              <p class="text-muted mb-0">Kelola departemen dan assign Senior Manager</p>
            </div>
            <a href="{{ route('departments.create') }}" class="btn btn-primary">
              <i class="ti ti-plus me-2"></i>Tambah Departemen
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

          <div class="table-responsive">
            <table class="table table-hover align-middle">
              <thead class="table-light">
                <tr>
                  <th>Kode</th>
                  <th>Nama Departemen</th>
                  <th>Senior Manager</th>
                  <th>Jumlah User</th>
                  <th>Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($departments as $department)
                <tr>
                  <td>
                    <span class="badge bg-primary">{{ $department->code }}</span>
                  </td>
                  <td>
                    <div>
                      <h6 class="mb-0">{{ $department->name }}</h6>
                      @if($department->description)
                        <small class="text-muted">{{ Str::limit($department->description, 50) }}</small>
                      @endif
                    </div>
                  </td>
                  <td>
                    @if($department->seniorManager)
                      <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                          <i class="ti ti-user text-info"></i>
                        </div>
                        <div>
                          <small class="d-block fw-semibold">{{ $department->seniorManager->name }}</small>
                          <small class="text-muted">{{ $department->seniorManager->email }}</small>
                        </div>
                      </div>
                    @else
                      <span class="text-muted">-</span>
                    @endif
                  </td>
                  <td>
                    <span class="badge bg-info">{{ $department->users_count }} user</span>
                  </td>
                  <td>
                    @if($department->is_active)
                      <span class="badge bg-success">Aktif</span>
                    @else
                      <span class="badge bg-secondary">Tidak Aktif</span>
                    @endif
                  </td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <a href="{{ route('departments.show', $department) }}" class="btn btn-sm btn-info" title="Detail">
                        <i class="ti ti-eye"></i>
                      </a>
                      <a href="{{ route('departments.edit', $department) }}" class="btn btn-sm btn-warning" title="Edit">
                        <i class="ti ti-edit"></i>
                      </a>
                      <form action="{{ route('departments.destroy', $department) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus departemen ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                          <i class="ti ti-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-center py-5">
                    <i class="ti ti-building" style="font-size: 48px; color: #ccc;"></i>
                    <p class="text-muted mt-2">Belum ada departemen</p>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          @if($departments->hasPages())
            <div class="mt-4">
              {{ $departments->links() }}
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
