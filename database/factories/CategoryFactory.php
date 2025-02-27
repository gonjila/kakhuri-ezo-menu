<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => [
                "en" => $this->faker->words(3, true), // English name
                "ka" => $this->faker->words(3, true), // Georgian name
            ],
            "image" => $this->faker->imageUrl(),
        ];
    }
}
