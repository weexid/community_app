<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Club;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->word();
        return [
            'club_id' => Club::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->sentence(3),
            'thumbnail' => 'default.jpeg',
            'type' => 'article', //bisa edit pakek for() dan edit type jadi video jika diperlukan
        ];
    }
}
