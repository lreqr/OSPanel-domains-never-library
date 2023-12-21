<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeasonEventGenre>
 */
class SeasonEventGenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'season_event_id' => fake()->numberBetween(1, 2),
            'genre_id' => fake()->numberBetween(1, 15),
        ];
    }
}
