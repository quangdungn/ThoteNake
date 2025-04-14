<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Category;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Hiển thị danh sách Subject theo Category
    public function index($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $subjects = $category->subjects; // Lấy danh sách subject của category đó
        
        // Truyền cả $category và $subjects sang view
        return view('subjects.index', compact('category', 'subjects'));
    }
    

    // Hiển thị chi tiết 1 Subject, bao gồm danh sách bài Post
    public function show($id)
    {
        $subject = Subject::with('posts')->findOrFail($id);
        return view('subjects.show', compact('subject'));
    }

    // Các hàm create, store, edit, update, destroy nếu cần (cho admin)
}
