<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'delivered_by' => $this->faker->dateTimeBetween('now', '+1 month'),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'address' => $this->faker->address,
        ];
    }
}
