<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';
    protected $fillable = ['tanggal','jenis_pengeluaran_id','jumlah','deskripsi'];

    public function jenisPengeluaran()
    {
        return $this->belongsTo(JenisPengeluaran::class, 'jenis_pengeluaran_id');
    }

    public function kas() {
            return $this->belongsTo(Kas::class);
        }
    }
    

