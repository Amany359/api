<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 5 parent projects
        Project::factory(5)->create()->each(function ($project) {
            // Create 3 subprojects for each parent project
            Project::factory(3)->withParent($project->id)->create();
        });

        // Create 3 standalone projects (no parent)
        Project::factory(3)->create();
    }
}
