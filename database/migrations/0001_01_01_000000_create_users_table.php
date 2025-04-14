<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
// database/migrations/xxxx_xx_xx_create_users_table.php
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'user', 'teacher'])->default('user');
            $table->boolean('approved')->default(false); // Tài khoản cần được admin phê duyệt
            $table->boolean('locked')->default(false);   // Tài khoản bị khóa khi vi phạm
            $table->rememberToken();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
