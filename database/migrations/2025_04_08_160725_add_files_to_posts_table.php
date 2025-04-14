<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilesToPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Cột lưu đường dẫn hình ảnh (nếu có)
            $table->string('image_path')->nullable()->after('content');
            // Cột lưu đường dẫn tài liệu (nếu có)
            $table->string('file_path')->nullable()->after('image_path');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['image_path', 'file_path']);
        });
    }
}
