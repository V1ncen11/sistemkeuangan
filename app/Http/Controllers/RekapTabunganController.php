<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Tabungan;
use PDF;
use DB;

class RekapTabunganController extends Controller
{
     public function index(Request $request)
    {
        // ambil input dan normalisasi
        $kelas = trim($request->input('kelas', 'semua')); 
        $cari  = trim($request->input('cari', ''));

        // samain case biar ga error (huruf besar semua)
        $kelas = strtoupper($kelas);

        // query dasar
        $query = Siswa::withSum('tabungan as total_tabungan', 'jumlah');

        // filter kelas
        if ($kelas !== 'SEMUA') {
            $query->where('kelas', $kelas);
        } else {
            $query->where('kelas', '!=', 'Alumni');
        }

        // filter nama
        if (!empty($cari)) {
            $query->where('nama', 'like', '%' . $cari . '%');
        }

        $siswa = $query->orderBy('nama')->paginate(10);

        // cek hasil filter
        // dd($kelas, $siswa->pluck('kelas')->unique());

        return view('pages.laporan.rekap_tabungan', [
            'siswa' => $siswa,
            'kelas' => $kelas,
            'cari'  => $cari,
        ]);
    }

    public function cetakPdf(Request $request)
    {
        // ambil input kelas (default: semua)
        $kelas = strtolower($request->input('kelas', 'semua'));
        $cari  = $request->input('cari', '');
    
        // query siswa + total tabungan
        $query = Siswa::withSum('tabungan as total_tabungan', 'jumlah');
    
        // filter kelas
        if ($kelas !== 'semua') {
            $query->where('kelas', strtoupper($kelas));
        } else {
            // kalau "semua" → ambil semua kecuali alumni
            $query->where('kelas', '!=', 'Alumni');
        }
    
        // filter pencarian nama
        if (!empty($cari)) {
            $query->where('nama', 'like', '%' . $cari . '%');
        }
    
        // ambil data siswa
        $siswa = $query->orderBy('nama')->get();
    
        // debug dulu kalau kosong
        // dd($siswa->toArray());
    
        // kirim ke PDF
        $pdf = Pdf::loadView('pages.laporan.rekap_tabungan_pdf', [
            'siswa' => $siswa,
            'kelas' => $kelas,
            'cari'  => $cari,
        ])->setPaper('a4', 'portrait');
    
        return $pdf->download('rekap_tabungan.pdf');

}
}
