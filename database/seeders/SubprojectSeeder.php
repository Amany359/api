<?php

namespace Database\Seeders;

use App\Models\Subproject;
use Illuminate\Database\Seeder;

class SubprojectSeeder extends Seeder
{
    public function run()
    {
        // Create 10 subprojects
        Subproject::factory(10)->create();
    }
}
