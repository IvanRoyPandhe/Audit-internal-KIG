<x-app-layout>
  <x-slot name="title">Manajemen Users</x-slot>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h5 class="card-title fw-semibold mb-2">Daftar Users</h5>
              <p class="text-muted mb-0">Kelola akun pengguna sistem</p>
            </div>
            <a href="{{ route('users.create') }}" class="btn btn-primary">
              <i class="ti ti-plus me-2"></i>Tambah User
            </a>
          </div>

          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="ti ti-check me-2"></i>{{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <div class="table-responsive">
            <table class="table table-hover align-middle">
              <thead class="table-light">
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Departemen</th>
                  <th>Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($users as $user)
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                        <span class="text-primary fw-bold">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                      </div>
                      <div>
                        <h6 class="mb-0">{{ $user->name }}</h6>
                        @if($user->employee_id)
                          <small class="text-muted">ID: {{ $user->employee_id }}</small>
                        @endif
                      </div>
                    </div>
                  </td>
                  <td>{{ $user->email }}</td>
                  <td>
                    <span class="badge bg-info">{{ $user->role->display_name }}</span>
                  </td>
                  <td>{{ $user->department ?? '-' }}</td>
                  <td>
                    @if($user->is_active)
                      <span class="badge bg-success">Aktif</span>
                    @else
                      <span class="badge bg-secondary">Nonaktif</span>
                    @endif
                  </td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning" title="Edit">
                        <i class="ti ti-edit"></i>
                      </a>
                      @if($user->id !== auth()->id())
                      <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                          <i class="ti ti-trash"></i>
                        </button>
                      </form>
                      @endif
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-center py-5">
                    <i class="ti ti-users" style="font-size: 48px; color: #ccc;"></i>
                    <p class="text-muted mt-2">Belum ada user</p>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          @if($users->hasPages())
            <div class="mt-4">
              {{ $users->links() }}
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
