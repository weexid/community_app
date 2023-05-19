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
                'club_name' => 'Rotaract Bali Area',
                'description' => 'This club is sample purpose only',
                'slug' => Str::slug('Rotaract Bali Area'),
                'club_thumbnail' => 'https://img.photographyblog.com/reviews/kodak_pixpro_fz201/photos/kodak_pixpro_fz201_01.jpg',
            ],
            [
                'club_name' => 'Rotaract Sanur',
                'description' => 'This club is sample purpose only',
                'slug' => Str::slug('Rotaract Sanur'),
                'club_thumbnail' => 'https://img.photographyblog.com/reviews/kodak_pixpro_fz201/photos/kodak_pixpro_fz201_01.jpg',
            ],
        ];

        foreach ($clubs as $club) {
            Club::create($club);
        }
        
    }
}
