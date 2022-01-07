<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Mahasiswa extends Authenticatable
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $keyType = 'string';
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

    public function getAvatarAttribute()
    {
        return $this->foto_mahasiswa ?
            asset('foto_mahasiswa/' . $this->foto_mahasiswa) :
            'https://source.boringavatars.com/beam/200/' . $this->nama;
    }

    public function getIpkAttribute()
    {
        $listIps = $this->getListIps();

        return number_format(array_sum($listIps) / $this->semester, 2);
    }

    public function getListIps()
    {
        $tahun_ajaran = TahunAjaran::orderBy('id', 'desc')->limit($this->semester)->get();
        $listIps = array();
        foreach ($tahun_ajaran as $item) {
            array_push($listIps, $this->getIps($item->id));
        }
        return array_reverse($listIps);
    }

    public function getListIpk()
    {
        $listIps = $this->getListIps();
        $listIpk = [];
        for ($i = 1; $i <= $this->semester; $i++) {
            array_push($listIpk, number_format(array_sum(array_slice($listIps, 0, $i)) / $i, 2));
        }
        return $listIpk;
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
        $indeks_prestasi = $this->getJumlahSks($tahun_ajaran_id) == 0 ? 0 : $indeks_prestasi / $this->getJumlahSks($tahun_ajaran_id);
        return number_format($indeks_prestasi, 2);
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}