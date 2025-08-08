<?php

namespace App\Http\Controllers;

use App\Models\JenisPembayaran;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class JenisPembayaranController extends Controller
{
    public function index()
    {
        $jenisPembayaran = JenisPembayaran::all();
        return view('pages.transaksi.jenis-p.jenis_pembayaran', compact('jenisPembayaran'));
    }

    public function getJenisPembayaranByNIS($nis)
    {
        $siswa = Siswa::where('nis', $nis)->first();

        if (!$siswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Siswa tidak ditemukan'
            ], 404);
        }

        $jenisPembayaran = JenisPembayaran::where('tingkat_kelas', $siswa->kelas)->get();

        return response()->json([
            'status' => 'success',
            'data' => $jenisPembayaran
        ]);
    }

    public function create()
{
    return view('pages.transaksi.jenis-p.tambah_jenis-p');
}

public function store(Request $request)
{
    $request->validate([
        'nama_pembayaran' => 'required|string',
        'tingkat_kelas' => 'required|string',
        'jumlah' => 'required|numeric|min:0', // tambahkan ini
    ]);

    JenisPembayaran::create($request->only('nama_pembayaran', 'tingkat_kelas','jumlah'));

    return redirect()->route('jenispembayaran')->with('success', 'Jenis pembayaran berhasil ditambahkan');
}

}
