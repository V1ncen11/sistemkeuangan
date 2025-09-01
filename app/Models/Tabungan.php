<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
class Tabungan extends Model
{
    use HasFactory;

    protected $table = 'tabungan';

    protected $fillable = [
        'siswa_id',
        'tipe',
        'jumlah',
        'saldo',
        'tanggal',
    ];

    // Relasi ke siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    
    
}
