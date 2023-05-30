<?php

namespace Database\Seeders;

use App\Models\ClubActivity;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClubActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $img = 'dummy_activity.jpg';
        $club = ['1', '2', '3', '4', '5',];

        for ($i=0; $i < 50; $i++) {
            $title = $faker->sentence(3);
            $randKey = array_rand($club);

            ClubActivity::create([
                'title' => $title,
                'content' => $faker->paragraph(3),
                'slug' => Str::slug($title),
                'image' => $img,
                'club_id' => $club[$randKey],
            ]);
        }
    }
}
