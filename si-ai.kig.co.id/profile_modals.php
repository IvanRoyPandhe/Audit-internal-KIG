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
          <img src="assets/images/profile/user1.jpg" alt="Profile" class="rounded-circle" width="80" height="80">
        </div>
        <div class="mb-3">
          <label class="form-label">Nama</label>
          <input type="text" class="form-control" value="Admin User" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" value="admin@kig.co.id" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Role</label>
          <input type="text" class="form-control" value="Administrator" readonly>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary">Edit Profil</button>
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
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Password Lama</label>
          <input type="password" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Password Baru</label>
          <input type="password" class="form-control">
        </div>
        <div class="mb-3">
          <label class="form-label">Konfirmasi Password Baru</label>
          <input type="password" class="form-control">
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="notifications">
          <label class="form-check-label" for="notifications">
            Terima notifikasi email
          </label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>