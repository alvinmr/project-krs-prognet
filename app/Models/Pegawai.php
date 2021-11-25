<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Authenticatable
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $fillable = ['nama', 'alamat', 'telepon', 'nip', 'password'];
    public $timestamps = false;
}

