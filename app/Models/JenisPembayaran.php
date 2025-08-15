<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPembayaran extends Model
{
    protected $table = 'jenis_pembayaran';
    protected $fillable = [
        'nama_pembayaran', // ini yang bikin error kalau belum ada
        'deskripsi',
        'tingkat_kelas',
        'jumlah', // kalau ada
    ];

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'jenis_pembayaran_id', 'id');
    }
}
