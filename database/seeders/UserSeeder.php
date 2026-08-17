<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds for initial user accounts.
     */
    public function run(): void
    {
        $users = [
            [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'avatar' => 'James.jpg',
                'email' => 'john.doe@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'utype' => 'ADM',
            ],
            [
                'firstname' => 'Mary',
                'lastname' => 'Jean',
                'avatar' => 'James.jpg',
                'email' => 'mary@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'utype' => 'USR',
            ],
            [
                'firstname' => 'Vena',
                'lastname' => 'Mark N.',
                'avatar' => 'James.jpg',
                'email' => 'vena@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'utype' => 'USR',
            ],
            [
                'firstname' => 'Enderle',
                'lastname' => 'Rob',
                'avatar' => 'James.jpg',
                'email' => 'rob@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'utype' => 'USR',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
