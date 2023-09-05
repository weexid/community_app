<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            MainCarouselSeeder::class,
            ClubSeeder::class,
            ClubMemberSeeder::class,
            ClubActivitySeeder::class,
            ClubCarouselSeeder::class,
            TagSeeder::class,
            ActivitiesSeeder::class,
        
        ]);
    }
}
