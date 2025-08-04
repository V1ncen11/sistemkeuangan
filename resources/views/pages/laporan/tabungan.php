<div class="container mt-4">
  <h3 class="mb-4">Rekap Tabungan Siswa</h3>

  <!-- Filter dan Aksi -->
  <div class="row mb-3 align-items-end">
    <!-- Filter Kelas -->
    <div class="col-md-3">
      <label for="filterKelas" class="form-label">Filter Kelas</label>
      <select class="form-select" id="filterKelas">
        <option value="semua">Semua Kelas</option>
        <option value="X">Kelas X</option>
        <option value="XI">Kelas XI</option>
        <option value="XII">Kelas XII</option>
      </select>
    </div>

    <!-- Pencarian dan Tombol Tampilkan -->
    <div class="col-md-5">
      <label for="pencarian" class="form-label">Cari Nama Siswa</label>
      <div class="input-group">
        <input type="text" class="form-control" id="pencarian" placeholder="Masukkan nama siswa...">
        <button class="btn btn-primary" onclick="filterRekap()">
          <i class="bi bi-search"></i> Tampilkan
        </button>
      </div>
    </div>

    <!-- Tombol Cetak PDF -->
    <div class="col-md-4 d-flex justify-content-end mt-2">
      <a href="cetak_rekap_tabungan.php" target="_blank" class="btn btn-danger">
        <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
      </a>
    </div>
  </div>

  <!-- Tabel Rekap -->
  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle" id="rekapTabungan">
      <thead class="table-dark text-center">
        <tr>
          <th>No</th>
          <th>Nama Siswa</th>
          <th>Kelas</th>
          <th>Total Tabungan</th>
        </tr>
      </thead>
      <tbody>
        <!-- Contoh data dummy -->
        <tr>
          <td class="text-center">1</td>
          <td>Ahmad Prasetyo</td>
          <td class="text-center">X</td>
          <td class="text-end">Rp 1.200.000</td>
        </tr>
        <tr>
          <td class="text-center">2</td>
          <td>Putri Lestari</td>
          <td class="text-center">XI</td>
          <td class="text-end">Rp 800.000</td>
        </tr>
        <tr>
          <td class="text-center">3</td>
          <td>Budi Hartono</td>
          <td class="text-center">XII</td>
          <td class="text-end">Rp 950.000</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
