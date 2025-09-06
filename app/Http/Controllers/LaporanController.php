<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tabungan;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Pagination\LengthAwarePaginator;

class LaporanController extends Controller
{
 

    public function harian(Request $request)
    {
        $tanggal = $request->input('tanggal', now()->toDateString());
    
        // Tabungan -> array lalu jadikan base collection
        $tabungan = Tabungan::whereDate('created_at', $tanggal)
            ->with('siswa')
            ->get()
            ->map(function ($t) {
                return [
                  
                
                    'waktu'      => $t->created_at->format('H:i'),
                    'nama'       => $t->siswa->nama ?? '-',
                    'tipe'       => 'Tabungan',               // selalu Tabungan
                    'jenis'      => ucfirst($t->tipe),        // Setor / Tarik
                    'keterangan' => '-',
                    'masuk'      => $t->tipe == 'setor' ? (int) $t->jumlah : 0,
                    'keluar'     => $t->tipe == 'tarik' ? (int) $t->jumlah : 0,
                ];
            })
            ->values()
            ->toBase(); // penting!
    
        // Pembayaran -> array lalu jadikan base collection
        $pembayaran = Pembayaran::whereDate('created_at', $tanggal)
            ->with(['siswa', 'jenisPembayaran'])
            ->get()
            ->map(function ($p) {
                return [
            
                    'waktu'      => $p->created_at->format('H:i'),
                    'nama'       => $p->siswa->nama ?? '-',
                    'tipe'       => 'Pembayaran',                             // selalu Pembayaran
                    'jenis'      => $p->jenisPembayaran->nama_pembayaran ?? '-', // contoh: UANG MBG
                    'keterangan' => $p->keterangan ?? '-',
                    'masuk'      => (int) $p->jumlah,
                    'keluar'     => 0,
];
            })
            ->values()
            ->toBase();
    
        // Gabungkan & urutkan
        $laporan = $tabungan->concat($pembayaran)->sortBy('waktu')->values();
    
        // Totals
        $totalMasuk  = $laporan->sum('masuk');
        $totalKeluar = $laporan->sum('keluar');
        $saldoAkhir  = $totalMasuk - $totalKeluar;
    
        return view('pages.laporan.harian', [
            'tanggal'     => $tanggal,     // biar <input type="date"> aman
            'laporan'     => $laporan,     // isinya array
            'totalMasuk'  => $totalMasuk,
            'totalKeluar' => $totalKeluar,
            'saldoAkhir'  => $saldoAkhir,
        ]);
    }
    
