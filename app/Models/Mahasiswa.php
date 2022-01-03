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

    public function matakuliah()
    {
        return $this->belongsToMany(Matakuliah::class, 'transaksi_krs');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function transaksi_krs()
    {
        return $this->hasMany(TransaksiKrs::class);
    }

    public function getLastTahunAjaran()
    {
        return TahunAjaran::orderBy('id', 'desc')->first()->id;
    }

    public function getJumlahSks($tahun_ajaran_id = null)
    {
        if ($tahun_ajaran_id) {
            return $this->matakuliah()->where('matakuliah.tahun_ajaran_id', $tahun_ajaran_id)->sum('jumlah_sks');
        } else {
            return $this->matakuliah()->sum('jumlah_sks');
        }
    }

    public function getIpkAttribute()
    {
        $indeks_prestasi = 0;
        foreach ($this->transaksi_krs as $krs) {
            if ($krs->nilai == 'A') {
                $indeks_prestasi += $krs->matakuliah->jumlah_sks * 4.0;
            } else if ($krs->nilai == 'B+') {
                $indeks_prestasi += $krs->matakuliah->jumlah_sks * 3.5;
            } else if ($krs->nilai == 'B') {
                $indeks_prestasi += $krs->matakuliah->jumlah_sks * 3.0;
            } else if ($krs->nilai == 'C+') {
                $indeks_prestasi += $krs->matakuliah->jumlah_sks * 2.5;
            } else if ($krs->nilai == 'C') {
                $indeks_prestasi += $krs->matakuliah->jumlah_sks * 2.0;
            } else if ($krs->nilai == 'D+') {
                $indeks_prestasi += $krs->matakuliah->jumlah_sks * 1.5;
            } else if ($krs->nilai == 'D') {
                $indeks_prestasi += $krs->matakuliah->jumlah_sks * 1.0;
            } else if ($krs->nilai == 'E') {
                $indeks_prestasi += $krs->matakuliah->jumlah_sks * 0;
            }
        }
        $indeks_prestasi = $indeks_prestasi / $this->getJumlahSks();
        return number_format($indeks_prestasi, 1);
    }

    public function getIps($tahun_ajaran_id = null)
    {
        $indeks_prestasi = 0;
        $tahun_ajaran_id ??= $this->getLastTahunAjaran();
        foreach ($this->transaksi_krs->where('tahun_ajaran_id', $tahun_ajaran_id) as $krs) {
            if ($krs->nilai == 'A') {
                $indeks_prestasi += $krs->matakuliah->jumlah_sks * 4.0;
            } else if ($krs->nilai == 'B+') {
                $indeks_prestasi += $krs->matakuliah->jumlah_sks * 3.5;
            } else if ($krs->nilai == 'B') {
                $indeks_prestasi += $krs->matakuliah->jumlah_sks * 3.0;
            } else if ($krs->nilai == 'C+') {
                $indeks_prestasi += $krs->matakuliah->jumlah_sks * 2.5;
            } else if ($krs->nilai == 'C') {
                $indeks_prestasi += $krs->matakuliah->jumlah_sks * 2.0;
            } else if ($krs->nilai == 'D+') {
                $indeks_prestasi += $krs->matakuliah->jumlah_sks * 1.5;
            } else if ($krs->nilai == 'D') {
                $indeks_prestasi += $krs->matakuliah->jumlah_sks * 1.0;
            } else if ($krs->nilai == 'E') {
                $indeks_prestasi += $krs->matakuliah->jumlah_sks * 0;
            }
        }
        $indeks_prestasi = $indeks_prestasi / $this->getJumlahSks($tahun_ajaran_id);
        return number_format($indeks_prestasi, 1);
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