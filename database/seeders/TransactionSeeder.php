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
        $user = User::where('status', 'OWNER')->first();
        $categories = Category::where('user_id', $user->id)->pluck('id');
        $accounts = Account::where('user_id', $user->id)->pluck('id');

        Transaction::factory()
            ->count(10)
            ->create([
                'user_id' => $user->id,
                'account_id' => $accounts->random(),
                'category_id' => $categories->random(),
            ]);
    }
}
