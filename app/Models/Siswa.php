<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $guarded = [];

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'siswa_id');
    }
    public function jenisPembayaran()
{
    return $this->belongsTo(JenisPembayaran::class, 'jenis_pembayaran_id');
}
}
