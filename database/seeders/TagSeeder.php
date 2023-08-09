<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tag = ['Local Event', 'International Event', 'Charity'];

        for($i = 0; $i < count($tag); $i++){
            Tag::create([
                'tag_name' => $tag[$i],
            ]);
        }
    }
}
