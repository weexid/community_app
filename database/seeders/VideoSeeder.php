<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id = 11;

        for($i=0; $i < 10; $i++){
            Video::create([
                'activity_id' => $id,
                'video_src' => 'PZ7lDrwYdZc',
            ]);

            $id++;
        }
    }
}
