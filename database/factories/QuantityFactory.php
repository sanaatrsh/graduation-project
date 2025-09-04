<?php

namespace Database\Factories;

use App\Models\Box;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quantity>
 */
class QuantityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->value('id'), // منتج موجود
            'box_id' => Box::inRandomOrder()->value('id'),         // بوكس موجود
            'order_id' => Order::inRandomOrder()->value('id'),     // طلب موجود
            'quantity' => $this->faker->numberBetween(1, 20),
        ];
    }
}
