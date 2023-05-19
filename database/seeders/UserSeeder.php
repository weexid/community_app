<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
                [
                    'name' => "admin",
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('admin123'),
                    'role_id' => 1,
                ],
                [
                    'name' => "president",
                    'email' => 'president@gmail.com',
                    'password' => Hash::make('president123'),
                    'role_id' => 2,
                    'club_id' => 2,
                ],
                [
                    'name' => "member",
                    'email' => 'member@gmail.com',
                    'password' => Hash::make('member123'),
                    'role_id' => 3,
                    'club_id' => 2,
                ],
                [
                    'name' => "guest",
                    'email' => 'guest@gmail.com',
                    'password' => Hash::make('guest123'),
                    'role_id' => 3,
                ]
            ];

            foreach ($users as $user) {
                User::create($user);
            }
    }
}
