@extends('layouts.pdf')

@section('title', 'Laporan Harian')

@section('content')
    <h2>Laporan Harian - {{ $tanggal }}</h2>
    <table>
        <thead>
            <tr>
                <th>Waktu</th>
                <th>Jenis</th>
                <th>Nama</th>
                <th>Keterangan</th>
                <th>Masuk</th>
                <th>Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $item)
            <tr>
                <td>{{ $item['waktu'] }}</td>
                <td>{{ $item['jenis'] }}</td>
                <td>{{ $item['nama'] }}</td>
                <td>{{ $item['keterangan'] }}</td>
                <td>{{ number_format($item['masuk']) }}</td>
                <td>{{ number_format($item['keluar']) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p><strong>Total Masuk:</strong> {{ number_format($totalMasuk) }}</p>
    <p><strong>Total Keluar:</strong> {{ number_format($totalKeluar) }}</p>
    <p><strong>Saldo Akhir:</strong> {{ number_format($saldoAkhir) }}</p>
@endsection
