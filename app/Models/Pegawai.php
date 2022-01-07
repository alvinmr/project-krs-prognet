<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Pegawai extends Authenticatable
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $keyType = 'string';
    protected $fillable = ['nama', 'alamat', 'telepon', 'nip', 'password'];
    public $timestamps = false;

    public function messages()
    {
        return $this->hasMany(Messages::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}