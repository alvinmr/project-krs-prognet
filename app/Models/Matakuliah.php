<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class Matakuliah extends Model
{
    use FilterQueryString;
    use HasFactory;

    protected $filters = ['tahun_ajaran_id'];
    protected $table = 'matakuliah';
    protected $fillable = [
        'kode', 'nama_matakuliah', 'jumlah_sks', 'semester', 'status_matakuliah',
        'jam_mulai', 'jam_selesai', 'dosen_id', 'prodi_id', 'kelas', 'tahun_ajaran_id'
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

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'transaksi_krs');
    }

    public function transaksi_krs()
    {
        return $this->hasMany(TransaksiKrs::class);
    }

    public function tahun_ajaran_id($query, $value) {
        $query->where('tahun_ajaran_id', $value);
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
