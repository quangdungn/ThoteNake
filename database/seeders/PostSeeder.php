<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Lưu ý: Giả sử tồn tại user_id = 1 cho demo
        DB::table('posts')->insert([
            [
                'subject_id' => 1, // Lập trình Python
                'user_id'    => 1, // Admin Demo
                'title'      => 'Cách cài đặt Python trên Windows',
                'content'    => 'Hướng dẫn cài đặt Python chi tiết...',
                'status'     => 'published',
                'pinned'     => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subject_id' => 2, // Cơ sở dữ liệu
                'user_id'    => 1,
                'title'      => 'Tối ưu truy vấn SQL',
                'content'    => 'Một số cách tối ưu câu lệnh SQL...',
                'status'     => 'published',
                'pinned'     => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
