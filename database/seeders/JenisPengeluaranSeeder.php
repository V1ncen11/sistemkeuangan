<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_pengeluaran')->insert([
            ['nama' => 'Listrik', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Air', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'ATK', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Gaji Guru', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Perawatan Sekolah', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
