@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Riwayat Kas</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>Sumber</th>
                <th>Saldo</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @php $saldo = 0; @endphp
            @forelse($kas as $item)
                @php 
                    if($item->tipe == 'masuk'){
                        $saldo += $item->jumlah;
                    } else {
                        $saldo -= $item->jumlah;
                    }
                @endphp
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $item->tanggal }}</td>
                    <td class="text-center">
                        <span class="badge bg-{{ $item->tipe == 'masuk' ? 'success' : 'danger' }}">
                            {{ ucfirst($item->tipe) }}
                        </span>
                    </td>
                    <td class="text-center">Rp {{ number_format($item->jumlah,0,',','.') }}</td>
                    <td class="text-center">{{ $item->sumber ?? '-' }}</td>
                    <td class="text-center">Rp {{ number_format($saldo,0,',','.') }}</td>
                    <td class="text-center">{{ $item->deskripsi ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data kas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
