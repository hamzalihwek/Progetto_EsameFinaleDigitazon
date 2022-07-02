<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->ean13(),
            'name' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5000),
            'availability' => $this->faker->randomNumber($nbDigits = 3, $strict = false),
            'discount' => $this->faker->numberBetween($min = 10, $max = 60)
        ];
    }
}
