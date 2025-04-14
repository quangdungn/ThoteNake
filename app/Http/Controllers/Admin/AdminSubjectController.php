<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminSubjectController extends Controller
{
    // Hiển thị danh sách Subject của tất cả các Category (hoặc bạn có thể lọc theo Category)
    public function index()
    {
        // Lấy tất cả Subject, có thể kèm theo quan hệ Category nếu cần
        $subjects = Subject::with('category')->get();
        return view('admin.subjects.index', compact('subjects'));
    }

    // Hiển thị form tạo Subject mới
    public function create()
    {
        // Để tạo Subject, admin cần chọn Category cha
        $categories = Category::all();
        return view('admin.subjects.create', compact('categories'));
    }

    // Lưu Subject mới
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Subject::create($request->only('category_id', 'name', 'description'));

        return redirect()->route('admin.subjects.index')->with('success', 'Subject mới đã được tạo.');
    }

    // Hiển thị chi tiết Subject (nếu cần, thường không cần thiết trong quản lý admin)
    public function show(Subject $subject)
    {
        return view('admin.subjects.show', compact('subject'));
    }

    // Hiển thị form chỉnh sửa Subject
    public function edit(Subject $subject)
    {
        $categories = Category::all();
        return view('admin.subjects.edit', compact('subject', 'categories'));
    }

    // Cập nhật Subject
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $subject->update($request->only('category_id', 'name', 'description'));

        return redirect()->route('admin.subjects.index')->with('success', 'Subject đã được cập nhật.');
    }

    // Xoá Subject
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Subject đã được xoá.');
    }
}
