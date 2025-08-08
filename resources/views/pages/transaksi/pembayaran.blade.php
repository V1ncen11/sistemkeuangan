@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Pembayaran Siswa</h3>
    <div class="mb-4">
      <a href="{{ route('jenispembayaran')}}" class="btn btn-secondary">Kelola Jenis Pembayaran</a>
  </div>
    {{-- Filter Kelas --}}
    <ul class="nav nav-tabs mb-4" style="border-bottom: 1px solid #dee2e6; margin-bottom: 1.5rem;">

        @foreach (['X', 'XI', 'XII'] as $kelas)
            <li class="nav-item">
                <a class="nav-link {{ request()->kelas == $kelas ? 'active' : '' }}"
                   href="?kelas={{ $kelas }}">
                   Kelas {{ $kelas }}
                </a>
            </li>
        @endforeach
    </ul>

    {{-- Tabel Siswa --}}
    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Jenis Pembayaran</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($siswa as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nis }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>
                      @foreach ($item->pembayaran as $p)
                      <div>{{ optional($p->jenisPembayaran)->nama_pembayaran ?? '-' }} - Rp{{ number_format($p->jumlah) }}</div>
                  @endforeach
                    </td>
                    <td>{{ $item->kelas }}</td>
                    <td>{{ $item->jurusan }}</td>
                    <td class="text-center">
                      <button class="btn btn-success btn-sm tombol-bayar"
                        data-bs-toggle="modal"
                        data-bs-target="#modalPembayaran"
                        data-id="{{ $item->id }}"
                        data-nis="{{ $item->nis }}"
                        data-nama="{{ $item->nama }}">
                        Bayar
                  </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data siswa</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Modal Form Pembayaran --}}
<div class="modal fade" id="modalPembayaran" tabindex="-1" aria-labelledby="modalPembayaranLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="#">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPembayaranLabel">Form Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{-- Data Siswa --}}
                    <div class="mb-3">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" class="form-control" name="nis" id="nis" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" readonly>
                    </div>

                    {{-- Jenis Pembayaran --}}
                    <div class="mb-3">
                        <label for="jenis_pembayaran_id" class="form-label">Jenis Pembayaran</label>
                        <select class="form-select" name="jenis_pembayaran_id" id="jenisPembayaran">
                          <option value="" selected disabled>-- Pilih Jenis Pembayaran --</option>
                      </select>
                    </div>

                    {{-- Jumlah Bayar --}}
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah Bayar</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah" required>
                    </div>

                    <input type="hidden" name="tanggal" value="{{ date('Y-m-d') }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script untuk Auto-fill Modal --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    var modalPembayaran = document.getElementById('modalPembayaran');

    modalPembayaran.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var nis = button.getAttribute('data-nis');
        var nama = button.getAttribute('data-nama');

        // Isi form modal
        modalPembayaran.querySelector('#nis').value = nis;
        modalPembayaran.querySelector('#nama').value = nama;

        // Kosongkan dulu dropdown jenis pembayaran
        var jenisSelect = modalPembayaran.querySelector('#jenisPembayaran');
        jenisSelect.innerHTML = '<option value="">-- Pilih Jenis Pembayaran --</option>';

        // Ambil data jenis pembayaran via AJAX
        fetch('/get-jenis-pembayaran/' + nis)
            .then(response => response.json())
            .then(res => {
                if (res.status === 'success') {
                    res.data.forEach(function (item) {
                        let option = document.createElement('option');
                        option.value = item.id;
                        option.text = item.nama_pembayaran;
                        jenisSelect.appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error('Gagal ambil jenis pembayaran:', error);
            });
    });
});
</script>
@endsection
