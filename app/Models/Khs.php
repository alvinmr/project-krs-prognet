<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khs extends Model
{
    use HasFactory;
    protected $table = 'Khs';
    protected $fillable = ['nim', 'nama', 'tahun_ajaran', 'semester', 'kode_matkul', 'nama_matkul', 'jumlah_sks', 'nilai_huruf', 'nilai_bobot', 'mahasiswa_id'];
    public $timestamps = false; 

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}

