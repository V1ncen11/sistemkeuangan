@extends('layouts.app')

@section('content')
<h4 class="mb-4 fw-bold">Dashboard Keuangan Sekolah</h4>

<!-- Ringkasan Kartu -->
<div class="row g-4 mb-4">
  <div class="col-md-3">
    <div class="card bg-primary text-white shadow-sm rounded-4 p-3">
      <h6>Jumlah Siswa</h6>
      <h3>{{ $jumlahSiswa }}</h3>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card bg-success text-white shadow-sm rounded-4 p-3">
      <h6>Total Transaksi</h6>
      <h3>Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</h3>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card bg-warning text-white shadow-sm rounded-4 p-3">
      <h6>KAS Sekolah</h6>
      <h3>Rp {{ number_format($kasSekolah, 0, ',', '.') }}</h3>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card bg-danger text-white shadow-sm rounded-4 p-3">
      <h6>Pengeluaran</h6>
      <h3>Rp {{ number_format($pengeluaran, 0, ',', '.') }}</h3>
    </div>
  </div>
</div>

<!-- Tabel Transaksi Terbaru -->
<div class="card shadow-sm rounded-4">
  <div class="card-header fw-bold">Transaksi Terbaru</div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-sm">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Jenis Pembayaran</th>
            <th>Jumlah</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody>
          @forelse($transaksiTerbaru as $index => $t)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $t->siswa->nama ?? '-' }}</td>
              <td>{{ $t->siswa->kelas ?? '-' }} {{ $t->siswa->jurusan ?? '' }}</td>
              <td>{{ $t->jenisPembayaran->nama_pembayaran ?? '-' }}</td>
              <td>Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td>
              <td>{{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d F Y') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">Belum ada transaksi</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
