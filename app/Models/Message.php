<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function message_pegawai()
    {
        return $this->belongsTo(MessagePegawai::class);
    }

    public function message_mahasiswa()
    {
        return $this->belongsTo(MessageMahasiswa::class);
    }
}