<div class="container mt-4">
  <h3 class="mb-4">Tabungan Siswa</h3>

  <!-- Pilih Kelas -->
  <div class="mb-3 row">
    <div class="col-md-4">
      <label for="pilihKelas" class="form-label">Pilih Kelas</label>
      <select class="form-select" id="pilihKelas">
        <option value="x">X</option>
        <option value="xi">XI</option>
        <option value="xii">XII</option>
      </select>
    </div>
  </div>

  <!-- Modal Setor Tabungan -->
<div class="modal fade" id="modalSetor" tabindex="-1" aria-labelledby="modalSetorLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Setor Tabungan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nama Siswa</label>
          <input type="text" class="form-control" value="Ahmad Ramadhan" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Jumlah Setor</label>
          <input type="number" class="form-control" placeholder="Masukkan nominal setor">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Tarik Tabungan -->
<div class="modal fade" id="modalTarik" tabindex="-1" aria-labelledby="modalTarikLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tarik Tabungan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nama Siswa</label>
          <input type="text" class="form-control" value="Ahmad Ramadhan" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Jumlah Tarik</label>
          <input type="number" class="form-control" placeholder="Masukkan nominal tarik">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Simpan</button>
      </div>
    </form>
  </div>
</div>

  <!-- Tabel Tabungan -->
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="mb-3">Daftar Tabungan Siswa - Kelas <span id="kelasTerpilih">X</span></h5>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table-dark text-center">
            <tr>
              <th>No</th>
              <th>Nama Siswa</th>
              <th>Saldo Tabungan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <tr>
              <td>1</td>
              <td>Ahmad Ramadhan</td>
              <td>Rp 500.000</td>
              <td>
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalSetor">Setor</button>
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalTarik">Tarik</button>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>Lisa Permata</td>
              <td>Rp 300.000</td>
              <td>
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalSetor">Setor</button>
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalTarik">Tarik</button>
              </td>
            </tr>
            <!-- Data dinamis dari backend -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
