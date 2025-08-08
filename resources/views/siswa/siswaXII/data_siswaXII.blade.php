@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@if (session('success') || session('success_add'))
    <div class="alert alert-success mt-2">
        {{ session('success') ?? session('success_add') }}
    </div>
@endif
<div class="container mt-4"> 
    <h3>Data Siswa Kelas XII</h3>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('siswa/kelas-x') ? 'active' : '' }}" href="{{ route('siswa') }}">Kelas X</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('siswa/kelas-xi') ? 'active' : '' }}" href="{{ route('siswakelasXI') }}">Kelas XI</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('siswa/kelas-xii') ? 'active' : '' }}" href="{{ route('siswakelasXII')}}">Kelas XII</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('siswa/alumni') ? 'active' : '' }}" href="#">Alumni</a>
        </li>
    </ul>

    <div class="tab-pane fade show active" id="kelasXII" role="tabpanel" aria-labelledby="kelasXII-tab">
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
                                <h5>Data Siswa Kelas XII - {{ $jurusan }}</h5>
                                <a href="{{ route('tambahsiswaXII', ['kelas' => 'XII', 'jurusan' => $jurusan]) }}" class="btn btn-primary btn-sm">
                                    + Tambah Siswa
                                </a>
                            </div>
                            @php
                            $pagination = $data_per_jurusan[$jurusan];
                            // nomor awal untuk setiap halaman
                            $start = ($pagination->currentPage() - 1) * $pagination->perPage();
                          @endphp
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark text-center">
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
                                   @forelse ($pagination as $index => $siswa)

                                        <tr>

                                            <td>{{ $start + $index + 1 }}</td>
                                            <td>{{ $siswa->nis }}</td>
                                            <td>{{ $siswa->nama }}</td>
                                            <td>{{ $siswa->kelas }}</td>
                                            <td>{{ $siswa->jurusan }}</td>
                                            <td>
                                                <a href="{{ route('editsiswaXII', $siswa->id) }}" class="btn btn-warning"><i class="fa-solid fa-pen"></i></a>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal"
                                                    data-id="{{ $siswa->id }}"
                                                    data-nama="{{ $siswa->nama }}"
                                                    data-url="{{ route('hapussiswaXII', $siswa->id) }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                <a href="#" class="btn btn-sm btn-success">Naik Kelas</a>
                                            </td>
                                        </tr>
                                        @empty
                                        @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{ $pagination->withQueryString()->links('pagination::bootstrap-5') }}
                              </div>
                        </div> <!-- end accordion-body -->
                    </div> <!-- end collapse -->
                </div> <!-- end accordion-item -->
            @endforeach
        </div> <!-- end accordion -->
    </div> <!-- end tab-pane -->

</div> <!-- end container -->

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

@endsection
