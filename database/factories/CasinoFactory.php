<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Casino>
 */
class CasinoFactory extends Factory
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
            'url' => fake()->url(),
            'logo' => fake()->imageUrl(200, 200),
            'rank' => fake()->randomFloat(2, 1, 10),
            'market' => fake()->countryCode(),
        ];
    }
}
