<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $club_id = [1, 2, 3, 4, 5];
        $tag_id = [1, 2, 3];

        // id 1 - 10 = article
        for ($i=0; $i < 10; $i++) {
            $key = array_rand($club_id);
            $tagKey = array_rand($tag_id);
            
            $title = $faker->sentence(3);
            $activity = Activity::create([
                'club_id' => $club_id[$key],
                'title' => $title,
                'slug' => Str::slug($title),
                'thumbnail' => 'dummy_activity.jpg',
                'description' => $faker->sentence(12),
                'type' => 'article',
            ]);

            // create_article
            $activity->article()->create([
                'content' => 'null',
            ]);

            // create tag
            $activity->tags()->attach($tag_id[$tagKey]);
        }

        // id 11 - 20 = video
        for ($i=0; $i < 10; $i++) {
            $key = array_rand($club_id);
            $tagKey = array_rand($tag_id);

            $title = $faker->sentence(3);
            $activity = Activity::create([
                'club_id' => $club_id[$key],
                'title' => $title,
                'slug' => Str::slug($title),
                'thumbnail' => 'PZ7lDrwYdZc',
                'description' => $faker->paragraph(2),
                'type' => 'video',
            ]);

            $activity->video()->create([
                'video_src' => 'PZ7lDrwYdZc',
            ]);
        }


    }
}
