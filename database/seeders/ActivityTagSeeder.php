<?php

namespace Database\Seeders;

use App\Models\ActivityTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $article_id = [1, 2, 3, 4, 2];
        $video_id = [11, 12, 17, 11, 15];
        $tag_id = [1, 2, 3];

        // article
        for($i = 0; $i < count($article_id); $i++){
            $key = array_rand($tag_id);
            ActivityTag::create([
                'activity_id' => $article_id[$i],
                'tag_id' => $tag_id[$key],
            ]);
        }
        // video
        for($i = 0; $i < count($video_id); $i++){
            $key = array_rand($tag_id);
            ActivityTag::create([
                'activity_id' => $video_id[$i],
                'tag_id' => $tag_id[$key],
            ]);
        }



    }
}