    public function cetakHarian(Request $request)
{
    $tanggal = $request->input('tanggal') ?? now()->toDateString();

    // Ambil data sama kayak method harian()
    $tabungan = Tabungan::whereDate('created_at', $tanggal)
        ->with('siswa')
        ->get()
        ->map(function($t) {
            return [
                'waktu'      => $t->created_at->format('H:i'),
                'tipe'       => ucfirst($t->tipe),
                'jenis'      => 'Tabungan',
                'nama'       => $t->siswa->nama ?? '-',
                'keterangan' => '-',
                'masuk'      => $t->tipe == 'setor' ? $t->jumlah : 0,
                'keluar'     => $t->tipe == 'tarik' ? $t->jumlah : 0,
            ];
        });

        $pembayaran = Pembayaran::whereDate('created_at', $tanggal)
        ->with(['siswa','jenisPembayaran'])
        ->get()
        ->map(function($p) {
            return [
                'waktu'      => $p->created_at->format('H:i'),
                'tipe'       => 'Pembayaran',
                'jenis'      => $p->jenisPembayaran->nama_pembayaran ?? '-',
                'nama'       => $p->siswa->nama ?? '-',
                'keterangan' => $p->keterangan ?? '-',
                'masuk'      => $p->jumlah, 
                'keluar'     => 0,
            ];
        });
    
    $laporan = $tabungan->merge($pembayaran)->sortBy('waktu')->values();

    $totalMasuk  = $laporan->sum('masuk');
    $totalKeluar = $laporan->sum('keluar');
    $saldoAkhir  = $totalMasuk - $totalKeluar;

    // Render PDF
    $pdf = Pdf::loadView('pages.laporan.laporan_pdf', compact(
        'tanggal', 'laporan', 'totalMasuk', 'totalKeluar', 'saldoAkhir'
    ));

    return $pdf->download('laporan-harian-'.$tanggal.'.pdf');
}

public function bulanan(Request $request)
{
    $bulan = $request->input('bulan') ?? now()->format('m');
    $tahun = $request->input('tahun') ?? now()->year;

    // 🔹 Ambil data Tabungan
    $tabungan = Tabungan::whereYear('created_at', $tahun)
        ->whereMonth('created_at', $bulan)
        ->with('siswa')
        ->get()
        ->map(function($t) {
            return [
                'tanggal'    => $t->created_at->format('d-m-Y'),

                'nama'       => $t->siswa->nama ?? '-',
                'tipe'       => 'Tabungan',             // selalu Tabungan
                'jenis'      => ucfirst($t->tipe),      // Setor / Tarik
                'keterangan' => '-',
                'masuk'      => $t->tipe == 'setor' ? (int) $t->jumlah : 0,
                'keluar'     => $t->tipe == 'tarik' ? (int) $t->jumlah : 0,
            ];
        });

    // 🔹 Ambil data Pembayaran
    $pembayaran = Pembayaran::whereYear('created_at', $tahun)
        ->whereMonth('created_at', $bulan)
        ->with(['siswa','jenisPembayaran'])
        ->get()
        ->map(function($p) {
            return [
                'tanggal'    => $p->created_at->format('d-m-Y'),
                'nama'       => $p->siswa->nama ?? '-',
                'tipe'       => 'Pembayaran',                             // selalu Pembayaran
                'jenis'      => $p->jenisPembayaran->nama_pembayaran ?? '-', // contoh: UANG MBG
                'keterangan' => $p->keterangan ?? '-',
                'masuk'      => (int) $p->jumlah,
                'keluar'     => 0,
            ];
        });

    // 🔹 Gabung semua transaksi
    $laporan = $tabungan->concat($pembayaran)->sortBy('tanggal')->values();

    // 🔹 Hitung total
    $totalMasuk  = $laporan->sum('masuk');
    $totalKeluar = $laporan->sum('keluar');
    $saldoAkhir  = $totalMasuk - $totalKeluar;

    return view('pages.laporan.bulanan', [
        'laporan'     => $laporan,
        'totalMasuk'  => $totalMasuk,
        'totalKeluar' => $totalKeluar,
        'saldoAkhir'  => $saldoAkhir,
        'bulan'       => $bulan,
        'tahun'       => $tahun,
    ]);
}

public function bulananPdf(Request $request)
{
    $bulan = $request->input('bulan') ?? date('m');
    $tahun = $request->input('tahun') ?? date('Y');


    $tabungan = Tabungan::whereMonth('created_at', $bulan)
        ->whereYear('created_at', $tahun)
        ->with('siswa')
        ->get()
        ->map(function($t) {
            return [
                'tanggal'    => $t->created_at->format('d-m-Y'),
                'waktu'      => $t->created_at->format('H:i'),
                'tipe'       => ucfirst($t->tipe),
                'jenis'      => 'Tabungan',
                'nama'       => $t->siswa->nama ?? '-',
                'keterangan' => '-',
                'masuk'      => $t->tipe == 'setor' ? $t->jumlah : 0,
                'keluar'     => $t->tipe == 'tarik' ? $t->jumlah : 0,
            ];
        });

    // 🔹 Ambil pembayaran
    $pembayaran = Pembayaran::whereMonth('created_at', $bulan)
        ->whereYear('created_at', $tahun)
        ->with('siswa')
        ->get()
        ->map(function($p) {
            return [
                'tanggal'    => $p->created_at->format('d-m-Y'),
                'waktu'      => $p->created_at->format('H:i'),
                'tipe'       => '-',
                'jenis'      => ucfirst($p->jenis),
                'nama'       => $p->siswa->nama ?? '-',
                'keterangan' => $p->keterangan ?? '-',
                'masuk'      => $p->jenis == 'pemasukan' ? $p->jumlah : 0,
                'keluar'     => $p->jenis == 'pengeluaran' ? $p->jumlah : 0,
            ];
        });

    // 🔹 Gabungkan
    $laporan = $tabungan->merge($pembayaran)->sortBy('tanggal')->values();

    // 🔹 Hitung total
    $totalMasuk  = $laporan->sum('masuk');
    $totalKeluar = $laporan->sum('keluar');
    $saldoAkhir  = $totalMasuk - $totalKeluar;

    // 🔹 Load PDF
    $pdf = Pdf::loadView('pages.laporan.bulanan_pdf', [
        'bulan'       => $bulan,
        'tahun'       => $tahun,
        'laporan'     => $laporan,
        'totalMasuk'  => $totalMasuk,
        'totalKeluar' => $totalKeluar,
        'saldoAkhir'  => $saldoAkhir,
    ])->setPaper('a4', 'portrait');

    return $pdf->download("laporan-bulanan-{$bulan}-{$tahun}.pdf");
}

}


