<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => strtoupper($this->faker->bothify('??##??##')),
            'discount_percent' => $this->faker->numberBetween(5, 50),
            'expiration_date' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
