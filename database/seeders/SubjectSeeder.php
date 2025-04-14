<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        // Giả định:
        // - category_id = 1: Khoa CNTT
        // - category_id = 2: Khoa Kinh tế
        // - category_id = 3: Góc giải trí
        DB::table('subjects')->insert([
            [
                'category_id' => 1,
                'name' => 'Lập trình Python',
                'description' => 'Các vấn đề liên quan đến Python',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Cơ sở dữ liệu',
                'description' => 'SQL, MySQL, PostgreSQL, ...',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Nguyên lý kế toán',
                'description' => 'Cơ bản và nâng cao về kế toán',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Ảnh chế, memes',
                'description' => 'Chia sẻ ảnh chế và nội dung giải trí',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Tâm sự sinh viên',
                'description' => 'Nơi chia sẻ tâm sự, kinh nghiệm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
