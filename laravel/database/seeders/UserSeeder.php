<?php

namespace Database\Seeders;

use App\Eo_Verification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @deprecated
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name" => "Admin",
                "email" => "admin@gmail.com",
                "slug" => Str::slug("Admin"),
                "number" => rand(1, 5),
                "role_id" => 3,
                "password" => "admin123456",
                "token" => Str::random(40),
            ],
            [
                "name" => "Event Organizer",
                "email" => "eo@gmail.com",
                "slug" => Str::slug("Event Organizer"),
                "number" => rand(1, 5),
                "role_id" => 2,
                "password" => "eo123456",
                "token" => Str::random(40),
            ],
            [
                "name" => "User",
                "email" => "user@gmail.com",
                "slug" => Str::slug("User"),
                "number" => rand(1, 5),
                "role_id" => 1,
                "password" => "user123456",
                "token" => Str::random(40),
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'slug' => Str::slug($user['name']),
                'email_verified_at' => now(),
                'avatar' => 'assets/profile/avatar-' . $user['number'] . '.jpg',
                'role_id' => $user['role_id'],
                'status' => 1,
                'password' => bcrypt($user['password']),
                'token' => $user['token'],
            ]);
        }

        Eo_Verification::create([
            'user_id' => 2,
            'ktp' => 'assets/ktp/default.jpg',
            'status' => 1,
            'status_read' => 1,
        ]);
    }
}
