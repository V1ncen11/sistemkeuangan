@extends('layouts.app')

@section('content')
{{-- Pesan sukses --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Pesan error --}}
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


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
                        <input type="number" class="form-control" name="jumlah" required placeholder="Masukan jumlah penarikan...">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" id="btnTarik" class="btn btn-danger">Simpan</button>
                    </div>
                  </form>
                </div>
                </div>
              </div>
            @endforeach
          </tbody>
        </table>
          {{ $data->links() }}  
    </div>
  </div>
</div>

<!-- Modal Riwayat -->
<!-- Modal Riwayat -->
<div class="modal fade" id="modalRiwayat" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-3 shadow-lg border-0">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Riwayat Tabungan</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

        <!-- Info Siswa -->
        <div id="infoSiswa" class="mb-3">
          <p><strong>NIS:</strong> <span id="nis" class="text-dark"></span></p>
          <p><strong>Nama:</strong> <span id="nama" class="fw-bold text-primary"></span></p>
          <p><strong>Jurusan:</strong> <span id="jurusan" class="text-secondary"></span></p>
          <p class="fw-bold">Total Saldo: <span class="text-success">Rp <span id="saldo"></span></span></p>
        </div>

        <!-- Tabel Riwayat -->
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-dark text-center">
              <tr>
                <th>Tanggal</th>
                <th>Tipe</th>
                <th>Jumlah</th>
              </tr>
            </thead>
            <tbody id="tabelRiwayat" class="text-center"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-riwayat').forEach(btn => {
      btn.addEventListener('click', function () {
        let id = this.dataset.id;
  
        fetch(`/tabungan/riwayat/${id}`)
          .then(res => res.json())
          .then(data => {
            console.log(data); // cek isi data JSON
  
            document.getElementById('nis').innerText     = data.nis;
            document.getElementById('nama').innerText    = data.nama;
            document.getElementById('jurusan').innerText = data.jurusan;
            document.getElementById('saldo').innerText   = data.saldo;
  
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
      });
    });
  });

  document.getElementById('btnTarik').addEventListener('click', function() {
  let saldo  = parseInt(document.getElementById('saldo').innerText); 
  let jumlah = parseInt(document.getElementById('jumlah').value);

  if (jumlah > saldo) {
    alert("⚠️ Jumlah penarikan tidak boleh lebih dari saldo!");
    return; // stop proses
  }

  // kalau aman, lanjut fetch/submit ke server
  fetch('/tabungan/store', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({ jumlah })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      alert("✅ Penarikan berhasil!");
      location.reload();
    } else {
      alert("❌ Gagal tarik tabungan!");
    }
  });
});

  </script>
  

  
@endsection
