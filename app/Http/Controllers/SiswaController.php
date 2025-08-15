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
       $list_kelas = ['X', 'XI', 'XII','alumni'];
   
       $data_per_jurusan = [];
   
       foreach ($list_jurusan as $jurusan_loop) {
        $query = Siswa::with(['pembayaran.jenisPembayaran']);
   
           if ($kelas) {
               $query->where('kelas', $kelas);
           }
   
           $query->where('jurusan', $jurusan_loop);
   
           $data_per_jurusan[$jurusan_loop] = $query->paginate(5, ['*'], $jurusan_loop);
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
    ->with('success_add', 'Data siswa berhasil ditambahkan!')
    ->with('jurusan_aktif', $request->jurusan);

}

public function hapus($id)
{
    $siswa = Siswa::findOrFail($id);
    $siswa->delete();

    return redirect()->route('siswa')->with('success', 'Data siswa berhasil dihapus!');
}

public function edit($id)
{
    $siswa = Siswa::findOrFail($id);
    $kelas = $siswa->kelas;
    $jurusan = $siswa->jurusan;

    return view('siswa.edit_siswa', compact('siswa', 'kelas', 'jurusan'));
}

public function update(Request $request, $id){
    $siswa = Siswa::findOrFail($id);
    $siswa->nama = $request->nama;
    $siswa->save();
    return redirect()->route('siswa')
        ->with('success', 'Data berhasil diupdate!');       
}
public function naikKelasX($id)
{
    $siswa = Siswa::findOrFail($id);

    if ($siswa->kelas !== 'X') {
        return redirect()->back()->with('error', 'Siswa ini bukan di kelas X.');
    }

    $siswa->kelas = 'XI';
    $siswa->save();

    return redirect()->back()->with('success', 'Siswa berhasil naik ke XI.');
}

//SISWA XI

public function indexXI(Request $request)
{
    $kelas = $request->kelas ?? 'XI'; // default XI
     $list_kelas = ['X', 'XI', 'XII','alumni'];
    $list_jurusan = ['AKL', 'MPLB', 'TKJ', 'TBSM'];

    $data_per_jurusan = [];

    foreach ($list_jurusan as $jurusan_loop) {
        $query = Siswa::query();
        $query->where('kelas', $kelas)
              ->where('jurusan', $jurusan_loop);

        $data_per_jurusan[$jurusan_loop] = $query->paginate(5, ['*'], 'page_'.$jurusan_loop);
    }
    return view('siswa.siswaXI.data_siswaXI', compact('data_per_jurusan', 'list_jurusan', 'kelas'));
}



public function tambahXI(Request $request)
    {
        $kelas = $request->query('kelas');      
        $jurusan = $request->query('jurusan');  
        return view('siswa.siswaXI.tambah_siswaXI', compact('kelas', 'jurusan'));
    }

    public function simpanXI(Request $request){
    Siswa::create([
        'nis' => $request->nis,
        'nama' => $request->nama,
        'kelas' => $request->kelas,
        'jurusan' => $request->jurusan,
    ]);
    return redirect()->route('siswakelasXI')->with('success', 'Siswa berhasil ditambahkan');
}
    public function editXI($id){
        $siswa = Siswa::findOrFail($id);
        $kelas=$siswa->kelas;
        $jurusan=$siswa->jurusan;

        return view('siswa.siswaXI.edit_siswaXI', compact('siswa','kelas','jurusan'));
    } 

    public function updateXI(Request $request, $id){
        $siswa = Siswa::FindOrFail($id);
        $siswa->nama = $request->nama;
        $siswa->save();
        return redirect()->route('siswakelasXI')
        ->with('success', 'Data berhasil diupdate!');

    }

    public function hapusXI($id){
        $siswa = Siswa::FindOrFail($id);
        $siswa->delete();
        return redirect()->route('siswakelasXI')
        ->with('success', 'Data berhasil dihapus!');
    }

    public function naikkelasXI($id)
{
    $siswa = Siswa::findOrFail($id);

    if ($siswa->kelas !== 'XI') {
        return redirect()->back()->with('error', 'Siswa ini bukan di kelas XI.');
    }

    $siswa->kelas = 'XII';
    $siswa->save();

    return redirect()->back()->with('success', 'Siswa berhasil naik ke XII.');
}

    //SISWA KELAS XII

    public function indexXII(Request $request){
        $kelas = $request->kelas ?? 'XII'; // default XI
     $list_kelas = ['X', 'XI', 'XII','alumni'];
    $list_jurusan = ['AKL', 'MPLB', 'TKJ', 'TBSM'];

    $data_per_jurusan = [];

    foreach ($list_jurusan as $jurusan_loop) {
        $query = Siswa::query();
        $query->where('kelas', $kelas)
              ->where('jurusan', $jurusan_loop);

        $data_per_jurusan[$jurusan_loop] = $query->paginate(5, ['*'], 'page_'.$jurusan_loop);
    }
    return view('siswa.siswaXII.data_siswaXII', compact('data_per_jurusan', 'list_jurusan', 'kelas'));
    }

    public function tambahXII(Request $request){
        $kelas = $request->query('kelas');      
        $jurusan = $request->query('jurusan');  
        return view('siswa.siswaXII.tambah_siswaXII', compact('kelas', 'jurusan'));
    }

    public function simpanXII(Request $request){
        Siswa::create([
            
            'nis' =>$request-> nis,
            'nama' =>$request-> nama,
            'kelas' =>$request-> kelas,
            'jurusan' =>$request-> jurusan,
        ]);
        return redirect()->route('siswakelasXII')->with('success', 'Data berhasil ditambah!');
    }

    public function editXII($id){
       $siswa = Siswa::FindOrFail($id);
       $kelas=$siswa->kelas;
       $jurusan=$siswa->jurusan;
       return view('siswa.siswaXII.edit_siswaXII', compact('siswa','kelas','jurusan'));
    }

    public function updateXII(Request $request ,$id){
        $siswa = Siswa::FindOrFail($id);
        $siswa->nama = $request->nama;
        $siswa->nama = $request->nama;
        $siswa->save();
        return redirect()->route('siswakelasXII')->with('success','Data berhasil diupdate!');
    }

    public function hapusXII(Request $request, $id){
        $siswa = Siswa::FindOrFail($id);
        $siswa->delete();
        return redirect()->route('siswakelasXII')->with('success','Data berhasil dihapus!');
    }

    public function lulus($id)
{
    $siswa = Siswa::findOrFail($id);
    $siswa->kelas = 'Alumni';
    $siswa->save();

    return redirect()->back()->with('success', 'Siswa berhasil diluluskan ke Alumni.');
}



//alumni
    public function indexalumn(Request $request){
        $kelas = $request->kelas ?? 'alumni'; // default XI
     $list_kelas = ['X', 'XI', 'XII','alumni'];
    $list_jurusan = ['AKL', 'MPLB', 'TKJ', 'TBSM'];

    $data_per_jurusan = [];

    foreach ($list_jurusan as $jurusan_loop) {
        $query = Siswa::query();
        $query->where('kelas', $kelas)
              ->where('jurusan', $jurusan_loop);

        $data_per_jurusan[$jurusan_loop] = $query->paginate(5, ['*'], 'page_'.$jurusan_loop);
    }
    return view('siswa.alumni.data_alumni', compact('data_per_jurusan', 'list_jurusan', 'kelas'));
    }

    public function hapusalumn(Request $request, $id){
        $siswa = Siswa::FindOrFail($id);
        $siswa->delete();
        return redirect()->route('dataalumni')->with('success','Data berhasil dihapus!');
    }

    
   }
   

