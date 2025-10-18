<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            [
                'name_city' => 'Milano',
                'name_prov' => 'MI'
            ],
            [
                'name_city' => 'Roma',
                'name_prov' => 'RM'
            ],
            [
                'name_city' => 'Torino',
                'name_prov' => 'TO'
            ],
            [
                'name_city' => 'Napoli',
                'name_prov' => 'NA'
            ],
            [
                'name_city' => 'Firenze',
                'name_prov' => 'FI'
            ],
            [
                'name_city' => 'Bologna',
                'name_prov' => 'BO'
            ],
            [
                'name_city' => 'Genova',
                'name_prov' => 'GE'
            ],
            [
                'name_city' => 'Venezia',
                'name_prov' => 'VE'
            ],
            [
                'name_city' => 'Verona',
                'name_prov' => 'VR'
            ],
            [
                'name_city' => 'Palermo',
                'name_prov' => 'PA'
            ],
            [
                'name_city' => 'Catania',
                'name_prov' => 'CT'
            ],
            [
                'name_city' => 'Bari',
                'name_prov' => 'BA'
            ],
            [
                'name_city' => 'Trieste',
                'name_prov' => 'TS'
            ],
            [
                'name_city' => 'Perugia',
                'name_prov' => 'PG'
            ],
            [
                'name_city' => 'Parma',
                'name_prov' => 'PR'
            ],
            [
                'name_city' => 'Reggio Calabria',
                'name_prov' => 'RC'
            ],
        ];

        foreach ($cities as $city) {
            City::create([
                'name_city' => $city['name_city'],
                'name_prov' => $city['name_prov']
            ]);
        }
    }
}
