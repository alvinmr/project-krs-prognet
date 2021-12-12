<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKrs extends Model
{
    use HasFactory;
    protected $table = 'transaksi_krs';
    protected $fillable = ['tahun_ajaran', 'semester', 'nilai', 'status', 'matakuliah_id', 'mahasiswa_id'];
    public $timestamps = false; 

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
