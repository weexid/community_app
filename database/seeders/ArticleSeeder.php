<?php

namespace Database\Seeders;

use App\Models\Article;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create('id_ID');

        for($i = 0; $i < 10; $i++) {
            Article::create([
                'activity_id' => $i+1,
                'content' => $faker->paragraph(6),
            ]);
        }
    }
}
