<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\Kas;

class HalutamaController extends Controller
{
    public function dashboard()
    {
        $jumlahSiswa = Siswa::count();
        $totalTransaksi = Pembayaran::sum('jumlah');

        $kasMasuk = Kas::where('tipe', 'masuk')->sum('jumlah');
        $kasKeluar = Kas::where('tipe', 'keluar')->sum('jumlah');
        $kasSekolah = $kasMasuk - $kasKeluar;

        $pengeluaran = $kasKeluar;
        $transaksiTerbaru = Pembayaran::with(['siswa', 'jenisPembayaran'])
        ->orderBy('tanggal', 'desc')
        ->take(5)
        ->get();
    
        return view('hal_utama', compact(
            'jumlahSiswa',
            'totalTransaksi',
            'kasSekolah',
            'pengeluaran',
            'transaksiTerbaru'
        ));
    }
}
