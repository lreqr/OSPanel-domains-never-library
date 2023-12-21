<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\factory>
 */
class ReleaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'original_title' => fake()->sentence(4),
            'type' => fake()->word(),
            'release_season' => fake()->word(),
            'production_studio' => fake()->word(),
            'description' => fake()->text(),
            'slug' => fake()->word(),
        ];
    }
}
