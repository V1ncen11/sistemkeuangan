<?php

namespace App\Http\Controllers;
use App\Models\JenisPengeluaran;
use Illuminate\Http\Request;

class JenisPengeluaranController extends Controller
{
    public function index(){
        $jenis = JenisPengeluaran::all();
        return view('pages.transaksi.jenis-pengeluaran.jenis_pengeluaran', compact('jenis'));
    }

    public function create(){
        return view('pages.transaksi.jenis-pengeluaran.tambah_jenispengeluaran');
    }

    public function store(Request $request){
        $request->validate([
            'nama'=>'required|string|max:225',
        ]);
        JenisPengeluaran::create([
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('jenis_pengeluaran')
            ->with('success', 'Jenis pengeluaran berhasil ditambahkan.');
    }
}
