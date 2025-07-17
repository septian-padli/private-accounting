<?php

namespace Database\Seeders;

use App\Models\MonthlyBudget;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MonthlyBudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MonthlyBudget::factory()
            ->count(12)
            ->create([
                'user_id' => \App\Models\User::factory(),
            ]);
    }
}
