<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Hiển thị danh sách Category (Trang chủ)
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Hiển thị form tạo Category mới (dành cho admin nếu cần)
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create($request->only('name', 'description'));
        return redirect()->route('categories.index')->with('success', 'Category được tạo thành công');
    }

    // Hiển thị chi tiết 1 Category, ví dụ hiển thị các Subject của Category đó
    public function show(Category $category)
    {
        // load subjects
        $category->load('subjects');
        return view('categories.show', compact('category'));
    }
    
    // Sửa, cập nhật và xoá có thể được thêm vào sau
}
