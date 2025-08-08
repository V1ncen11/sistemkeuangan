<?php

namespace Database\Seeders;
use App\Models\Siswa;
use App\Models\Pembayaran;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $siswa = \DB::table('siswa')->insertGetId([
            'nis' => '102220215',
            'nama' => 'Kevin Nurachma',
            'jurusan' => 'TBSM',
            'kelas' => 'X',
        ]);
    }
}
