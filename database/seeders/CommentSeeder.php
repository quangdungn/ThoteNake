<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    public function run()
    {
        // Giả định: post_id = 1 và 2, user_id = 2 tồn tại
        DB::table('comments')->insert([
            [
                'post_id'    => 1,
                'user_id'    => 2,
                'content'    => 'Hướng dẫn này rất hữu ích, cảm ơn bạn!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'post_id'    => 2,
                'user_id'    => 2,
                'content'    => 'Mình đã thử áp dụng và thấy hiệu quả.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
