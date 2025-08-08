<?php

namespace Database\Seeders;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPembayaranSeeder extends Seeder
{
    public function run(): void
    {
        $jenisPembayaranId = \DB::table('jenis_pembayaran')->insertGetId([
            'nama_pembayaran' => 'MPLS',
            'tingkat_kelas' => 'X',
        ]);
    }
}
