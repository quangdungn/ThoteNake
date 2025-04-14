<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Hiển thị danh sách người dùng
    public function listUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Phê duyệt tài khoản (update cột approved = true)
    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->approved = true;
        $user->save();
        return redirect()->back()->with('success', 'Tài khoản đã được phê duyệt');
    }

    // Khóa tài khoản vi phạm
    public function lockUser($id)
    {
        $user = User::findOrFail($id);
        $user->locked = true;
        $user->save();
        return redirect()->back()->with('success', 'Tài khoản đã bị khóa');
    }

    // Mở khóa tài khoản
    public function unlockUser($id)
    {
        $user = User::findOrFail($id);
        $user->locked = false;
        $user->save();
        return redirect()->back()->with('success', 'Tài khoản đã được mở khóa');
    }

    // Quản lý báo cáo bài viết
    public function listReports()
    {
        $reports = Report::with(['post', 'user'])->where('status', 'pending')->get();
        return view('admin.reports.index', compact('reports'));
    }

    // Xử lý báo cáo (ví dụ: duyệt và xóa bài viết vi phạm)
    public function resolveReport($id)
    {
        $report = Report::findOrFail($id);
        // Có thể xóa bài viết nếu vi phạm
        Post::destroy($report->post_id);
        $report->status = 'resolved';
        $report->save();
        return redirect()->back()->with('success', 'Báo cáo đã được xử lý và bài viết đã bị xóa');
    }

    // Ghim bài viết
    public function pinPost($id)
    {
        $post = Post::findOrFail($id);
        $post->pinned = true;
        $post->save();
        return redirect()->back()->with('success', 'Bài viết đã được ghim');
    }

    public function unpinPost($id)
    {
        $post = Post::findOrFail($id);
        $post->pinned = false;
        $post->save();
        return redirect()->back()->with('success', 'Bài viết đã bỏ ghim');
    }
}
