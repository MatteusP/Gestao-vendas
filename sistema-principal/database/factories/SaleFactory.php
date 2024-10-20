<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total' => $this->faker->randomFloat(2, 50, 1000),
            'sale_date' => $this->faker->dateTime(),
            'status' => 'completed',
        ];
    }
}
