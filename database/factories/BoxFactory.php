<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Box>
 */
class BoxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'event'       => $this->faker->randomElement(['wedding', 'birthday', 'graduation', 'other']),
            'color'       => $this->faker->safeColorName(),
            'price'       => $this->faker->randomFloat(2, 5, 500), // سعر عشوائي بين 5 و 500
        ];
    }
}
