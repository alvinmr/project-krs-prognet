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
            [   
                'kode'=>'TI555',
                'nama_matakuliah'=>'Pemrograman',
                'semester'=>'Ganjil',
                'jumlah_sks'=>'4',
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
                'dosen_id' => '3',
                'prodi_id' => '5',
                'tahun_ajaran_id'=>'1'
            ],
            [
                'kode' => 'TI2020II',
                'nama_matakuliah' => 'Konsep Basis Data',
                'semester' => 'Ganjil', 
                'jumlah_sks' => '3', 
                'kelas'=>'A',
                'status_matakuliah' => 'Wajib',
                'jam_mulai' => '10:00',
                'jam_selesai' => '12:00',
                'dosen_id' => '4',
                'prodi_id' => '5',
                'tahun_ajaran_id'=>'1'
            ],
            [
                'kode' => 'TI2021I',
                'nama_matakuliah' => 'Praktikum Pemrograman',
                'semester' => 'Genap', 
                'jumlah_sks' => '1', 
                'kelas'=>'A',
                'status_matakuliah' => 'Wajib',
                'jam_mulai' => '10:30',
                'jam_selesai' => '11:00',
                'dosen_id' => '5',
                'prodi_id' => '5',
                'tahun_ajaran_id'=>'2'
            ],
            [
                'kode' => 'TI2021II',
                'nama_matakuliah' => 'Assembly Language Lanjutan',
                'semester' => 'Genap', 
                'jumlah_sks' => '1', 
                'kelas'=>'C',
                'status_matakuliah' => 'Wajib',
                'jam_mulai' => '10:00',
                'jam_selesai' => '11:00',
                'dosen_id' => '6',
                'prodi_id' => '5',
                'tahun_ajaran_id'=>'2'
            ],
            [
                'kode' => 'TI2021III',
                'nama_matakuliah' => 'Sistem Operasi',
                'semester' => 'Genap', 
                'jumlah_sks' => '3', 
                'kelas'=>'C',
                'status_matakuliah' => 'Wajib',
                'jam_mulai' => '13:00',
                'jam_selesai' => '16:00',
                'dosen_id' => '7',
                'prodi_id' => '5',
                'tahun_ajaran_id'=>'2'
            ],
            [
                'kode' => 'TI2021IV',
                'nama_matakuliah' => 'Praktikum Konsep Basis Data',
                'semester' => 'Genap', 
                'jumlah_sks' => '1', 
                'kelas'=>'A',
                'status_matakuliah' => 'Wajib',
                'jam_mulai' => '14:00',
                'jam_selesai' => '16:00',
                'dosen_id' => '8',
                'prodi_id' => '5',
                'tahun_ajaran_id'=>'2'
            ],
            [
                'kode' => 'TI2022I',
                'nama_matakuliah' => 'Praktikum Sistem Operasi',
                'semester' => 'Ganjil', 
                'jumlah_sks' => '1', 
                'kelas'=>'D',
                'status_matakuliah' => 'Wajib',
                'jam_mulai' => '10:00',
                'jam_selesai' => '12:00',
                'dosen_id' => '9',
                'prodi_id' => '5',
                'tahun_ajaran_id'=>'3'
            ],
            [
                'kode' => 'TI2022II',
                'nama_matakuliah' => 'Interaksi Manusia Komputer',
                'semester' => 'Ganjil', 
                'jumlah_sks' => '3', 
                'kelas'=>'A',
                'status_matakuliah' => 'Wajib',
                'jam_mulai' => '15:00',
                'jam_selesai' => '18:00',
                'dosen_id' => '10',
                'prodi_id' => '5',
                'tahun_ajaran_id'=>'3'
            ],
            [
                'kode' => 'TI2022III',
                'nama_matakuliah' => 'Rekayasa Perangkat Lunak',
                'semester' => 'Ganjil', 
                'jumlah_sks' => '3', 
                'kelas'=>'A',
                'status_matakuliah' => 'Wajib',
                'jam_mulai' => '09:00',
                'jam_selesai' => '12:00',
                'dosen_id' => '11',
                'prodi_id' => '5',
                'tahun_ajaran_id'=>'3'
            ],
            [
                'kode' => 'TI2022IV',
                'nama_matakuliah' => 'Praktikum Assembly Language',
                'semester' => 'Ganjil', 
                'jumlah_sks' => '1', 
                'kelas'=>'A',
                'status_matakuliah' => 'Wajib',
                'jam_mulai' => '10:00',
                'jam_selesai' => '12:00',
                'dosen_id' => '12',
                'prodi_id' => '5',
                'tahun_ajaran_id'=>'3'
            ],
            [
                'kode' => 'TI2022V',
                'nama_matakuliah' => 'Pemrograman Mobile',
                'semester' => 'Genap', 
                'jumlah_sks' => '3', 
                'kelas'=>'A',
                'status_matakuliah' => 'Wajib',
                'jam_mulai' => '14.00',
                'jam_selesai' => '17:00',
                'dosen_id' => '13',
                'prodi_id' => '5',
                'tahun_ajaran_id'=>'4'
            ],
            [
                'kode' => 'TI2022VI',
                'nama_matakuliah' => 'Kecerdasaran Tiruan',
                'semester' => 'Genap', 
                'jumlah_sks' => '2', 
                'kelas'=>'B',
                'status_matakuliah' => 'Wajib',
                'jam_mulai' => '11.00',
                'jam_selesai' => '14:00',
                'dosen_id' => '14',
                'prodi_id' => '5',
                'tahun_ajaran_id'=>'4'
            ],
            [
                'kode' => 'TI2022VII',
                'nama_matakuliah' => 'Imaging Sistem',
                'semester' => 'Genap', 
                'jumlah_sks' => '2', 
                'kelas'=>'A',
                'status_matakuliah' => 'Wajib',
                'jam_mulai' => '08.30',
                'jam_selesai' => '11:00',
                'dosen_id' => '15',
                'prodi_id' => '5',
                'tahun_ajaran_id'=>'4'
            ],
            [
                'kode' => 'TI2022VIII',
                'nama_matakuliah' => 'Internet Of Things',
                'semester' => 'Genap', 
                'jumlah_sks' => '3', 
                'kelas'=>'B',
                'status_matakuliah' => 'Wajib',
                'jam_mulai' => '12.30',
                'jam_selesai' => '15:30',
                'dosen_id' => '16',
                'prodi_id' => '5',
                'tahun_ajaran_id'=>'4'
            ],
        ]);
    }
}
