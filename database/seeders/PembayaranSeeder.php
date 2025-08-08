<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        // Ambil ID siswa pertama
        $siswaId = Siswa::first()->id;

        // Ambil ID jenis pembayaran pertama
        $jenisPembayaranId = DB::table('jenis_pembayaran')->value('id');

        // Insert data dummy
        DB::table('pembayaran')->insert([
            'siswa_id' => $siswaId,
            'jenis_pembayaran_id' => $jenisPembayaranId,
            'jumlah' => 50000,
            'tanggal' => now(),
            'keterangan' => 'Pembayaran pertama',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
