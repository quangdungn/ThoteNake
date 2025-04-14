<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    // Hiển thị danh sách báo cáo bài viết
    public function index()
    {
        $reports = Report::with(['post', 'user'])->where('status', 'pending')->get();
        return view('admin.reports.index', compact('reports'));
    }
}
