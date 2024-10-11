<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('seasons')->insert([
            [
                'name' => '2024 / 2025 Season',
                'start_date' => Carbon::create(2024, 6, 26),
                'end_date' => Carbon::create(2024, 3, 26),
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Winter 2023 / 2024 Season',
                'start_date' => Carbon::create(2023, 11, 1),
                'end_date' => Carbon::create(2024, 6, 19),
                'status' => 'completed',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
