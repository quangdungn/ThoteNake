<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Phê duyệt tài khoản
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->approved = true;
        $user->save();
        return redirect()->back()->with('success', 'Tài khoản đã được phê duyệt.');
    }

    // Khóa tài khoản
    public function lock($id)
    {
        $user = User::findOrFail($id);
        $user->locked = true;
        $user->save();
        return redirect()->back()->with('success', 'Tài khoản đã bị khóa.');
    }

    // Mở khóa tài khoản
    public function unlock($id)
    {
        $user = User::findOrFail($id);
        $user->locked = false;
        $user->save();
        return redirect()->back()->with('success', 'Tài khoản đã được mở khóa.');
    }
}
