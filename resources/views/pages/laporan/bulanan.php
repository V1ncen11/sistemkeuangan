<div class="container mt-4">
  <h3 class="mb-4">Laporan Bulanan</h3>

  <div class="row mb-4 align-items-end">
    <!-- Pilih Bulan -->
    <div class="col-md-3">
      <label for="bulan" class="form-label">Bulan</label>
      <select class="form-select" id="bulan">
        <option value="01">Januari</option>
        <option value="02">Februari</option>
        <option value="03">Maret</option>
        <option value="04">April</option>
        <option value="05">Mei</option>
        <option value="06">Juni</option>
        <option value="07">Juli</option>
        <option value="08">Agustus</option>
        <option value="09">September</option>
        <option value="10">Oktober</option>
        <option value="11">November</option>
        <option value="12">Desember</option>
      </select>
    </div>

    <!-- Pilih Tahun -->
    <div class="col-md-3">
      <label for="tahun" class="form-label">Tahun</label>
      <select class="form-select" id="tahun">
        <?php
          $tahunSekarang = date('Y');
          for ($i = $tahunSekarang; $i >= $tahunSekarang - 10; $i--) {
            echo "<option value='$i'>$i</option>";
          }
        ?>
      </select>
    </div>

    <!-- Tombol Aksi -->
    <div class="col-md-6 d-flex gap-2">
      <button class="btn btn-primary" onclick="tampilkanLaporan()">Tampilkan</button>
      <a id="cetakPdfBtn" class="btn btn-danger" target="_blank">
        <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
      </a>
    </div>
  </div>

  <!-- Tempat hasil laporan -->
  <div id="hasilLaporan">
    <!-- Tabel atau data laporan akan ditampilkan di sini -->
  </div>
</div>
