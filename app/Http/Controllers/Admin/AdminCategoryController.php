<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    // Hiển thị danh sách chủ đề
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Hiển thị form tạo chủ đề mới
    public function create()
    {
        return view('admin.categories.create');
    }

    // Lưu chủ đề mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Category::create($request->only('name', 'description'));

        return redirect()->route('admin.categories.index')->with('success', 'Chủ đề đã được tạo thành công.');
    }

    // Hiển thị form chỉnh sửa chủ đề
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Cập nhật chủ đề
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category->update($request->only('name', 'description'));

        return redirect()->route('admin.categories.index')->with('success', 'Chủ đề đã được cập nhật.');
    }

    // Xoá chủ đề
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Chủ đề đã được xoá.');
    }
}
