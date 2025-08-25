
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Daftar Jenis Pembayaran</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('jenis_pengeluaran.create')}}" class="btn btn-primary">Kelola Jenis Pengeluaran</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Jenis Pengeluaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($jenis as $i => $j)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $j->nama }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-warning">Edit</a>
                        <button type="button" class="btn btn-danger"
                          data-bs-toggle="modal"
                          data-bs-target="#confirmDeleteModal"
                          data-id="{{ $j->id }}"
                          data-nama="{{ $j->nama }}"
                          data-url="#">
                          <i class="fa-solid fa-trash"></i>
                      </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Belum ada data jenis pembayaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" id="deleteForm">
        @csrf
        @method('DELETE')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p>Yakin mau hapus data <strong id="JenisPembayaran"></strong>?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script>
    const confirmDeleteModal = document.getElementById('confirmDeleteModal');
   confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
     const button = event.relatedTarget;
     const nama = button.getAttribute('data-nama');
     const url = button.getAttribute('data-url'); // Ambil URL dari data-url
   
     const form = document.getElementById('deleteForm');
     form.action = url; // Set URL ke form
   
     document.getElementById('JenisPembayaran').textContent = nama;
   });
   
   </script>
   @endsection
