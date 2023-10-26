<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Time>
 */
class TimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Carbon::parse(fake()->dateTimeBetween('-1 month'))->translatedFormat('d F Y'),
            'time' => fake()->dateTimeBetween('-1 month'),
            'description' => fake()->sentence(),
        ];
    }
}
