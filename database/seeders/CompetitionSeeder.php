<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Season;
use App\Models\Competition;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seasons = Season::all();

        foreach ($seasons as $season) {
            Competition::create([
                'season_id' => $season->id,
                'name' => 'League Competition',
                'type' => 'league'
            ]);

            Competition::create([
                'season_id' => $season->id,
                'name' => 'Team Knockout Cup',
                'type' => 'team_knockout'
            ]);

            Competition::create([
                'season_id' => $season->id,
                'name' => 'Singles Tournament',
                'type' => 'singles'
            ]);
        }
    }
}
