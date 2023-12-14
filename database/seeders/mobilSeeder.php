<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\mobil;

class mobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [   
                'merek'       =>  'Toyota',
                'model'       =>  'BMW_20x',
                'nomor_plat'  =>  'ABCNM 1235 SE',
                'sewa_perhari'=>  '170000'
            ],
            [   
                'merek'       =>  'Avanza',
                'model'       =>  'BMWL_510x',
                'nomor_plat'  =>  'ABC 0225 SE',
                'sewa_perhari'=>  '300000'
            ],
            [   
                'merek'       =>  'Honda',
                'model'       =>  'BMWK_510x',
                'nomor_plat'  =>  'ABC 1225 SE',
                'sewa_perhari'=>  '250000'
            ],
            [   
                'merek'       =>  'Daihatsu',
                'model'       =>  'BMWO_510x',
                'nomor_plat'  =>  'ABC 9225 SE',
                'sewa_perhari'=>  '800000'
            ],
            [   
                'merek'       =>  'Suzuki',
                'model'       =>  'BMWM_510x',
                'nomor_plat'  =>  'ABC 6225 SE',
                'sewa_perhari'=>  '70000'
            ],
            [   
                'merek'       =>  'Mitsubishi',
                'model'       =>  'BMW_5100x',
                'nomor_plat'  =>  'ABC 5225 SE',
                'sewa_perhari'=>  '100000'
            ],
            [   
                'merek'       =>  'Wuling',
                'model'       =>  'BMW_5a0x',
                'nomor_plat'  =>  'ABC 1295 SE',
                'sewa_perhari'=>  '230000'
            ],
            [   
                'merek'       =>  'Chery',
                'model'       =>  'BMW_510x',
                'nomor_plat'  =>  'ABC 1245 SE',
                'sewa_perhari'=>  '50000'
            ],
           
           
        ];

        mobil::insert($data);
    }
}
