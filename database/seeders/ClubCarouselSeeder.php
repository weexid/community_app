<?php

namespace Database\Seeders;

use App\Models\ClubCarousel;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClubCarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $clubs_id = ['1', '2', '3', '4', '5'];

        for ($i=0; $i < 20; $i++) {
            $key = array_rand($clubs_id); 
            ClubCarousel::create([
                'image' => 'dummyCarousel.jpg',
                'heading' => $faker->sentence(2),
                'sub_heading' => $faker->sentence(3),
                'cta_text' => 'link for '. $clubs_id[$key],
                'cta_link' => '/',
                'club_id' => $clubs_id[$key],
            ]);    
        }
    }
}

// $table->string('image')->nullable();
// $table->string('image_url')->nullable();
// $table->string('heading');
// $table->string('sub_heading')->nullable();
// $table->string('cta_text')->nullable();
// $table->string('cta_link')->nullable();
// $table->unsignedBigInteger('club_id');

// $table->foreign('club_id')->references('id')->on('clubs');