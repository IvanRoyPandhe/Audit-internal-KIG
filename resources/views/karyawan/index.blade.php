@extends('layouts.app')

@section('title', 'Daftar Karyawan')

@section('content')
<div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Daftar Karyawan</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Karyawan</li>
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

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <iconify-icon icon="solar:users-group-rounded-bold-duotone" class="fs-8 text-primary"></iconify-icon>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Total Karyawan</h6>
                            <h3 class="mb-0 fw-semibold">{{ $karyawan->total() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <iconify-icon icon="solar:check-circle-bold-duotone" class="fs-8 text-success"></iconify-icon>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Aktif</h6>
                            <h3 class="mb-0 fw-semibold">{{ $karyawan->where('is_active', 1)->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <iconify-icon icon="solar:buildings-2-bold-duotone" class="fs-8 text-info"></iconify-icon>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Departemen</h6>
                            <h3 class="mb-0 fw-semibold">{{ $karyawan->pluck('department')->unique()->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <iconify-icon icon="solar:shield-user-bold-duotone" class="fs-8 text-warning"></iconify-icon>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Roles</h6>
                            <h3 class="mb-0 fw-semibold">{{ $karyawan->pluck('role_id')->unique()->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Karyawan Table -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title fw-semibold">Data Karyawan</h5>
                <div class="d-flex gap-2">
                    <form action="{{ route('karyawan.index') }}" method="GET" class="d-flex gap-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari karyawan..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-search"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Departemen</th>
                            <th>Jabatan</th>
                            <th>Role</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($karyawan as $index => $employee)
                        <tr>
                            <td>{{ $karyawan->firstItem() + $index }}</td>
                            <td>
                                <span class="badge bg-light-primary text-primary">
                                    {{ $employee->employee_id ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <div class="rounded-circle bg-light-info text-info d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <span class="fw-semibold">{{ strtoupper(substr($employee->name, 0, 2)) }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $employee->name }}</h6>
                                        <small class="text-muted">{{ $employee->username }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $employee->email }}</td>
                            <td>
                                @if($employee->departmentRelation)
                                    <span class="badge bg-light-info text-info">
                                        {{ $employee->departmentRelation->name }}
                                    </span>
                                @elseif($employee->department)
                                    <span class="badge bg-light-secondary text-secondary">
                                        {{ $employee->department }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $employee->position ?? '-' }}</td>
                            <td>
                                <span class="badge bg-light-{{ $employee->role->name === 'admin' ? 'danger' : ($employee->role->name === 'auditor' ? 'warning' : 'success') }} text-{{ $employee->role->name === 'admin' ? 'danger' : ($employee->role->name === 'auditor' ? 'warning' : 'success') }}">
                                    {{ ucfirst($employee->role->name) }}
                                </span>
                            </td>
                            <td>
                                @if($employee->is_active)
                                    <span class="badge bg-success-subtle text-success">
                                        <i class="ti ti-check"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger">
                                        <i class="ti ti-x"></i> Nonaktif
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <iconify-icon icon="solar:inbox-line-duotone" class="fs-8 text-muted"></iconify-icon>
                                <p class="text-muted mb-0 mt-2">Tidak ada data karyawan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Menampilkan {{ $karyawan->firstItem() ?? 0 }} - {{ $karyawan->lastItem() ?? 0 }} dari {{ $karyawan->total() }} karyawan
                </div>
                <div>
                    {{ $karyawan->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
