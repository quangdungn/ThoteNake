<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id', 'user_id', 'content'];

    // Một Comment thuộc về 1 Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Một Comment được tạo bởi 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
