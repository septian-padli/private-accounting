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
            ->create([]);

        $familyOther = Family::factory()
            ->create([
                'name' => 'Septian Family',
            ]);

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
        User::factory()
            ->create([
                'email' => 'm.septianpadli@gmail.com',
                'name' => 'Septian Padli',
                'google_id' => '102037582963265230781',
                'photo_profile' => 'https://lh3.googleusercontent.com/a/ACg8ocLV7nlmKmESPRat0mjuI1pLl-V2NaoaQ-S3K1tm71oPUEV89aM=s96-c',
                'status' => 'OWNER',
                'family_id' => $familyOther->id,
            ]);
    }
}
