<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Khoa Công nghệ thông tin',
                'description' => 'Các môn học và thảo luận liên quan đến CNTT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Khoa Kinh tế',
                'description' => 'Các chủ đề về kinh tế và quản trị',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Góc giải trí',
                'description' => 'Chia sẻ ảnh chế, memes, tâm sự sinh viên, ...',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
