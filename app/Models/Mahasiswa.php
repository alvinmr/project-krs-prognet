<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table='Mahasiswa';
    protected $fillable=['nim', 'nama', 'alamat', 'telepon', 'angkatan', 'foto_mahasiswa',
    'password', 'prodi_id'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
