<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

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
        return $this->belongsTo(Prodi::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public static function getEnumKey($name)
    {
        $instance = new static; // create an instance of the model to be able to get the table name
        $type = DB::select(DB::raw('SHOW COLUMNS FROM ' . $instance->getTable() . ' WHERE Field = "' . $name . '"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum[] = $v;
        }
        return $enum;
    }
}