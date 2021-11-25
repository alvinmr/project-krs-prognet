<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Authenticatable
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $fillable = [
        'nim', 'nama', 'alamat', 'telepon', 'angkatan', 'foto_mahasiswa',
        'password', 'prodi_id'
    ];

    public $timestamps = false;

    public function prodi()
    {
        return $this->hasMany(Prodi::class);
    }
}

