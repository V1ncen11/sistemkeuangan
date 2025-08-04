<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
   public function index(Request $request)
   {
       $kelas = $request->kelas ?? 'X'; // ambil dari request, fallback ke 'X'
       $jurusan = $request->jurusan ?? 'AKL'; // fallback ke 'AKL'
   
       $list_jurusan = ['AKL', 'MPLB', 'TKJ', 'TBSM'];
       $list_kelas = ['X', 'XI', 'XII'];
   
       $data_per_jurusan = [];
   
       foreach ($list_jurusan as $jurusan_loop) {
           $query = Siswa::query();
   
           if ($kelas) {
               $query->where('kelas', $kelas);
           }
   
           $query->where('jurusan', $jurusan_loop);
   
           $data_per_jurusan[$jurusan_loop] = $query->paginate(10, ['*'], $jurusan_loop);
       }
   
       return view('siswa.data_siswa', compact(
           'data_per_jurusan',
           'jurusan',
           'kelas',
           'list_jurusan',
           'list_kelas'
       ));
   }
   
   

   public function tambah($kelas, $jurusan)
{
    return view('siswa.tambah_data', compact('kelas', 'jurusan'));
}


public function simpan(Request $request)
{
   $request->validate([
      'nis' => 'required|numeric|unique:siswa,nis',
      'nama' => 'required|string|max:100',
      'kelas' => 'required',
      'jurusan' => 'required',
  ], [
      'nis.required' => 'NIS wajib diisi!',
      'nis.numeric' => 'NIS harus berupa angka!',
      'nis.unique' => 'NIS sudah terdaftar, silakan gunakan NIS lain.',
      
      'nama.required' => 'Nama wajib diisi!',
  ]);
  

    Siswa::create([
        'nis' => $request->nis,
        'nama' => $request->nama,
        'kelas' => $request->kelas,
        'jurusan' => $request->jurusan,
    ]);

    return redirect()->route('siswa')
        ->with('success', 'Data siswa berhasil ditambahkan!');
}

public function hapus($id)
{
    $siswa = Siswa::findOrFail($id);
    $siswa->delete();

    return redirect()->route('siswa')->with('success', 'Data siswa berhasil dihapus!');
}


   }
   

