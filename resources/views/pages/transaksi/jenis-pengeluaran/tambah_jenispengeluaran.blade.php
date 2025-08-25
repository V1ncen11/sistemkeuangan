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
    <form action="{{ route('jenis_pengeluaran.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Jenis Pengeluaran</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('jenis_pengeluaran') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
