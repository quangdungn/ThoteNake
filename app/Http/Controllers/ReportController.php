<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // Phương thức xử lý báo cáo bài viết
    public function store(Request $request, $postId)
    {
        // Validate dữ liệu từ form báo cáo
        $request->validate([
            'reason' => 'required|string'
        ]);

        // Lấy bài viết cần báo cáo
        $post = Post::findOrFail($postId);

        // Tạo báo cáo
        Report::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'reason'  => $request->input('reason'),
            'status'  => 'pending'
        ]);

        return redirect()->back()->with('success', 'Báo cáo bài viết đã được gửi.');
    }
}
