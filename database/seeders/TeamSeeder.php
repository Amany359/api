<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run()
    {
        // Create 5 teams without a parent
        Team::factory()->count(5)->create();

        // Create 5 teams with a parent from the previously created teams
        Team::factory()->count(5)->create([
            'parent_id' => Team::inRandomOrder()->first()->id,
        ]);
    }
}
