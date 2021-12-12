<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nama = ['Heri', 'Yonda', 'Jojo'];
        $nim = ['2005551010', '1905551010', '1805551010'];
        $angkatan = ['2020', '2019', '2018'];

        for ($i = 0; $i < 3; $i++) {
            Mahasiswa::insert([
                'nim' => $nim[$i],
                'nama' => $nama[$i],
                'alamat' => 'Jl. Kita berdua',
                'telepon' => '082348758492',
                'angkatan' => $angkatan[$i],
                'prodi_id' => 5,
                'foto_mahasiswa' => 'default-avatar.png',
                'password' => Hash::make('pass')
            ]);
        }
    }
}