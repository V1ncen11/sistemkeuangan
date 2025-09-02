<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tabungan;
use App\Models\Siswa;
use Carbon\Carbon;

class TabunganController extends Controller
{
    public function index(Request $request)
    {
        $kelas = $request->kelas ?? 'X'; // default X
    
        // paginate siswa dulu
        $siswa = \App\Models\Siswa::where('kelas', $kelas)
            ->paginate(5)
            ->withQueryString(); // biar query kelas tetap kebawa
    
        // transform data, tapi tetap paginator
        $siswa->getCollection()->transform(function ($s) {
            $last = $s->tabungan()->latest('id')->first();
            return [
                'id'      => $s->id,
                'nama'    => $s->nama,
                'tipe'    => $last->tipe ?? '-',
                'jumlah'  => $last->jumlah ?? 0,
                'saldo'   => $last->saldo ?? 0,
                'tanggal' => $last?->tanggal ?? '-',
            ];
        });
    
        return view('pages.transaksi.tabungan', [
            'data'  => $siswa,
            'kelas' => $kelas,
        ]);
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'tipe'     => 'required|in:setor,tarik',
            'jumlah'   => 'required|numeric|min:1',
        ]);
    
        // ambil saldo terakhir khusus siswa ini
        $saldoTerakhir = Tabungan::where('siswa_id', $request->siswa_id)
            ->orderBy('id', 'desc')
            ->value('saldo') ?? 0;
    
        // cek kalau mau tarik lebih besar dari saldo
        if ($request->tipe === 'tarik' && $request->jumlah > $saldoTerakhir) {
            return redirect()->back()->withInput()->with('error', 'Saldo tidak cukup untuk melakukan penarikan!');
        }
    
        // hitung saldo baru
        $saldoBaru = $request->tipe === 'setor'
            ? $saldoTerakhir + $request->jumlah
            : $saldoTerakhir - $request->jumlah;
    
        // simpan transaksi baru (sebagai riwayat)
        $tabungan = new Tabungan();
        $tabungan->siswa_id = $request->siswa_id;
        $tabungan->tipe     = $request->tipe;
        $tabungan->jumlah   = $request->jumlah;
        $tabungan->saldo    = $saldoBaru;
        $tabungan->tanggal  = now();
        $tabungan->save();
    
        return redirect()->back()->with('success', 'Transaksi berhasil!');
    }
    

public function riwayat($id)
{
    $siswa = Siswa::with('tabungan')->findOrFail($id);

    $saldoTerakhir = $siswa->tabungan()->orderBy('id', 'desc')->value('saldo') ?? 0;

    return response()->json([
        'nis'     => $siswa->nis,
        'nama'    => $siswa->nama,
        'jurusan' => $siswa->jurusan,
        'saldo'   => number_format($saldoTerakhir, 0, ',', '.'),
        'riwayat' => $siswa->tabungan->map(function($t) {
            return [
                'tanggal' => $t->created_at->format('Y-m-d'),
                'tipe'    => ucfirst($t->tipe),
                'jumlah'  => number_format($t->jumlah, 0, ',', '.'),
            ];
        }),
    ]);
}



}
