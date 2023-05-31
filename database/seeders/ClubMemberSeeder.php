<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClubMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $club_id = ['1','2','3','4', '5'];

        for ($i=0; $i < 100; $i++) {
            $key = array_rand($club_id);
            User::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => Hash::make('user123456'),
                'club_id' => $club_id[$key],
            ]);
        }
    }
}
