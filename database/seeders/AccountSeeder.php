<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('status', 'OWNER')->first();
        Account::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);
    }
}
