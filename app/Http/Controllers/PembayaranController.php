<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\JenisPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $kelas = $request->get('kelas');

        $query = Siswa::with(['pembayaran.jenisPembayaran', 'jenis_pembayaran']);
        if ($kelas) {
            $query->where('kelas', $kelas);
        }

        $data = $query->get();

        foreach ($data as $item) {
            $item->belum_dibayar = collect();
            $totalTagihan = 0;
            $totalBayar = 0;

            foreach ($item->jenis_pembayaran as $jp) {
                $jumlah = $jp->jumlah ?? 0;
                $dibayar = $item->pembayaran
                    ->where('jenis_pembayaran_id', $jp->id)
                    ->sum('jumlah');

                $totalTagihan += $jumlah;
                $totalBayar += $dibayar;

                if ($jumlah > $dibayar) {
                    $item->belum_dibayar->push((object) [
                        'nama_pembayaran' => $jp->nama_pembayaran,
                        'jumlah' => $jumlah - $dibayar
                    ]);
                }
            }

            $item->total_tagihan = $totalTagihan;
            $item->total_bayar = $totalBayar;
            $item->sisa_tagihan = $totalTagihan - $totalBayar;
            $item->status = $item->sisa_tagihan <= 0 ? 'Lunas' : 'Belum Lunas';
        }

        return view('pages.transaksi.pembayaran', compact('data', 'kelas'));
    }

    public function getPembayaran($id)
{
    // Ambil data siswa beserta pembayarannya
    $siswa = Siswa::with('pembayaran')->findOrFail($id);

    // Ambil jenis pembayaran yang sesuai tingkat kelas siswa
    $jenis_pembayaran = JenisPembayaran::where('tingkat_kelas', $siswa->kelas)
        ->get()
        ->map(function ($jp) use ($siswa) {
            $total = $jp->nominal ?? 0; // Pastikan ada kolom nominal di tabel
            $dibayar = $siswa->pembayaran
                ->where('jenis_pembayaran_id', $jp->id)
                ->sum('jumlah');

            return [
                'id' => $jp->id,
                'nama_jenis' => $jp->nama_pembayaran,
                'total' => $total,
                'sudah_dibayar' => $dibayar
            ];
        });

    return response()->json([
        'id' => $siswa->id,
        'nis' => $siswa->nis,
        'nama' => $siswa->nama,
        'jenis' => $jenis_pembayaran
    ]);
}


public function getTagihan($siswaId, $jenisId)
{
    $siswa = Siswa::with('pembayaran')->findOrFail($siswaId);

    $jenis = JenisPembayaran::findOrFail($jenisId);

    $total = $jenis->jumlah ?? 0;
    $dibayar = $siswa->pembayaran
        ->where('jenis_pembayaran_id', $jenisId)
        ->sum('jumlah');
    $sisa = $total - $dibayar;

    return response()->json([
        'total' => $total,
        'sudah_dibayar' => $dibayar,
        'sisa' => $sisa
    ]);
}

    public function filter(Request $request)
    {
        $query = Siswa::query();

        if ($request->kelas) {
            $query->where('kelas', $request->kelas);
        }

        $data = $query->orderBy('nama', 'asc')->get();

        return response()->json($data);
    }

    public function store(Request $request)
{
    $request->validate([
        'siswa_id' => 'required|exists:siswa,id',
        'jenis_pembayaran_id' => 'required|exists:jenis_pembayaran,id',
        'jumlah' => 'required|numeric|min:1',
        'keterangan' => 'nullable|string|max:255', // status diinput manual
    ]);

    Pembayaran::create([
        'siswa_id' => $request->siswa_id,
        'jenis_pembayaran_id' => $request->jenis_pembayaran_id,
        'jumlah' => $request->jumlah,
        'tanggal' => now(),
        'keterangan' => $request->keterangan // langsung simpan dari admin
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Pembayaran berhasil disimpan.'
    ]);
}

}
