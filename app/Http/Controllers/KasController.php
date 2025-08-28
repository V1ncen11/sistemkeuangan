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
    $kas = Kas::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->paginate(10);


    $totalMasuk = Kas::where('tipe', 'masuk')->sum('jumlah');
    $totalKeluar = Kas::where('tipe', 'keluar')->sum('jumlah');
    $saldoAkhir = $totalMasuk - $totalKeluar;

    return view('pages.transaksi.kas', compact('kas', 'totalMasuk', 'totalKeluar', 'saldoAkhir'));
    
}
public static function fromPembayaran(Pembayaran $pembayaran)

{
    Kas::create([
        'tanggal' => $pembayaran->tanggal,
        'tipe' => 'masuk',
        'pembayaran_id' => $pembayaran->id,
        'jumlah' => $pembayaran->jumlah,
        'deskripsi' => $pembayaran->keterangan,
        'sumber' => $pembayaran->siswa->nama ?? 'Pembayaran Siswa', // <-- otomatis isi nama siswa
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

public function create(){
    return view('pages.transaksi.tambahkas');
}
public function store(Request $request)
{
    $request->validate([
        'tanggal' => 'required|date',
        'deskripsi' => 'required|string|max:255',
        'sumber' => 'required|string|max:255',
        'tipe' => 'required|in:masuk,keluar',
        'jumlah' => 'required|numeric|min:1',
    ]);

    Kas::create([
        'tanggal' => $request->tanggal,
        'deskripsi' => $request->deskripsi,
        'sumber' => $request->sumber,
        'tipe' => $request->tipe,
        'jumlah' => $request->jumlah,
    ]);

    return redirect()->route('transaksi.kas')
                     ->with('success', 'Transaksi kas berhasil ditambahkan!');
}

public function destroy($id)
{
    $kas = Kas::findOrFail($id);
    $kas->delete();

    return redirect()->back()->with('success', 'Data kas berhasil dihapus!');
}


}
