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
        $user = User::where('status', 'OWNER')->first();
        Category::factory()
            ->count(4)
            ->create([
                'user_id' => $user->id,
            ]);
    }
}
