<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Tạo tài khoản demo cho users
        DB::table('users')->insert([
            [
                'name'       => 'Admin Demo',
                'email'      => 'admin@example.com',
                'password'   => Hash::make('123456'), // Mật khẩu demo
                'role'       => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'User Demo',
                'email'      => 'user@example.com',
                'password'   => Hash::make('123456'),
                'role'       => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Gọi các seeder khác
        $this->call([
            CategorySeeder::class,
            SubjectSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
