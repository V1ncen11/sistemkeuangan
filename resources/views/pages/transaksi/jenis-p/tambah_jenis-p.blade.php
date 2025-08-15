@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Jenis Pembayaran</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('jenis-pembayaran.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_pembayaran" class="form-label">Nama Pembayaran</label>
            <input type="text" name="nama_pembayaran" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tingkat_kelas" class="form-label">Tingkat Kelas</label>
            <select name="tingkat_kelas" class="form-select" required>
                <option value="">-- Pilih Kelas --</option>
                <option value="X">X</option>
                <option value="XI">XI</option>
                <option value="XII">XII</option>
                <option value="Alumni">Alumni</option>
            </select>
        </div>
        <div class="form-group">
            <label for="jumlah">Jumlah Pembayaran (RP)</label>
            <input type="number" name="jumlah" class="form-control" required>
          </div>
          

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('jenispembayaran') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
