<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'price' => $this->faker->randomFloat(2, 5, 100),
            'description' => $this->faker->sentence,
            'available_quantity' => $this->faker->numberBetween(1, 50),
            'discount' => $this->faker->numberBetween(0, 30),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    
}
