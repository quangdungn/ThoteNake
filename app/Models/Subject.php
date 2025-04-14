<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description'
    ];

    // Quan hệ: mỗi Subject thuộc về một Category
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    // Quan hệ: mỗi Subject có nhiều bài viết (nếu cần)
    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class);
    }
}
