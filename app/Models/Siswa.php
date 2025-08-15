<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $guarded = [];


    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'siswa_id', 'id');
    }

    // Relasi ke jenis pembayaran berdasar kelas
    public function jenis_pembayaran()
    {
        return $this->hasMany(JenisPembayaran::class, 'tingkat_kelas', 'kelas');
    }
}
