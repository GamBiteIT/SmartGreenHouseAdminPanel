<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Parametre;
use App\Models\User;
use App\Models\Plant;
use App\Models\Season;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'farmer',
            'email'=>'f@f.com',
            'password'=>'$2y$10$2m4TIR6PT.pIVPtiIog4TuNRQnKDm376rDRofZkfqTvyvtYcSuHd.'
        ]);
        Plant::create([
            'name'=>'Tomato',
            'type'=>'Tomato',
            'duree_de_plontation'=>10,
            'productivity'=>100,
            'duree_floration'=>4,
            'duree_nouaison'=>2,
            'duree_debut_recolte'=>2,
            'duree_fin_recorte'=>2
        ]);
        // Season::create([
        //  'name'=>'Season 1',
        //  'plant_id'=>1,
        //  'start_day'=>'2023-05-01 00:00:00',
        //  'end_day'=>'2023-07-15 00:00:00',
        //  'quantity_planty'=>20,
        //  'expected_productivity'=>100,
        //  '4season'=>'éte',
        // ]);

        // Parametre::create([
        // 'season_id'=>1,
        // 'TemperatureValeur_max'=>29,
        // 'TemperatureValeur_min'=>16,
        // 'HumidityValeur'=>75,
        // 'SoilValeur'=>550,
        // 'LightValeur_max'=>20000,
        // 'LightValeur_min'=>10000
        // ]);
    }
}
