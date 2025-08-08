<?php
namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\JenisPembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        // ambil kelas dari query param (contoh ?kelas=X), default X
        $kelas = $request->get('kelas', 'X');

        // data siswa (bisa paginate atau get)
        $siswa = Siswa::with('pembayaran.jenisPembayaran')
        ->where('kelas', $kelas)
        ->orderBy('nama')
        ->paginate(10);


        // jenis pembayaran sesuai kelas (dipake buat dropdown modal)
        $jenisPembayaran = JenisPembayaran::where('tingkat_kelas', $kelas)->get();

        // list transaksi pembayaran buat tabel (optional)
        $pembayaran = Pembayaran::with(['siswa','jenisPembayaran'])->latest()->paginate(15);

        return view('pages.transaksi.pembayaran', compact('siswa','jenisPembayaran','pembayaran'));
    }
}

