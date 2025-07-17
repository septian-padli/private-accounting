<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
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
        $user = User::where('status', 'OWNER')->first();
        $categories = Category::where('user_id', $user->id)->pluck('id');
        MonthlyBudget::factory()
            ->count(12)
            ->create([
                'user_id' => $user->id,
                'category_id' => $categories->random(),
            ]);
    }
}
