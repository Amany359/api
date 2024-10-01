<?php

namespace Database\Factories;

use App\Models\Subproject;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubprojectFactory extends Factory
{
    protected $model = Subproject::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'parent_id' => Project::factory(), // Assumes that the Project factory exists
        ];
    }
}
