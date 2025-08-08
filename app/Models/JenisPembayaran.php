<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPembayaran extends Model
{
    use HasFactory;
    protected $table = 'jenis_pembayaran';
    protected $fillable = ['nama_pembayaran','tingkat_kelas','jumlah'];

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
