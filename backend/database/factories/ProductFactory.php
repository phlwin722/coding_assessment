<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $categories = ["Electronics", "Furniture", "Clothing", "Books"];

        return [
            'name' => $this->faker->words(2, true),
            'category' => $this->faker->randomElement($categories),
            'description' => $this->faker->paragraph(),
            'date_time' => $this->faker->dateTimeBetween('-1 year', '+1 month')->format('Y-m-d H:i:s'),
        ];
    }
}
