<?php

namespace Database\Seeders;

use App\Models\Club;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clubs = [
            [
                'club_title' => 'Club Melati',
                'club_tagline' => 'Jadilah Sewangi Melati',
                'description' => 'This club is sample purpose only',
                'slug' => Str::slug('Club Melati'),
                'image_url' => 'https://d1vbn70lmn1nqe.cloudfront.net/prod/wp-content/uploads/2022/08/18074743/Jarang-Disadari-Ini-X-Manfaat-Bunga-Melati-bagi-Kecantikan.jpg.webp',
            ],
            [
                'club_title' => 'Club Pendaki',
                'slug' => Str::slug('Club Pendaki'),
                'image_url' => 'https://indonesiatraveler.id/wp-content/uploads/2020/06/Gunung-Prau1.jpg',
            ],
            [

                'club_title' => 'Club Jepun',
                'club_tagline' => 'Sewangi Bunga Jepun',
                'slug' => Str::slug('Club Jepun'),
                'image_url' => 'https://i.pinimg.com/originals/26/15/b3/2615b31cc278ab3e48b78faf4cf90411.jpg',
            ],
            [
                'club_title' => 'Club Codet',
                'description' => 'This club is sample purpose only',
                'slug' => Str::slug('Club Codet'),
                'image_url' => 'https://static.republika.co.id/uploads/images/inpicture_slide/komik-komik-superman-versi-space-age-dari-clown-prince_230315160650-619.jpeg',
            ],
            [
                'club_title' => 'Club Galaxy',
                'slug' => Str::slug('Club Galaxy'),
                'image_url' => 'https://img.freepik.com/free-vector/realistic-colorful-galaxy-background_23-2148965681.jpg',
            ]
        ];

        foreach ($clubs as $club) {
            Club::create($club);
        }
        
    }
}
