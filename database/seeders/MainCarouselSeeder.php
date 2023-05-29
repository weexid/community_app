<?php

namespace Database\Seeders;

use App\Models\MainCarousel;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainCarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'image' => 'dummyCarousel.jpg',
                'heading' => 'Ini Data Dummy',
            ],
            [
                'image_url' => 'https://assets.entrepreneur.com/content/3x2/2000/20180507200150-GettyImages-639336736.jpeg',
                'heading' => 'Grow Together, Live Forever',
                'cta_text' => 'Bergabung Bersama Kami',
                'cta_link' => '/login',
            ],
            [
                'image' => 'dummyCarousel.jpg',
                'heading' => 'Let\'s Together Forever',
                'sub_heading' => 'Build it by our way'
            ],
            [
                'image_url' => 'https://katehanley.com/wp-content/uploads/2021/01/Stronger-Together-scaled.jpg',
                'heading' => 'Last Long Friends Forever',
            ],
            [
                'image_url' => 'https://scholarlykitchen.sspnet.org/wp-content/uploads/2018/11/iStock-857146092.jpg',
                'heading' => 'Team Work, Make it Possible',
                'sub_heading' => 'Learn how to unlock your Team Work',
                'cta_text' => 'Grow Together',
                'cta_link' => '/clubs',
            ],
        ];

        foreach ($data as $carousel) {
            MainCarousel::create($carousel);
        }

        // $faker = Faker::create();
        // $faker->locale('id_ID');

        // for($i = 0; $i < 5; $i++){
        //     if($i == 2 && $i == 3) {
        //         DB::table('main_carousels')->insert([
        //             'image_url' => $faker->imageUrl(1300, 650),
        //             'heading' => $faker->sentence(4),
        //             'sub_heading' => $faker->sentence(6),
        //             'cta_link' => $faker->url(),
        //         ]);
        //     }
        //     else{
        //         DB::table('main_carousels')->insert([
        //             'image' => 'dummy-img.jpg',
        //             'heading' => $faker->sentence(4),
        //             'sub_heading' => $faker->sentence(6),
        //         ]);
        //     }
        // }
    }
}
