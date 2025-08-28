@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card bg-success text-white shadow-sm rounded-4 p-1">
                <div class="card-body">
                    <h5>Total Masuk</h5>
                    <h3>Rp {{ number_format($totalMasuk, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-danger text-white shadow-sm rounded-4 p-1">
                <div class="card-body">
                    <h5>Total Keluar</h5>
                    <h3>Rp {{ number_format($totalKeluar, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow-sm rounded-4 p-1">
                <div class="card-body">
                    <h5>Saldo Akhir</h5>
                    <h3>Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>
    
    <h2 class="mb-4">Riwayat Kas</h2>
    <a href="{{ route('kas.create') }}" class="btn btn-warning btn-sm">
        <i class="bi bi-gear"></i> Kelola Jenis Pembayaran
      </a>
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
                <th>Aksi</th>
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
                    <td><button class="btn btn-danger btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#confirmDeleteModal{{ $item->id }}">
                        Hapus
                    </button>
                    </td>
                </tr>
                <!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmDeleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah kamu yakin mau hapus data Kas Tanggal <b>{{ $item->tanggal }}</b> dengan Deskripsi <b>{{ $item->deskripsi }}</b>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <form action="{{ route('kas.destroy', $item->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Ya, Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data kas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-3">
        {{ $kas->links() }}
    </div>
</div>

@endsection
