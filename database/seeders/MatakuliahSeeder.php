<?php

namespace Database\Seeders;

use App\Models\Matakuliah;
use Illuminate\Database\Seeder;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Matakuliah::insert([
            [   'kode'=>'TI555',
                'nama_matakuliah'=>'Pemrograman',
                'semester'=>'Ganjil',
                'jumlah_sks'=>'3',
                'kelas'=>'A',
                'status_matakuliah'=>'Wajib',
                'jam_mulai'=>'11:30',
                'jam_selesai'=>'13:50',
                'dosen_id'=>'1',
                'prodi_id'=>'5',
                'tahun_ajaran_id'=>'1'
            ],
            [
                'kode'=>'TI565',
                'nama_matakuliah'=>'Manajemen Server',
                'semester'=>'Ganjil',
                'jumlah_sks'=>'3',
                'kelas'=>'C',
                'status_matakuliah'=>'Wajib',
                'jam_mulai'=>'08:30',
                'jam_selesai'=>'10:50',
                'dosen_id'=>'2',
                'prodi_id'=>'5', 
                'tahun_ajaran_id'=>'1'
            ], 
            [
                'kode' => 'TI2020I',
                'nama_matakuliah' => 'Assembly Language',
                'semester' => 'Ganjil', 
                'jumlah_sks' => '3', 
                'kelas'=>'C',
                'status_matakuliah' => 'Wajib',
                'jam_mulai' => '10:00',
                'jam_selesai' => '12:00',
                'dosen_id' => '1',
                'prodi_id' => '5',
                'tahun_ajaran_id'=>'1'
            ]
        ]);
    }
}
