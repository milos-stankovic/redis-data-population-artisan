<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'link' => fake()->url(),
            'screenshot' => fake()->imageUrl(400, 400),
            'numberOfPlays' => fake()->numberBetween(0, 20000),
            'market' => fake()->countryCode(),
        ];
    }
}
