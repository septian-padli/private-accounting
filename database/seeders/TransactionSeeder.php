<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('status', 'OWNER')->whereNull('google_id')->first();
        $categories = Category::where('family_id', $user->family_id)->pluck('id');
        $accounts = Account::where('family_id', $user->family_id)->pluck('id');

        Transaction::factory()
            ->count(10)
            ->create([
                'family_id' => $user->family_id,
                'user_id' => $user->id,
                'account_id' => $accounts->random(),
                'category_id' => $categories->random(),
            ]);
    }
}
