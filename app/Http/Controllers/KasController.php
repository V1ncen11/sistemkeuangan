<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kas;
use App\Models\Pengeluaran;
use App\Models\Pembayaran;


class KasController extends Controller
{
    public function index()
{
    $kas = Kas::latest()->get();
    return view('pages.transaksi.kas', compact('kas'));
    
}
public static function fromPembayaran(Pembayaran $pembayaran)

{
    Kas::create([
        'tanggal' => $pembayaran->tanggal,
        'tipe' => 'masuk',
        'pembayaran_id' => $pembayaran->id,
        'jumlah' => $pembayaran->jumlah,
        'deskripsi' => $pembayaran->keterangan,
    ]);
}

// helper kalau ada pengeluaran
public static function fromPengeluaran(Pengeluaran $pengeluaran)
{
    Kas::create([
        'tanggal' => $pengeluaran->tanggal,
        'tipe' => 'keluar',
        'pengeluaran_id' => $pengeluaran->id,
        'jumlah' => $pengeluaran->jumlah,
        'deskripsi' => $pengeluaran->deskripsi,
    ]);
}
}
