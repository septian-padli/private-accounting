<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Family;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $family = Family::factory()
            ->create();

        User::factory()
            ->create([
                'status' => 'PENDING',
                'family_id' => $family->id,
            ]);
        User::factory()
            ->create([
                'status' => 'VIEWER',
                'family_id' => $family->id,
            ]);
        User::factory()
            ->create([
                'status' => 'COLLABORATOR',
                'family_id' => $family->id,
            ]);
        User::factory()
            ->create([
                'status' => 'OWNER',
                'family_id' => $family->id,
            ]);
    }
}
