@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h3 class="mb-4">Laporan Harian</h3>

  <!-- Filter Tanggal -->
  <form method="GET" action="{{ route('laporan.harian') }}" class="mb-4 row align-items-center">
    <label for="tanggal" class="col-sm-2 col-form-label">Pilih Tanggal</label>
    <div class="col-sm-4">
      <input type="date" name="tanggal" id="tanggal" class="form-control" 
             value="{{ request('tanggal', date('Y-m-d')) }}">
    </div>
    <div class="col-sm-6 d-flex gap-2">
      <button type="submit" class="btn btn-primary">Tampilkan</button>
      <a href="#" 
         target="_blank" class="btn btn-danger">
        <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
      </a>
    </div>
  </form>

  <!-- Ringkasan Harian -->
  <div class="row mb-4">
    <div class="col-md-4">
      <div class="card border-success">
        <div class="card-body">
          <h6>Total Pemasukan</h6>
          <h5 class="text-success">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</h5>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-danger">
        <div class="card-body">
          <h6>Total Pengeluaran</h6>
          <h5 class="text-danger">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</h5>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-primary">
        <div class="card-body">
          <h6>Saldo Akhir</h6>
          <h5 class="text-primary">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</h5>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabel Rincian Transaksi -->
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="mb-3">Rincian Transaksi - 
        <span id="tglLaporan">{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</span>
      </h5>
      <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Waktu</th>
              <th>Nama</th>
              <th>Tipe</th>
              <th>Jenis Transaksi</th>
              <th>Keterangan</th>
              <th>Masuk</th>
              <th>Keluar</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($laporan as $i => $t)
            <tr>
              <td>{{ $i+1 }}</td>
              <td>{{ $t['waktu'] }}</td>
              <td>{{ ucfirst($t['tipe']) }}</td>
              <td>{{ $t['jenis'] }}</td>  
              <td>{{ $t['nama'] }}</td>
              <td>{{ $t['keterangan'] ?? '-' }}</td>
              <td>{{ number_format($t['masuk'], 0, ',', '.') }}</td>
              <td>{{ number_format($t['keluar'], 0, ',', '.') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="7">Tidak ada transaksi pada tanggal ini</td>
            </tr>
          @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
