<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'time_id' => fake()->numberBetween(1, 10),
            'name' => fake()->sentence(fake()->numberBetween(1, 3)),
            'about' => fake()->paragraph(),
            'description' => fake()->paragraph(),
            'demo' => fake()->url(),
            'repo' => 'https://github.com/' . fake()->userName() . '/' . fake()->slug(fake()->numberBetween(1, 3)),
            'app_type_id' => fake()->numberBetween(1, 6),
            'developer_id' => fake()->numberBetween(1, 20),
        ];
    }
}
