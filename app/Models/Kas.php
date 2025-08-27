<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model {
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'tipe',
        'sumber',
        'deskripsi',
        'jumlah',
        'pembayaran_id',
        'pengeluaran_id',
    ];

    public function pembayaran() {
        return $this->belongsTo(Pembayaran::class, 'pembayaran_id');
    }

    public function pengeluaran() {
        return $this->belongsTo(Pengeluaran::class, 'pengeluaran_id');
    }
}
