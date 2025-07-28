<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('status', 'OWNER')->whereNull('google_id')->first();
        Category::factory()
            ->count(4)
            ->create([
                'family_id' => $user->family_id,
            ]);

        $padli = User::where('email', 'm.septianpadli@gmail.com')->first();
        Category::factory()
            ->createMany([
                [
                    'family_id' => $padli->family_id,
                    'name' => 'Initial Balance',
                    'type' => null,
                ],
                [
                    'family_id' => $padli->family_id,
                    'name' => 'Internal Transfer',
                    'type' => null,
                ],
                [
                    'family_id' => $padli->family_id,
                    'name' => 'Food',
                    'type' => 'EXPENSE',
                ],
                [
                    'family_id' => $padli->family_id,
                    'name' => 'Transport',
                    'type' => 'EXPENSE',
                ],
                [
                    'family_id' => $padli->family_id,
                    'name' => 'Salary',
                    'type' => 'INCOME',
                ],
            ]);
    }
}
