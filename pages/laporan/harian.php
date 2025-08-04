<div class="container mt-4">
  <h3 class="mb-4">Laporan Harian</h3>

  <!-- Filter Tanggal -->
  <div class="mb-4 row align-items-center">
  <label for="tanggal" class="col-sm-2 col-form-label">Pilih Tanggal</label>
  <div class="col-sm-4">
    <input type="date" class="form-control" id="tanggal" value="<?= date('Y-m-d') ?>">
  </div>
  <div class="col-sm-6 d-flex gap-2">
    <button class="btn btn-primary">Tampilkan</button>
    <a href="cetak_laporan.php?tanggal=<?= date('Y-m-d') ?>" target="_blank" class="btn btn-danger">
      <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
    </a>
  </div>
</div>

  <!-- Ringkasan Harian -->
  <div class="row mb-4">
    <div class="col-md-4">
      <div class="card border-success">
        <div class="card-body">
          <h6>Total Pemasukan</h6>
          <h5 class="text-success">Rp 2.000.000</h5>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-danger">
        <div class="card-body">
          <h6>Total Pengeluaran</h6>
          <h5 class="text-danger">Rp 500.000</h5>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-primary">
        <div class="card-body">
          <h6>Saldo Akhir</h6>
          <h5 class="text-primary">Rp 1.500.000</h5>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabel Rincian Transaksi -->
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="mb-3">Rincian Transaksi - <span id="tglLaporan">20 Juli 2025</span></h5>
      <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Waktu</th>
              <th>Jenis Transaksi</th>
              <th>Nama</th>
              <th>Keterangan</th>
              <th>Masuk</th>
              <th>Keluar</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>08:10</td>
              <td>Pembayaran</td>
              <td>Ahmad Ramadhan</td>
              <td>Uang Bangunan</td>
              <td>Rp 500.000</td>
              <td>-</td>
            </tr>
            <tr>
              <td>2</td>
              <td>09:30</td>
              <td>Pengeluaran</td>
              <td>Admin</td>
              <td>Beli Buku</td>
              <td>-</td>
              <td>Rp 100.000</td>
            </tr>
            <tr>
              <td>3</td>
              <td>10:00</td>
              <td>Setor Tabungan</td>
              <td>Lisa Permata</td>
              <td>Setoran tabungan</td>
              <td>Rp 200.000</td>
              <td>-</td>
            </tr>
            <!-- Tambah data dinamis di sini -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
