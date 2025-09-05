
@extends('layouts.pdf')


@section('content')
<body>
  <h3 style="text-align:center;">Rekap Tabungan Siswa</h3>
  <p>Kelas: {{ $kelas == 'semua' ? 'Semua Kelas' : $kelas }}</p>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Siswa</th>
        <th>Kelas</th>
        <th>Total Tabungan</th>
      </tr>
    </thead>
    <tbody>
      @foreach($siswa as $i => $s)
        <tr>
          <td>{{ $i+1 }}</td>
          <td>{{ $s->nama }}</td>
          <td>{{ $s->kelas }}</td>
          <td>Rp {{ number_format($s->total_tabungan, 0, ',', '.') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
@endsection
