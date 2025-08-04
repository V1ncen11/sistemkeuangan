@extends('layouts.app')

@section('content')
<h4 class="mb-4 fw-bold">Dashboard Keuangan Sekolah</h4>

<!-- Ringkasan Kartu -->
<div class="row g-4 mb-4">
  <div class="col-md-3">
    <div class="card bg-primary text-white shadow-sm rounded-4 p-3">
      <h6>Jumlah Siswa</h6>
      <h3>500</h3>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card bg-success text-white shadow-sm rounded-4 p-3">
      <h6>Total Transaksi</h6>
      <h3>Rp 145 Jt</h3>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card bg-warning text-white shadow-sm rounded-4 p-3">
      <h6>KAS Sekolah</h6>
      <h3>Rp 28 Jt</h3>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card bg-danger text-white shadow-sm rounded-4 p-3">
      <h6>Pengeluaran</h6>
      <h3>Rp 5 Jt</h3>
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
          <tr>
            <td>1</td>
            <td>Ani Rahmawati</td>
            <td>X TKJ</td>
            <td>SPP</td>
            <td>Rp 150.000</td>
            <td>20 Juli 2025</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Budi Santoso</td>
            <td>XI MPLB</td>
            <td>Praktikum</td>
            <td>Rp 100.000</td>
            <td>19 Juli 2025</td>
          </tr>
          <!-- Tambahkan data lainnya -->
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
