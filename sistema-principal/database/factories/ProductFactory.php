<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'purchase_price' => $this->faker->randomFloat(2, 10, 100),
            'sale_price' => $this->faker->randomFloat(2, 15, 150),
            'category' => $this->faker->word(),
            'stock_quantity' => $this->faker->numberBetween(1, 100),
            'image' => $this->faker->imageUrl(640, 480, 'products', true),
        ];
    }
}
