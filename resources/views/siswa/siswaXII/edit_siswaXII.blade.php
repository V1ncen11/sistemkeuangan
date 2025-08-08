@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow-sm p-4" style="min-width: 600px;">
    <h4 class="mb-3 text-center">Edit Data Siswa XII</h4>

    <form action="{{ route('updatesiswaXII', $siswa->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="nis" class="form-label">NIS</label>
        <input type="text" class="form-control" id="nis" name="nis" value="{{ $siswa->nis }}" disabled>
      </div>

      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" value="{{ $siswa->nama }}" id="nama" name="nama" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Kelas</label>
        <input type="text" class="form-control" value="{{ $kelas }}" disabled>
      </div>

      <div class="mb-3">
        <label class="form-label">Jurusan</label>
        <input type="text" class="form-control" value="{{ $jurusan }}" disabled>
      </div>

      <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
    </form>
  </div>
</div>
@endsection
