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
        $nama = [
            'Abel', 
            'Rico', 
            'Ngurah', 
            'Fernando', 
            'Alvin', 
            'Kevin', 
            'Risma', 
            'Ajeng', 
            'Himawan', 
            'Nanda', 
            'Jollando', 
            'Akbar', 
            'Bayu', 
            'Maulana', 
            'Maulwidi',
            'Maulina',
        ];

        $nip = [
            '198507232020072001', 
            '198507232020072002', 
            '198507232020072003', 
            '198507232020072004', 
            '198507232020072005', 
            '198507232020072006', 
            '198507232020072007',  
            '198507232020072008',  
            '198507232020072009',  
            '1985072320200720010',  
            '1985072320200720011',  
            '1985072320200720012',  
            '1985072320200720013',  
            '1985072320200720014',  
            '1985072320200720015',  
            '1985072320200720016',  
        ];

        for ($i = 0; $i < 16; $i++) {
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
