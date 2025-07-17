<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
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
            'name' => $this->faker->word(),
            'type' => $this->faker->randomElement(['INCOME', 'EXPENSE']),
            'icon' => $this->faker->randomElement(['💰', '🛒', '🍔', '🚗', '🏠', '🎉', '📚', '💡', '🧾', '🛠️']),
        ];
    }
}
