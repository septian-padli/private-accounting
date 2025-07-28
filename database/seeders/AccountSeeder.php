<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Family;
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
        $user = User::where('status', 'OWNER')->whereNull('google_id')->first();
        Account::factory()
            ->count(2)
            ->create([
                'family_id' => $user->family_id,
            ]);

        $padli = User::where('email', 'm.septianpadli@gmail.com')->first();
        Account::factory()
            ->createMany([
                [
                    'family_id' => $padli->family_id,
                    'name' => 'BCA',
                ],
                [
                    'family_id' => $padli->family_id,
                    'name' => 'BRI',
                ],
                [
                    'family_id' => $padli->family_id,
                    'name' => 'Cash',
                ],
            ]);
    }
}
