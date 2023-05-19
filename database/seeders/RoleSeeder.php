<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [   
                'id' => 1,
                'role_name' => 'admin',
                'role_description' => 'Administrator is superpower'
            ],
            [
                'id' => 2,
                'role_name' => 'president',
                'role_description' => 'President of club'
            ],
            [
                'id'=> 3,
                'role_name' => 'member',
                'role_description' => 'Member of rotaract club'
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

    }
}
