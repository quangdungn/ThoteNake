<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Hiển thị danh sách bài viết của 1 Subject
    public function index($subjectId)
    {
        $subject = Subject::findOrFail($subjectId);
        $posts = $subject->posts()->latest()->paginate(10);
        return view('posts.index', compact('subject', 'posts'));
    }

    // Hiển thị form tạo bài viết mới
    public function create($subjectId)
    {
        $subject = Subject::findOrFail($subjectId);
        return view('posts.create', compact('subject'));
    }

    public function store(Request $request, $subjectId)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'document' => 'nullable|file|mimes:pdf,doc,docx,txt|max:5120'
        ]);
    
        $subject = Subject::findOrFail($subjectId);
    
        $data = [
            'subject_id' => $subject->id,
            'user_id'    => Auth::id(),
            'title'      => $request->input('title'),
            'content'    => $request->input('content'),
            'status'     => 'published',
            'pinned'     => false,
        ];
    
        if ($request->hasFile('image')) {
            // Lưu file vào thư mục storage/app/public/posts/images
            $data['image_path'] = $request->file('image')->store('posts/images', 'public');
        }
    
        if ($request->hasFile('document')) {
            // Lưu file vào thư mục storage/app/public/posts/documents
            $data['file_path'] = $request->file('document')->store('posts/documents', 'public');
        }
    
        Post::create($data);
    
        return redirect()->route('posts.index', $subject->id)
                         ->with('success', 'Bài viết được tạo thành công.');
    }
    
    // Hiển thị chi tiết bài viết kèm theo bình luận
    public function show($id)
    {
        $post = Post::with(['user', 'comments.user'])->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function destroy($postId)
    {
        $post = Post::findOrFail($postId);
    
        // Kiểm tra quyền: chỉ chủ sở hữu hoặc Admin mới được xoá
        if (Auth::id() == $post->user_id || Auth::user()->role === 'admin') {
            // Lưu lại subject ID trước khi xoá bài viết
            $subjectId = $post->subject_id;
            
            // Xóa bài viết
            $post->delete();
            
            // Chuyển hướng đến route 'posts.index' với subject ID để hiển thị danh sách bài viết
            return redirect()->route('posts.index', $subjectId)
                             ->with('success', 'Bài viết đã được xoá.');
        } else {
            return redirect()->back()->with('error', 'Bạn không có quyền xoá bài viết này.');
        }
    }
    public function edit($postId)
    {
        $post = Post::findOrFail($postId);
        
        // Kiểm tra quyền: nếu không phải chủ sở hữu và không phải admin thì từ chối
        if (Auth::id() != $post->user_id && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Bạn không có quyền chỉnh sửa bài viết này.');
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Cập nhật bài viết sau khi chỉnh sửa.
     *
     * Chỉ cho phép chủ sở hữu bài viết hoặc Admin cập nhật.
     */
    public function update(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);

        // Kiểm tra quyền chỉnh sửa
        if (Auth::id() != $post->user_id && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Bạn không có quyền cập nhật bài viết này.');
        }

        $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'document' => 'nullable|file|mimes:pdf,doc,docx,txt|max:5120'
        ]);

        $data = [
            'title'   => $request->input('title'),
            'content' => $request->input('content'),
        ];

        // Xử lý cập nhật hình ảnh nếu có file mới được tải lên
        if ($request->hasFile('image')) {
            // (Nếu cần, có thể xóa file cũ trước khi cập nhật)
            $data['image_path'] = $request->file('image')->store('posts/images', 'public');
        }

        // Xử lý cập nhật tài liệu nếu có file mới được tải lên
        if ($request->hasFile('document')) {
            $data['file_path'] = $request->file('document')->store('posts/documents', 'public');
        }

        $post->update($data);

        // Chuyển hướng về trang chi tiết bài viết hoặc danh sách bài viết
        return redirect()->route('posts.show', $post->id)
                         ->with('success', 'Bài viết đã được cập nhật thành công.');
    }
}
