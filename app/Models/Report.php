<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['post_id', 'user_id', 'reason', 'status'];

    // Quan hệ với bài viết (Post)
    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class);
    }

    // Quan hệ với người dùng (User) - người báo cáo
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
