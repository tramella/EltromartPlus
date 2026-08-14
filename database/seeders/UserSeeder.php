<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        /// Seed rồi
        DB::table('users')->insert(
            [
                [
                    'firstname' => 'John',
                    'lastname' => 'Doe',
                    'avatar' => 'James.jpg', // Hình ảnh mẫu
                    'email' => 'john.doe@example.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password123'),
                    'utype' => 'ADM',
                ],
                [
                    'firstname' => 'Mary',
                    'lastname' => 'Jean',
                    'avatar' => 'James.jpg', // Hình ảnh mẫu
                    'email' => 'mary@example.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password123'),
                    'utype' => 'USR',
                ],
                [
                    'firstname' => 'Vena',
                    'lastname' => 'Mark N.',
                    'avatar' => 'James.jpg', // Hình ảnh mẫu
                    'email' => 'vena@example.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password123'),
                    'utype' => 'USR',
                ],
                [
                    'firstname' => 'Enderle',
                    'lastname' => 'Rob',
                    'avatar' => 'James.jpg', // Hình ảnh mẫu
                    'email' => 'rob@example.com',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password123'),
                    'utype' => 'USR',
                ]
            ]
        );
    }
}
