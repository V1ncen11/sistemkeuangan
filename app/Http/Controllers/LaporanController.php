<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tabungan;
use App\Models\Pembayaran;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function harian(Request $request)
    {
        // Kalau gak ada request tanggal, default hari ini
        $tanggal = $request->input('tanggal') ?? Carbon::today()->toDateString();

        // 🔹 Ambil data Tabungan
        $tabungan = Tabungan::whereDate('created_at', $tanggal)
            ->with('siswa')
            ->get()
            ->map(function($t) {
                return [
                    'waktu'      => $t->created_at->format('H:i'),
                    'tipe'       => ucfirst($t->tipe), // setor / tarik
                    'jenis'      => 'Tabungan',
                    'nama'       => $t->siswa->nama ?? '-',
                    'keterangan' => '-',
                    'masuk'      => $t->tipe == 'setor' ? $t->jumlah : 0,
                    'keluar'     => $t->tipe == 'tarik' ? $t->jumlah : 0,
                ];
            });

        //Ambil data Pembayaran
        $pembayaran = Pembayaran::whereDate('created_at', $tanggal)
            ->with('siswa') // relasi siswa
            ->get()
            ->map(function($p) {
                return [
                    'waktu'      => $p->created_at->format('H:i'),
                    'tipe'       => '-',
                    'jenis'      => ucfirst($p->jenis), // pembayaran / pengeluaran
                    'nama'       => $p->siswa->nama ?? '-',
                    'keterangan' => $p->keterangan ?? '-',
                    'masuk'      => $p->jenis == 'pemasukan' ? $p->jumlah : 0,
                    'keluar'     => $p->jenis == 'pengeluaran' ? $p->jumlah : 0,
                ];
            });

        // 🔹 Gabungkan semua transaksi
        $laporan = $tabungan->merge($pembayaran)->sortBy('waktu')->values();

        // 🔹 Hitung total
        $totalMasuk  = $laporan->sum('masuk');
        $totalKeluar = $laporan->sum('keluar');
        $saldoAkhir  = $totalMasuk - $totalKeluar;

        return view('pages.laporan.harian', [
            'tanggal'      => Carbon::parse($tanggal)->translatedFormat('d F Y'),
            'laporan'      => $laporan,
            'totalMasuk'   => $totalMasuk,
            'totalKeluar'  => $totalKeluar,
            'saldoAkhir'   => $saldoAkhir,
        ]);
    }
}
