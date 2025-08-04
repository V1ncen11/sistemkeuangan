<div class="container mt-4">
  <h3 class="mb-4">Transaksi Pembayaran</h3>

  <!-- Pilih Kelas -->
  <div class="mb-3 row">
    <label for="pilihKelas" class="col-sm-2 col-form-label">Pilih Kelas</label>
    <div class="col-sm-4">
      <select class="form-select" id="pilihKelas" onchange="tampilkanKeterangan()">
        <option selected disabled>-- Pilih Kelas --</option>
        <option value="X">Kelas X</option>
        <option value="XI">Kelas XI</option>
        <option value="XII">Kelas XII</option>
      </select>
    </div>
  </div>

  <!-- Keterangan kelas -->
  <div id="keteranganKelas" class="alert alert-info d-none" role="alert">
    Kelas yang dipilih: <strong id="kelasTerpilih"></strong>
  </div>

  <!-- Tabel Siswa -->
  <div class="table-responsive mt-4">
    <table class="table table-bordered table-striped">
      <thead class="table-dark text-center">
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>NIS</th>
          <th>Jenis Kelamin</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <tr>
          <td>1</td>
          <td>Rudi Haryanto</td>
          <td>23001</td>
          <td>Laki-laki</td>
          <td>
            <button class="btn btn-sm btn-success" onclick="tampilkanForm('23001', 'Rudi Haryanto')">Bayar</button>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>Siti Aminah</td>
          <td>23002</td>
          <td>Perempuan</td>
          <td>
            <button class="btn btn-sm btn-success" onclick="tampilkanForm('23002', 'Siti Aminah')">Bayar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Form Pembayaran -->
<div class="modal fade" id="modalPembayaran" tabindex="-1" aria-labelledby="modalPembayaranLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form>
        <div class="modal-header">
          <h5 class="modal-title" id="modalPembayaranLabel">Form Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nis" class="form-label">NIS</label>
            <input type="text" class="form-control" id="nis" readonly>
          </div>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" readonly>
          </div>
          <div class="mb-3">
            <label for="jenisPembayaran" class="form-label">Jenis Pembayaran</label>
            <select class="form-select" id="jenisPembayaran" onchange="hitungSisa()">
              <option value="" selected disabled>-- Pilih Jenis Pembayaran --</option>
              <option value="spp">SPP Bulanan</option>
              <option value="bangunan">Uang Bangunan</option>
              <option value="ujian">Ujian Akhir</option>
            </select>
          </div>

          <!-- Info tagihan -->
          <div id="infoTagihan" class="d-none">
            <div class="mb-2">
              <label class="form-label">Total Tagihan</label>
              <input type="text" class="form-control" id="totalTagihan" readonly>
            </div>
            <div class="mb-2">
              <label class="form-label">Sudah Dibayar</label>
              <input type="text" class="form-control" id="sudahDibayar" readonly>
            </div>
            <div class="mb-2">
              <label class="form-label">Sisa Tagihan</label>
              <input type="text" class="form-control" id="sisaTagihan" readonly>
            </div>
          </div>

          <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Bayar Saat Ini</label>
            <input type="number" class="form-control" id="jumlah" placeholder="Masukkan nominal pembayaran">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function tampilkanForm(nis, nama) {
    document.getElementById("nis").value = nis;
    document.getElementById("nama").value = nama;
    document.getElementById("jenisPembayaran").value = "";
    document.getElementById("jumlah").value = "";

    document.getElementById("infoTagihan").classList.add("d-none");
    const modal = new bootstrap.Modal(document.getElementById('modalPembayaran'));
    modal.show();
  }

  function hitungSisa() {
    const jenis = document.getElementById("jenisPembayaran").value;

    // Simulasi data tagihan dan pembayaran sebelumnya
    let total = 0;
    let sudahBayar = 0;

    if (jenis === "bangunan") {
      total = 200000;
      sudahBayar = 100000;
    } else if (jenis === "spp") {
      total = 50000;
      sudahBayar = 50000;
    } else if (jenis === "ujian") {
      total = 100000;
      sudahBayar = 0;
    }

    // Tampilkan info
    document.getElementById("totalTagihan").value = "Rp " + total.toLocaleString();
    document.getElementById("sudahDibayar").value = "Rp " + sudahBayar.toLocaleString();
    document.getElementById("sisaTagihan").value = "Rp " + (total - sudahBayar).toLocaleString();
    document.getElementById("infoTagihan").classList.remove("d-none");
  }
</script>
