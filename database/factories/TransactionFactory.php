<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Account;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'note' => $this->faker->sentence(3),
            'amount' => $this->faker->randomFloat(2, 1000, 100000),
            'transaction_date' => $this->faker->date(),
        ];
    }
}
