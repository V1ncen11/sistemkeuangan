<div class="container mt-4">
  <h3 class="mb-4">Transaksi Pengeluaran</h3>

  <!-- Form Pengeluaran -->
  <div class="card mb-4 shadow-sm">
    <div class="card-body">
      <form>
        <div class="row mb-3">
          <div class="col-md-4">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" required>
          </div>
          <div class="col-md-4">
            <label for="jenisPengeluaran" class="form-label">Jenis Pengeluaran</label>
            <select class="form-select" id="jenisPengeluaran" required>
              <option selected disabled>-- Pilih Jenis --</option>
              <option value="kas">Dari KAS</option>
              <option value="Penerimaan">Dari Penerimaan</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="jumlah" class="form-label">Jumlah (Rp)</label>
            <input type="number" class="form-control" id="jumlah" placeholder="Masukkan nominal" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="keterangan" class="form-label">Keterangan</label>
          <textarea class="form-control" id="keterangan" rows="2" placeholder="Contoh: Pembelian buku administrasi"></textarea>
        </div>
        <div class="text-end">
          <button type="submit" class="btn btn-primary">Simpan Pengeluaran</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Riwayat Pengeluaran -->
  <h5 class="mb-3">Riwayat Pengeluaran</h5>
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-dark text-center">
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Jenis</th>
          <th>Jumlah</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <tr>
          <td>1</td>
          <td>2025-07-15</td>
          <td>Dari Kas</td>
          <td>1.000.000</td>
          <td>Gaji bulanan guru honorer</td>
        </tr>
        <tr>
          <td>2</td>
          <td>2025-07-18</td>
          <td>Dari Penerimaan</td>
          <td>300.000</td>
          <td>Tagihan listrik bulan Juli</td>
        </tr>
        <!-- Tambahkan data dinamis dari backend -->
      </tbody>
    </table>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
