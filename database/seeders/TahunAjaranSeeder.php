<?php

namespace Database\Seeders;

use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TahunAjaran::insert([
            [   
                'nama'=>'Ganjil 2021/2022'
            ],
            [   
                'nama'=>'Genap 2021/2022'
            ],
            [   
                'nama'=>'Ganjil 2022/2023'
            ],
            [   
                'nama'=>'Genap 2022/2023'
            ],
        ]);
    }
}
