<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MonthlyBudget>
 */
class MonthlyBudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['user_id' => $user->id]);
        return [
            'user_id' => $user->id,
            'category_id' => $category->id,
            'month' => $this->faker->numberBetween(1, 12),
            'year' => $this->faker->year(),
            'amount' => $this->faker->randomFloat(2, 100000, 10000000),
        ];
    }
}
