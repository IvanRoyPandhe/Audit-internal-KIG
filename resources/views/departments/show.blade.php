<x-app-layout>
  <x-slot name="title">Detail Departemen</x-slot>

  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-semibold mb-0">Informasi Departemen</h5>
            <a href="{{ route('departments.edit', $department) }}" class="btn btn-sm btn-warning">
              <i class="ti ti-edit"></i>
            </a>
          </div>

          <div class="mb-3">
            <label class="text-muted small">Kode</label>
            <p class="fw-semibold">{{ $department->code }}</p>
          </div>

          <div class="mb-3">
            <label class="text-muted small">Nama Departemen</label>
            <p class="fw-semibold">{{ $department->name }}</p>
          </div>

          @if($department->description)
          <div class="mb-3">
            <label class="text-muted small">Deskripsi</label>
            <p>{{ $department->description }}</p>
          </div>
          @endif

          <div class="mb-3">
            <label class="text-muted small">Status</label>
            <div>
              @if($department->is_active)
                <span class="badge bg-success">Aktif</span>
              @else
                <span class="badge bg-secondary">Tidak Aktif</span>
              @endif
            </div>
          </div>

          <div class="mb-3">
            <label class="text-muted small">Senior Manager</label>
            @if($department->seniorManager)
              <div class="d-flex align-items-center mt-2">
                <div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                  <i class="ti ti-user text-info"></i>
                </div>
                <div>
                  <p class="mb-0 fw-semibold">{{ $department->seniorManager->name }}</p>
                  <small class="text-muted">{{ $department->seniorManager->email }}</small>
                </div>
              </div>
            @else
              <p class="text-muted">Belum ditentukan</p>
            @endif
          </div>

          <div class="mb-3">
            <label class="text-muted small">Dibuat</label>
            <p>{{ $department->created_at->format('d M Y H:i') }}</p>
          </div>

          <div class="d-flex gap-2">
            <a href="{{ route('departments.index') }}" class="btn btn-light flex-fill">
              <i class="ti ti-arrow-left me-2"></i>Kembali
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Daftar User ({{ $department->users->count() }})</h5>

          @if($department->users->count() > 0)
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="table-light">
                  <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($department->users as $user)
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                          <span class="text-primary fw-bold small">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                        </div>
                        <div>
                          <p class="mb-0 fw-semibold">{{ $user->name }}</p>
                          @if($user->is_department_head)
                            <span class="badge bg-info badge-sm">SM</span>
                          @endif
                        </div>
                      </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                      <span class="badge bg-info">{{ $user->role->display_name }}</span>
                    </td>
                    <td>
                      @if($user->is_active)
                        <span class="badge bg-success">Aktif</span>
                      @else
                        <span class="badge bg-secondary">Nonaktif</span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="text-center py-5">
              <i class="ti ti-users" style="font-size: 48px; color: #ccc;"></i>
              <p class="text-muted mt-2">Belum ada user di departemen ini</p>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
