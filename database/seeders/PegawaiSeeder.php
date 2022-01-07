<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nama = ['Pegawai 1', 'Pegawai 2', 'Pegawai 3', 'Pegawai 4'];
        $nip = ['200212242020072001', '200212242020072002', '200212242020072003', '200212242020072004'];

        for ($i = 0; $i < 3; $i++) {
            Pegawai::create([
                'nip' => $nip[$i],
                'nama' => $nama[$i],
                'alamat' => 'Jl Kita berdua',
                'telepon' => '082348758492',
                'password' => Hash::make('pass')
            ]);
        }
    }
}