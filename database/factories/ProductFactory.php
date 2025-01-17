<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = $this->faker->randomFloat(2, 10, 100);
        $discount = $this->faker->randomFloat(2, 5, 20);

        return [
            "name" => [
                "en" => $this->faker->words(3, true), // English name
                "ka" => $this->faker->words(3, true), // Georgian name
            ],
            "description" => [
                "en" => $this->faker->sentence(), // English description
                "ka" => $this->faker->sentence(), // Georgian description
            ],
            "image" => $this->faker->imageUrl(),
            "price" => $price,
            "discount" => $discount,
            "discounted_price" => $price - ($price * ($discount / 100)),
            "is_popular" => $this->faker->boolean(),
            "is_in_stock" => $this->faker->boolean(),
        ];
    }
}
