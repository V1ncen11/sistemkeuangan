@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h3 class="mb-4">Rekap Tabungan Siswa</h3>

  <!-- Filter dan Aksi -->
  <form method="GET" action="{{ route('rekap.tabungan') }}" class="row mb-3 align-items-end">
    <div class="col-md-3">
        <label for="kelas" class="form-label">Filter Kelas</label>
        <select class="form-select" id="kelas" name="kelas" onchange="this.form.submit()">
            <option value="semua" {{ $kelas == 'semua' ? 'selected' : '' }}>Semua Kelas</option>
            <option value="X" {{ $kelas == 'X' ? 'selected' : '' }}>Kelas X</option>
            <option value="XI" {{ $kelas == 'XI' ? 'selected' : '' }}>Kelas XI</option>
            <option value="XII" {{ $kelas == 'XII' ? 'selected' : '' }}>Kelas XII</option>
        </select>
    </div>

    <div class="col-md-3">
        <label for="cari" class="form-label">Cari Nama Siswa</label>
        <div class="input-group">
            <input type="text" class="form-control" id="cari" name="cari" value="{{ $cari }}" placeholder="Masukkan nama siswa...">
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </div>
    </div>



    <div class="col-md-4 d-flex justify-content-end mt-2">
      <a href="{{ route('rekap.tabungan.pdf', ['kelas' => $kelas, 'cari' => $cari]) }}" target="_blank" class="btn btn-danger">
        <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
      </a>
    </div>
  </form>

  <!-- Tabel Rekap -->
  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
      <thead class="table-dark text-center">
        <tr>
          <th>No</th>
          <th>Nama Siswa</th>
          <th>Kelas</th>
          <th>Total Tabungan</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($siswa as $i => $s)
        <tr>
          <td class="text-center">{{ $i+1 }}</td>
          <td>{{ $s->nama }}</td>
          <td class="text-center">{{ $s->kelas }}</td>
          <td class="text-end">Rp {{ number_format($s->total_tabungan ?? 0, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="text-center">Tidak ada data</td>
        </tr>
        @endforelse
      </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
      {{ $siswa->appends(request()->query())->links() }}
    </div>
  </div>
</div>
@endsection
