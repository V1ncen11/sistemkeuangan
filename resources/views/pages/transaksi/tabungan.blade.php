@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h3 class="mb-4">Tabungan Siswa</h3>

  <!-- Pilih Kelas -->
  <div class="mb-3 row">
    <div class="col-md-4">
      <label for="pilihKelas" class="form-label">Pilih Kelas</label>
      <form method="GET">
        <select class="form-select" name="kelas" onchange="this.form.submit()">
          <option value="X" {{ $kelas == 'X' ? 'selected' : '' }}>X</option>
          <option value="XI" {{ $kelas == 'XI' ? 'selected' : '' }}>XI</option>
          <option value="XII" {{ $kelas == 'XII' ? 'selected' : '' }}>XII</option>
        </select>
      </form>
    </div>
  </div>

  <!-- Tabel Tabungan -->
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="mb-3">Daftar Tabungan Siswa - Kelas {{ $kelas }}</h5>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table-dark text-center">
            <tr>
              <th>No</th>
              <th>Nama Siswa</th>
              <th>Tipe</th>
              <th>Jumlah</th>
              <th>Saldo Tabungan</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="text-center">
            @foreach ($data as $i => $s)
              <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $s['nama'] }}</td>
                <td>{{ $s['tipe'] }}</td>
                <td>Rp {{ number_format($s['jumlah'], 0, ',', '.') }}</td>
                <td>Rp {{ number_format($s['saldo'], 0, ',', '.') }}</td>
                <td>{{ $s['tanggal'] }}</td>
                <td>
                  <!-- tombol setor -->
                  <button class="btn btn-success btn-sm"
                          data-bs-toggle="modal"
                          data-bs-target="#modalSetor{{ $s['id'] }}">
                          Setor
                  </button>

                  <!-- tombol tarik -->
                  <button class="btn btn-warning btn-sm"
                          data-bs-toggle="modal"
                          data-bs-target="#modalTarik{{ $s['id'] }}">
                          Tarik
                  </button>

                  <!-- tombol riwayat -->
                  <button class="btn btn-info btn-sm btn-riwayat"
                          data-id="{{ $s['id'] }}"
                          data-bs-toggle="modal"
                          data-bs-target="#modalRiwayat">
                          Riwayat
                  </button>
                </td>
              </tr>

              <!-- Modal Setor -->
              <div class="modal fade" id="modalSetor{{ $s['id'] }}">
                <div class="modal-dialog">
                  <form method="POST" action="{{ route('tabungan.store')}}">
                    <div class="modal-content" style="background-color:#f0f5e7; opacity:1;">
                    @csrf
                    <input type="hidden" name="siswa_id" value="{{ $s['id'] }}">
                    <input type="hidden" name="tipe" value="setor">

                    <div class="modal-header">
                      <h5 class="modal-title">Setor Tabungan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label">Nama Siswa</label>
                        <input type="text" class="form-control" value="{{ $s['nama'] }}" readonly>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Jumlah Setor</label>
                        <input type="number" class="form-control" name="jumlah" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                 </div>
                </div>
              </div>

              <!-- Modal Tarik -->
              <div class="modal fade" id="modalTarik{{ $s['id'] }}">
                <div class="modal-dialog">
                  <div class="modal-content" style="background-color:#d4ddc9; opacity:1;">
                  <form method="POST" action="{{ route('tabungan.store')}}">
                    @csrf
                    <input type="hidden" name="siswa_id" value="{{ $s['id'] }}">
                    <input type="hidden" name="tipe" value="tarik">

                    <div class="modal-header">
                      <h5 class="modal-title">Tarik Tabungan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label">Nama Siswa</label>
                        <input type="text" class="form-control" value="{{ $s['nama'] }}" readonly>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Jumlah Tarik</label>
                        <input type="number" class="form-control" name="jumlah" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                  </form>
                </div>
                </div>
              </div>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Riwayat -->
<div class="modal fade" id="modalRiwayat" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Riwayat Tabungan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="infoSiswa" class="mb-3">
          <p><strong>NIS:</strong> <span id="nis"></span></p>
          <p><strong>Nama:</strong> <span id="nama"></span></p>
          <p><strong>Jurusan:</strong> <span id="jurusan"></span></p>
          <p><strong>Total Saldo:</strong> Rp <span id="saldo"></span></p>
        </div>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Tipe</th>
              <th>Jumlah</th>
            </tr>
          </thead>
          <tbody id="tabelRiwayat"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('click', function(e) {
  let btn = e.target.closest('.btn-riwayat');
  if (btn) {
    let id = btn.dataset.id;

    fetch(`/tabungan/riwayat/${id}`)
      .then(res => res.json())
      .then(data => {
        console.log(data); // <-- cek dulu hasil JSON nya disini

        document.getElementById('nis').innerText       = data.nis;
        document.getElementById('nama').innerText      = data.nama;
        document.getElementById('jurusan').innerText   = data.jurusan;
        document.getElementById('saldo').innerText     = data.saldo;

        let tbody = document.getElementById('tabelRiwayat');
        tbody.innerHTML = '';
        data.riwayat.forEach(r => {
          tbody.innerHTML += `
            <tr>
              <td>${r.tanggal}</td>
              <td>${r.tipe}</td>
              <td>${r.jumlah}</td>
            </tr>
          `;
        });
      })
      .catch(err => console.error(err));
  }
});
  </script>
  
@endpush
