<!-- Bootstrap CSS -->
@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@if(session('success'))
    <div id="notif-success" class="alert alert-success alert-dismissible" role="alert" style="transition: all 0.5s ease;">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            const notif = document.getElementById('notif-success');
            notif.style.opacity = '0';
            setTimeout(() => notif.style.display = 'none', 500); 
        }, 3000);
    </script>
@endif


<div class="container mt-4">  
  <h3 class="mb-4">Data Siswa</h3>

  <!-- Tabs Kelas -->
  <ul class="nav nav-tabs" id="kelasTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="kelasX-tab" data-bs-toggle="tab" data-bs-target="#kelasX" type="button" role="tab">Kelas X</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="kelasXI-tab" data-bs-toggle="tab" data-bs-target="#kelasXI" type="button" role="tab">Kelas XI</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="kelasXII-tab" data-bs-toggle="tab" data-bs-target="#kelasXII" type="button" role="tab">Kelas XII</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="alumni-tab" data-bs-toggle="tab" data-bs-target="#alumni" type="button" role="tab">Alumni</button>
    </li>
  </ul>

 

    <div class="tab-pane fade show active" id="kelasX" role="tabpanel" aria-labelledby="kelasX-tab">
  <div class="accordion" id="accordionJurusan">

    @foreach (['AKL', 'MPLB', 'TKJ', 'TBSM'] as $jurusan)
      <div class="accordion-item">
        <h2 class="accordion-header" id="heading{{ $jurusan }}">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $jurusan }}" aria-expanded="false" aria-controls="collapse{{ $jurusan }}">
            {{ $jurusan }}
          </button>
        </h2>
        <div id="collapse{{ $jurusan }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $jurusan }}" data-bs-parent="#accordionJurusan">
          <div class="accordion-body">
          <div class="mb-3 d-flex justify-content-between">
              <h5>Data Siswa Kelas X - {{ $jurusan }}</h5>
              <a href="{{ route('tambahsiswa', ['kelas' => 'X', 'jurusan' => $jurusan]) }}" class="btn btn-primary btn-sm">
              + Tambah Siswa
            </a>


            </div>
            @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Jurusan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>

                @php
                $no= 1;
                @endphp
                 @php
        $pagination = $data_per_jurusan[$jurusan];
    @endphp
                @foreach($pagination as $siswa) 
                    <tr>
                    <td>{{ $loop->iteration + ($pagination->currentPage() - 1) * $pagination->perPage() }}</td>
                      <td>{{ $siswa->nis }}</td>
                      <td>{{ $siswa->nama }}</td>
                      <td>{{ $siswa->kelas }}</td>
                      <td>{{ $siswa->jurusan }}</td>
                      <td>
                        <a href="#" class="btn btn-sm btn-warning">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger"
    data-bs-toggle="modal"
    data-bs-target="#confirmDeleteModal"
    data-id="{{ $siswa->id }}"
    data-nama="{{ $siswa->nama }}"
    data-url="{{ route('hapussiswa', $siswa->id) }}">
    Hapus
</button>



                  
                        <a href="#" class="btn btn-sm btn-success">Naik Kelas</a>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            
            {{ $pagination->links('pagination::bootstrap-5') }}


          </div>
        </div>
      </div>
    @endforeach

  </div> <!-- /accordion -->
</div> <!-- /tab-pane kelasX -->




    <!-- Kelas XI -->
    <div class="tab-pane fade" id="kelasXI" role="tabpanel">
      <p class="text-muted">Data siswa kelas XI belum ditambahkan.</p>
    </div>

    <!-- Kelas XII -->
    <div class="tab-pane fade" id="kelasXII" role="tabpanel">
      <p class="text-muted">Data siswa kelas XII belum ditambahkan.</p>
    </div>

    <!-- Alumni -->
    <div class="tab-pane fade" id="alumni" role="tabpanel">
      <p class="text-muted">Data alumni belum ditambahkan.</p>
    </div>
  </div>
</div>

<!-- Modal -->
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


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection