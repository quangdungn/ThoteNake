<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Hiển thị thông tin cá nhân của user
    public function show(User $user)
    {
        return view('profile.show', compact('user'));
    }
}
