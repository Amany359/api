<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3), // Generate a random project name
            'description' => $this->faker->paragraph, // Generate a random project description
            'image' => null, // Assuming you want to leave the image empty for now
            'parent_id' => null, // By default, no parent project
        ];
    }

    // Add this state for subprojects with a parent
    public function withParent($parentId)
    {
        return $this->state([
            'parent_id' => $parentId,
        ]);
    }
}
