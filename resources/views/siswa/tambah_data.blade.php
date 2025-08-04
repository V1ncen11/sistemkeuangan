
@extends('layouts.app')

@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Form Tambah Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow-sm p-4" style="min-width: 600px;">
      <h4 class="mb-3 text-center">Tambah Data Siswa</h4>

      <form action="{{ route('siswasimpan') }}" method="POST">
        @csrf

        {{-- Hidden value for backend (if needed) --}}
        <input type="hidden" name="kelas" value="{{ $kelas }}">
        <input type="hidden" name="jurusan" value="{{ $jurusan }}">

        <div class="mb-3">
          <label for="nis" class="form-label">NIS</label>
          <input type="text" class="form-control" id="nis" name="nis" required>
          @error('nis')
        <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Kelas</label>
          <input type="text" class="form-control" value="{{ $kelas }}" disabled>
        </div>

        <div class="mb-3">
          <label class="form-label">Jurusan</label>
          <input type="text" class="form-control" value="{{ $jurusan }}" disabled>
        </div>

        <button type="submit" class="btn btn-primary w-100">Simpan</button>
      </form>
    </div>
  </div>

</body>
</html>


@endsection

