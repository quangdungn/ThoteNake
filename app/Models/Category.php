<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    // Một Category có nhiều Subject
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
