<x-app-layout>
  <x-slot name="title">Laporan Audit</x-slot>

  <!-- Header -->
  <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Laporan Hasil Audit</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Laporan</li>
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

  <!-- Filter Section -->
  <div class="card mb-4">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-3">
        <i class="ti ti-filter me-2"></i>Filter Laporan
      </h5>
      <div class="row">
        <div class="col-md-3">
          <label class="form-label">Tahun Audit</label>
          <select class="form-select">
            <option value="">Semua Tahun</option>
            <option value="2025" selected>2025</option>
            <option value="2024">2024</option>
            <option value="2023">2023</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">Departemen</label>
          <select class="form-select">
            <option value="">Semua Departemen</option>
            <option value="1">Finance</option>
            <option value="2">HR</option>
            <option value="3">IT</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">Status</label>
          <select class="form-select">
            <option value="">Semua Status</option>
            <option value="completed">Selesai</option>
            <option value="ongoing">Berjalan</option>
            <option value="scheduled">Terjadwal</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">&nbsp;</label>
          <button class="btn btn-primary w-100">
            <i class="ti ti-search me-2"></i>Cari
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Statistics Cards -->
  <div class="row mb-4">
    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <div class="bg-primary rounded-circle p-3">
                <i class="ti ti-file-text text-white fs-5"></i>
              </div>
            </div>
            <div>
              <h6 class="mb-0">Total Laporan</h6>
              <h4 class="mb-0 text-primary">24</h4>
              <small class="text-muted">Tahun 2025</small>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <div class="bg-success rounded-circle p-3">
                <i class="ti ti-check text-white fs-5"></i>
              </div>
            </div>
            <div>
              <h6 class="mb-0">Selesai</h6>
              <h4 class="mb-0 text-success">18</h4>
              <small class="text-success">75%</small>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <div class="bg-warning rounded-circle p-3">
                <i class="ti ti-clock text-white fs-5"></i>
              </div>
            </div>
            <div>
              <h6 class="mb-0">Berjalan</h6>
              <h4 class="mb-0 text-warning">4</h4>
              <small class="text-warning">17%</small>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <div class="bg-info rounded-circle p-3">
                <i class="ti ti-calendar text-white fs-5"></i>
              </div>
            </div>
            <div>
              <h6 class="mb-0">Terjadwal</h6>
              <h4 class="mb-0 text-info">2</h4>
              <small class="text-info">8%</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Laporan List -->
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="card-title fw-semibold mb-0">
          <i class="ti ti-file-report me-2"></i>Daftar Laporan Audit
        </h5>
        <button class="btn btn-success">
          <i class="ti ti-download me-2"></i>Export Excel
        </button>
      </div>

      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th width="5%">No</th>
              <th>Departemen</th>
              <th>Periode Audit</th>
              <th>Jumlah Temuan</th>
              <th width="10%" class="text-center">Status</th>
              <th width="12%" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @php
              $dummyData = [
                ['dept' => 'Finance', 'periode' => '15 Jan - 28 Feb 2025', 'temuan' => 12, 'status' => 'completed', 'color' => 'success'],
                ['dept' => 'Human Resources', 'periode' => '01 Feb - 15 Mar 2025', 'temuan' => 8, 'status' => 'completed', 'color' => 'success'],
                ['dept' => 'IT Department', 'periode' => '10 Mar - 20 Apr 2025', 'temuan' => 15, 'status' => 'ongoing', 'color' => 'warning'],
                ['dept' => 'Operations', 'periode' => '05 Apr - 30 May 2025', 'temuan' => 6, 'status' => 'ongoing', 'color' => 'warning'],
                ['dept' => 'Marketing', 'periode' => '01 Jun - 15 Jul 2025', 'temuan' => 0, 'status' => 'scheduled', 'color' => 'info'],
              ];
            @endphp

            @foreach($dummyData as $index => $data)
            <tr>
              <td class="text-center">{{ $index + 1 }}</td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="bg-primary bg-opacity-10 rounded p-2 me-2">
                    <i class="ti ti-building text-primary"></i>
                  </div>
                  <div>
                    <h6 class="mb-0">{{ $data['dept'] }}</h6>
                    <small class="text-muted">DEPT-{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}</small>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <i class="ti ti-calendar-event me-2 text-primary"></i>
                  <span>{{ $data['periode'] }}</span>
                </div>
              </td>
              <td>
                @if($data['temuan'] > 0)
                  <span class="badge bg-danger-subtle text-danger">
                    <i class="ti ti-alert-circle me-1"></i>{{ $data['temuan'] }} Temuan
                  </span>
                @else
                  <span class="badge bg-light-secondary text-secondary">
                    Belum Ada Data
                  </span>
                @endif
              </td>
              <td class="text-center">
                @if($data['status'] === 'completed')
                  <span class="badge bg-success">Selesai</span>
                @elseif($data['status'] === 'ongoing')
                  <span class="badge bg-warning">Berjalan</span>
                @else
                  <span class="badge bg-info">Terjadwal</span>
                @endif
              </td>
              <td class="text-center">
                <div class="btn-group" role="group">
                  @if($data['status'] === 'completed')
                    <button class="btn btn-sm btn-primary" title="Lihat Laporan">
                      <i class="ti ti-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-success" title="Download PDF">
                      <i class="ti ti-download"></i>
                    </button>
                  @else
                    <button class="btn btn-sm btn-secondary" disabled title="Belum Tersedia">
                      <i class="ti ti-eye-off"></i>
                    </button>
                  @endif
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
          <small class="text-muted">Menampilkan 1-5 dari 5 laporan</small>
        </div>
        <nav>
          <ul class="pagination mb-0">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item disabled">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>

  <!-- Info Box -->
  <div class="alert alert-info mt-4" role="alert">
    <div class="d-flex align-items-center">
      <i class="ti ti-info-circle fs-5 me-2"></i>
      <div>
        <strong>Informasi:</strong> Halaman ini menampilkan data dummy untuk demonstrasi. 
        Fitur laporan lengkap akan dikembangkan sesuai kebutuhan sistem audit internal.
      </div>
    </div>
  </div>

</x-app-layout>
