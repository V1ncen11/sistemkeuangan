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

    // Ambil hanya tingkat kelas (X, XI, XII, Alumni)
    $tingkatKelas = strtoupper(trim(explode(' ', $siswa->kelas)[0]));

    // Filter berdasarkan tingkat kelas atau 'Semua'
    $jenisPembayaran = JenisPembayaran::where(function($q) use ($tingkatKelas) {
        $q->where('tingkat_kelas', $tingkatKelas)
          ->orWhere('tingkat_kelas', 'Semua');
    })->get();

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

public function getDetailPembayaran($nis)
{
    $siswa = Siswa::with(['jenis_pembayaran', 'pembayaran.jenisPembayaran'])
        ->where('nis', $nis)
        ->firstOrFail();

    return response()->json([
        'status' => 'success',
        'data' => [
            'nis' => $siswa->nis,
            'nama' => $siswa->nama,
            'total_tagihan' => $siswa->total_tagihan,
            'total_bayar' => $siswa->total_bayar,
            'sisa_tagihan' => $siswa->sisa_tagihan,
            'jenis_pembayaran' => $siswa->jenis_pembayaran
        ]
    ]);
}

public function getHistoryPembayaran($nis)
{
    // Cari siswa berdasarkan NIS
    $siswa = Siswa::where('nis', $nis)->firstOrFail();

    // Ambil pembayaran berdasarkan siswa_id
    $pembayaran = Pembayaran::with('jenisPembayaran')
        ->where('siswa_id', $siswa->id)
        ->get()
        ->map(function($item) {
            return [
                'tanggal' => $item->created_at->format('d-m-Y'),
                'jenis_pembayaran' => $item->jenisPembayaran->nama_pembayaran,
                'jumlah' => $item->jumlah,
                'status' => $item->keterangan // ini buat nampilin status
            ];
        });

    return response()->json([
        'status' => 'success',
        'data' => $pembayaran
    ]);
}


public function destroy($id)
{
    $jenis = JenisPembayaran::findOrFail($id);
    $jenis->delete();

    return redirect()->route('jenispembayaran')->with('success', 'Jenis pembayaran berhasil dihapus');
}

}
