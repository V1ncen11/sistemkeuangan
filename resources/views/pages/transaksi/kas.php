<div class="container mt-4">
  <h3 class="mb-4">Manajemen KAS</h3>

  <!-- Total Kas Tersedia -->
  <div class="row mb-4">
    <div class="col-md-4">
      <div class="card text-white bg-success shadow">
        <div class="card-body">
          <h5 class="card-title">Total KAS Tersedia</h5>
          <h3 class="card-text">Rp 10.000.000</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Form Tambah Kas -->
  <div class="card mb-4 shadow-sm">
    <div class="card-body">
      <h5 class="mb-3">Tambah Kas</h5>
      <form>
        <div class="row mb-3">
          <div class="col-md-4">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" required>
          </div>
          <div class="col-md-4">
            <label for="jumlah" class="form-label">Jumlah (Rp)</label>
            <input type="number" class="form-control" id="jumlah" placeholder="Contoh: 500000" required>
          </div>
          <div class="col-md-4">
            <label for="sumber" class="form-label">Sumber Dana</label>
            <input type="text" class="form-control" id="sumber" placeholder="Contoh: Sumbangan Komite" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="keterangan" class="form-label">Keterangan</label>
          <textarea class="form-control" id="keterangan" rows="2" placeholder="Contoh: Dana tambahan dari wali murid"></textarea>
        </div>
        <div class="text-end">
          <button type="submit" class="btn btn-primary">Tambah Kas</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Riwayat Penambahan Kas -->
  <h5 class="mb-3">Riwayat Kas Masuk</h5>
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-dark text-center">
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Jumlah</th>
          <th>Sumber</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <tr>
          <td>1</td>
          <td>2025-07-01</td>
          <td>Rp 1.000.000</td>
          <td>Komite Sekolah</td>
          <td>Donasi untuk operasional</td>
        </tr>
        <tr>
          <td>2</td>
          <td>2025-07-10</td>
          <td>Rp 500.000</td>
          <td>Wali Murid</td>
          <td>Tambahan kas kelas XII</td>
        </tr>
        <!-- Tambahkan data dinamis dari backend -->
      </tbody>
    </table>
  </div>
</div>
