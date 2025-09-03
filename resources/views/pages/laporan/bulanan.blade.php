@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h3 class="mb-4">Laporan Bulanan</h3>

  <!-- Filter Bulan & Tahun -->
  <form method="GET" action="{{ route('laporan.bulanan') }}" class="mb-4 row align-items-center">
    <div class="col-md-3">
      <label for="bulan" class="form-label">Pilih Bulan</label>
      <select name="bulan" id="bulan" class="form-select">
        @foreach (range(1, 12) as $b)
          <option value="{{ sprintf('%02d', $b) }}" {{ $bulan == sprintf('%02d', $b) ? 'selected' : '' }}>
            {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="col-md-3">
      <label for="tahun" class="form-label">Pilih Tahun</label>
      <select name="tahun" id="tahun" class="form-select">
        @for ($i = now()->year; $i >= now()->year - 10; $i--)
          <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
        @endfor
      </select>
    </div>

    <div class="col-md-6 d-flex gap-2 mt-3">
      <button type="submit" class="btn btn-primary">Tampilkan</button>
      <a href="{{ route('laporan.bulanan.pdf', ['bulan' => $bulan, 'tahun' => $tahun]) }}" 
         target="_blank" class="btn btn-danger">
        <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
      </a>
    </div>
  </form>

  <!-- Ringkasan Bulanan -->
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
        <span id="bulanLaporan">
          {{ \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F Y') }}
        </span>
      </h5>
      <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Tanggal</th>
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
              <td>{{ $t['tanggal'] }}</td>
              <td>{{ $t['nama'] }}</td>
              <td>{{ $t['tipe'] }}</td>
              <td>{{ $t['jenis'] }}</td>
              <td>{{ $t['keterangan'] ?? '-' }}</td>
              <td>{{ number_format($t['masuk'], 0, ',', '.') }}</td>
              <td>{{ number_format($t['keluar'], 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="8">Tidak ada transaksi pada bulan ini</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
