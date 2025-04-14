<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    // Hiển thị danh sách bài viết của người dùng
    public function index(User $user)
    {
        // Giả sử model User có quan hệ posts()
        $posts = $user->posts()->latest()->paginate(10);
        return view('user.posts.index', compact('user', 'posts'));
    }
}
