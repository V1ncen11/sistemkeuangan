@extends('layouts.pdf')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Bulanan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background: #ddd; }
        h3 { text-align: center; margin-bottom: 5px; }
    </style>
</head>
<body>
    <h3>Laporan Bulanan - {{ $bulan }}/{{ $tahun }}</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Nama</th>
                <th>Tipe</th>
                <th>Jenis</th>
                <th>Keterangan</th>
                <th>Masuk</th>
                <th>Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $i => $t)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $t['tanggal'] }}</td>
                <td>{{ $t['waktu'] }}</td>
                <td>{{ $t['nama'] }}</td>
                <td>{{ $t['tipe'] }}</td>
                <td>{{ $t['jenis'] }}</td>
                <td>{{ $t['keterangan'] }}</td>
                <td>Rp {{ number_format($t['masuk'],0,',','.') }}</td>
                <td>Rp {{ number_format($t['keluar'],0,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4 style="margin-top:20px">Ringkasan</h4>
    <p>Total Pemasukan: Rp {{ number_format($totalMasuk,0,',','.') }}</p>
    <p>Total Pengeluaran: Rp {{ number_format($totalKeluar,0,',','.') }}</p>
    <p>Saldo Akhir: Rp {{ number_format($saldoAkhir,0,',','.') }}</p>
</body>
</html>
@endsection