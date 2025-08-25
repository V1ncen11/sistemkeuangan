@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h3 class="mb-4">Transaksi Pengeluaran</h3>
  <a href="{{ route('jenis_pengeluaran') }}" class="btn btn-warning btn-sm">
    <i class="bi bi-gear"></i> Kelola Jenis Pengeluaran
  </a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <!-- Form Pengeluaran -->
  <div class="card mb-4 shadow-sm">
    <div class="card-body">
      <form action="{{ route('pengeluaran.store')}}" method="POST">
        @csrf
        <div class="row mb-3">
          <div class="col-md-4">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" name="tanggal" id="tanggal" required>
          </div>
          <div class="col-md-4">
            <label for="jenisPengeluaran" class="form-label">Jenis Pengeluaran</label>
          <select class="form-select" id="jenisPengeluaran" name="jenis_pengeluaran_id" required>
            <option selected disabled>-- Pilih Jenis --</option>
            @foreach($jenisPengeluaran as $j)
              <option value="{{ $j->id }}">{{ $j->nama }}</option>
            @endforeach
          </select>
        </div>
          <div class="col-md-4">
            <label for="jumlah" class="form-label">Jumlah (Rp)</label>
            <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Masukkan nominal" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="deskripsi" class="form-label">Keterangan</label>
          <textarea class="form-control" name="deskripsi" id="deskripsi" rows="2" placeholder="Contoh: Pembelian buku administrasi"></textarea>
        </div>
        <div class="d-flex gap-2 mt-3">
          <button type="submit" class="btn btn-success flex-fill" id="btnSubmit">
            <i class="bi bi-save me-2"></i>Simpan Pengeluaran
          </button>
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
        
      </form>
    </div>
  </div>

  <!-- Riwayat Pengeluaran -->
          <h5 class="mb-3">Riwayat Pengeluaran</h5>
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead class="table-dark text-center">
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Jenis</th>
                  <th>Jumlah</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody class="text-center">
                @forelse($pengeluaran as $index => $p)
                  <tr>
                    <td>{{ $pengeluaran->firstItem() + $index }}</td>
                    <td>{{ $p->tanggal }}</td>
                    <td>{{ $p->jenisPengeluaran->nama }}</td>
                    <td>Rp. {{ number_format($p->jumlah,0,',','.') }}</td>
                    <td>{{ $p->deskripsi}}</td>
                    <td>
                      <a href="#" class="btn btn-warning"><i class="fa-solid fa-pen"></i></a>
                      <button type="button" class="btn btn-sm btn-danger"
                          data-bs-toggle="modal"
                          data-bs-target="#confirmDeleteModal"
                          data-id="{{ $p->id }}"
                          data-nama="{{ $p->nama }}"
                          data-url="#">
                          <i class="fa-solid fa-trash"></i>
                      </button>
                  </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5">Belum ada data pengeluaran.</td>
                  </tr>
            @endforelse
          </tbody>      
        </table>
        {{ $pengeluaran->links() }}
      </div>
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
              <p>Yakin mau hapus data <strong id="namaSiswa"></strong>?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    @endsection
    <script>
      const confirmDeleteModal = document.getElementById('confirmDeleteModal');
     confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
       const button = event.relatedTarget;
       const nama = button.getAttribute('data-nama');
       const url = button.getAttribute('data-url'); // Ambil URL dari data-url
     
       const form = document.getElementById('deleteForm');
       form.action = url; // Set URL ke form
     
       document.getElementById('namaSiswa').textContent = nama;
     });
     
     </script>
    
      
    