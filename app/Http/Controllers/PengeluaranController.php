<?php

namespace App\Http\Controllers;
use App\Models\Pengeluaran;
use App\Models\JenisPengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
           $pengeluaran = Pengeluaran::with('jenisPengeluaran')
        ->orderBy('tanggal', 'desc') // urutkan berdasarkan tanggal terbaru
        ->paginate(5);

    $jenisPengeluaran = JenisPengeluaran::all();

    return view('pages.transaksi.pengeluaran', compact('pengeluaran', 'jenisPengeluaran'));
}
public function store(Request $request)
{
    $request->validate([
        'tanggal' => 'required|date',
        'jenis_pengeluaran_id' => 'required|exists:jenis_pengeluaran,id',
        'jumlah' => 'required|numeric|min:1',
        'deskripsi' => 'nullable|string|max:255',
    ]);

    Pengeluaran::create([
        'tanggal' => $request->tanggal,
        'jenis_pengeluaran_id' => $request->jenis_pengeluaran_id,
        'jumlah' => $request->jumlah,
        'deskripsi' => $request->deskripsi,
    ]);
    
    return redirect()
        ->route('pengeluaran')
        ->with('success', 'Pengeluaran berhasil ditambahkan.');
}
}