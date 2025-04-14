<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'subject_id',
        'user_id',
        'title',
        'content',
        'status',
        'pinned',
        'image_path',  // thêm trường này
        'file_path'    // và trường này
    ];

    // Một Post thuộc về 1 Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Một Post được tạo bởi 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Một Post có nhiều Comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
