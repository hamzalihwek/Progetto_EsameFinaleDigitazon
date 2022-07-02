<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 100),
            'product_id' => $this->faker->numberBetween($min = 1, $max = 100),
            'total_amount' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 10000, $max =200000),
            'payment_completed' => $this->faker->numberBetween($min = 0, $max = 1)
        ];
    }
}
