<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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

          // Define a list of phone brands
          $phoneBrands = ['Apple', 'Samsung', 'Google', 'OnePlus', 'Sony', 'Nokia', 'Huawei', 'Xiaomi', 'Oppo', 'Vivo'];

        return [
            'name' => fake()->firstName(),
            'description' => fake()->lastName(),
            'price' => fake()->numberBetween(200, 10000),
            'image' => fake()->imageUrl(),
            'brand' => $phoneBrands[array_rand($phoneBrands)],
            'rating' => fake()->randomFloat(1, 1, 5),
        ];
    }
}
