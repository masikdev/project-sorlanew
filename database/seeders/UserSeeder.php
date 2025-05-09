<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Test User',
                'email' => 'masik@sorla.id',
                'password' => BCRYPT('test1234')
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
