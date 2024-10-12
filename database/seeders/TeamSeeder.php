<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Season;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $seasons = Season::all();

        foreach ($seasons as $season) {
            Team::create([
                'season_id' => $season->id,
                'name' => 'Blacksmith Arms A',
                'captain' => 'Tom Richardson',
                'vicecaptain' => 'Chris Sparrow'
            ]);

            Team::create([
                'season_id' => $season->id,
                'name' => 'United Services Club',
                'captain' => 'Joe Goddard',
                'vicecaptain' => 'Rich Millet'
            ]);
        }
    }
}
