@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Transaksi Kas</h3>
    
    <form action="{{ route('kas.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>

        <div class="mb-3">
            <label for="sumber" class="form-label">Sumber</label>
            <input type="text" class="form-control" id="sumber" name="sumber" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
        </div>

        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis</label>
            <select class="form-control" id="jenis" name="jenis" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="masuk">Kas Masuk</option>
                <option value="keluar">Kas Keluar</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('transaksi.kas') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
