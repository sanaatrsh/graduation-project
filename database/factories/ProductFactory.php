<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'price'       => $this->faker->randomFloat(2, 5, 500),
            'trending'    => $this->faker->boolean(30),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'brand_id'    => Brand::inRandomOrder()->first()?->id ?? Brand::factory(),
        ];
    }
}
