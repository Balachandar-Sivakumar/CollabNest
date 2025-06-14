<?php

namespace Database\Seeders;

use App\Models\SoftSkills;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([SkillSeeder::class]);//seeding skills

        $this->call([InterestSeeder::class]);

        $this->call([SoftSkillSeeder::class]);

        $this->call([ProfessionSeeder::class]);
       
    }
}
