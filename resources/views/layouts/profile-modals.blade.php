<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Profil Pengguna</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
          <img src="{{ asset('assets/images/profile/user1.jpg') }}" alt="Profile" class="rounded-circle" width="80" height="80">
        </div>
        <div class="mb-3">
          <label class="form-label">Nama</label>
          <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Role</label>
          <input type="text" class="form-control" value="{{ Auth::user()->role->display_name }}" readonly>
        </div>
        @if(Auth::user()->department)
        <div class="mb-3">
          <label class="form-label">Departemen</label>
          <input type="text" class="form-control" value="{{ Auth::user()->department }}" readonly>
        </div>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profil</a>
      </div>
    </div>
  </div>
</div>

<!-- Account Modal -->
<div class="modal fade" id="accountModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pengaturan Akun</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Password Lama</label>
            <input type="password" name="current_password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password Baru</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
