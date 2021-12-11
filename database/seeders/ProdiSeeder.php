<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prodi::insert([
            [
                'nama_prodi' => 'Teknik Arsitektur'
            ],
            [
                'nama_prodi' => 'Teknik Sipil'
            ],
            [
                'nama_prodi' => 'Teknik Elektro'
            ],
            [
                'nama_prodi' => 'Teknik Mesin'
            ],
            [
                'nama_prodi' => 'Teknologi Informasi'
            ],
            [
                'nama_prodi' => 'Teknik Lingkungan'
            ],
            [
                'nama_prodi' => 'Teknik Industri'
            ]
        ]);
    }
}