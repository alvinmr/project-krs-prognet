<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nama = ['Abel', 'Rico', 'Ngurah', 'Fernando'];
        $nip = ['198507232020072001', '198507232020072002', '198507232020072003', '198507232020072004'];

        for ($i = 0; $i < 3; $i++) {
            Dosen::insert([
                'nip' => $nip[$i],
                'nama' => $nama[$i],
                'email' => strtolower($nama[$i]) . '@gmail.com',
                'telepon' => '082348758492',
                'status_dosen' => 1
            ]);
        }
    }
}
