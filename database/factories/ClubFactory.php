<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClubFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->name();
        return [
            // define data
            'club_title' => $title,
            'club_tagline' => fake()->sentence(1),
            'description' => "for test only",
            'slug' => Str::slug($title),
            'image_url' => 'https://d1vbn70lmn1nqe.cloudfront.net/prod/wp-content/uploads/2022/08/18074743/Jarang-Disadari-Ini-X-Manfaat-Bunga-Melati-bagi-Kecantikan.jpg.webp',
        ];
    }

}
