@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4"> 
    <h3>Data Siswa Kelas XI</h3>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('siswa/kelas-x') ? 'active' : '' }}" href="{{ route('siswa') }}">Kelas X</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('siswa/kelas-xi') ? 'active' : '' }}" href="{{ route('siswakelasXI') }}">Kelas XI</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('siswa/kelas-xii') ? 'active' : '' }}" href="#">Kelas XII</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('siswa/alumni') ? 'active' : '' }}" href="#">Alumni</a>
        </li>
    </ul>

    <div class="tab-pane fade show active" id="kelasXI" role="tabpanel" aria-labelledby="kelasXI-tab">
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
                                <h5>Data Siswa Kelas XI - {{ $jurusan }}</h5>
                                <a href="{{ route('tambahsiswakelasXI', ['kelas' => 'XI', 'jurusan' => $jurusan]) }}" class="btn btn-primary btn-sm">
                                    + Tambah Siswa
                                </a>
                            </div>

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
                                   @foreach($siswaXI->where('jurusan', $jurusan) as $siswa)

                                        <tr>

                                            <td>{{ $no++ }}</td>
                                            <td>{{ $siswa->nis }}</td>
                                            <td>{{ $siswa->nama }}</td>
                                            <td>{{ $siswa->kelas }}</td>
                                            <td>{{ $siswa->jurusan }}</td>
                                            <td>
                                                <a href="{{ route('editsiswa', $siswa->id) }}" class="btn btn-sm btn-warning">Edit</a>
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
                        </div> <!-- end accordion-body -->
                    </div> <!-- end collapse -->
                </div> <!-- end accordion-item -->
            @endforeach
        </div> <!-- end accordion -->
    </div> <!-- end tab-pane -->
</div> <!-- end container -->

@endsection
