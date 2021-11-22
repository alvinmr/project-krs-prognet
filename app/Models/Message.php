<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    use HasFactory;
    protected $table='message';
    protected $fillable=['pesan', 'pegawai_id', 'mahasiswa_id'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
