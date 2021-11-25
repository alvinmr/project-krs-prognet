<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Matakuliah extends Model
{
    use HasFactory;
    protected $table = 'matakuliah';
    protected $fillable = [
        'kode', 'nama_matakuliah', 'semester', 'status_matakuliah',
        'jam_mulai', 'jam_selesai', 'dosen_id', 'prodi_id'
    ];

    public $timestamps = false;

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}

