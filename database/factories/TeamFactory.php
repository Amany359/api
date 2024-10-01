<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'parent_id' => null,  // Set to null initially. You can assign this later for hierarchical teams
        ];
    }
}
