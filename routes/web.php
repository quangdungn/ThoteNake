<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Route gốc: chuyển hướng tùy theo trạng thái đăng nhập
Route::get('/', function () {
    return Auth::check() ? redirect()->route('categories.index') : redirect()->route('login');
});

// Các route cho guest (không cần đăng nhập)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Các route cho người dùng đã đăng nhập
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Trang chủ: Danh sách chủ đề (categories)
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

    // Subject
    Route::get('/categories/{category}/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/subjects/{subject}', [SubjectController::class, 'show'])->name('subjects.show');

    // Bài viết
    Route::get('/subjects/{subject}/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/subjects/{subject}/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/subjects/{subject}/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    // Bình luận
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Thông tin cá nhân và bài viết của tôi
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/users/{user}/posts', [UserPostController::class, 'index'])->name('user.posts.index');

    Route::post('/posts/{post}/report', [ReportController::class, 'store'])->name('report.store');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::get('/posts/{post}/edit', [\App\Http\Controllers\PostController::class, 'edit'])
         ->name('posts.edit');
    Route::put('/posts/{post}', [\App\Http\Controllers\PostController::class, 'update'])
         ->name('posts.update');

});

// Các route cho Admin (chỉ Admin được truy cập)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Quản lý chủ đề (categories)
    Route::resource('categories', AdminCategoryController::class);
    
    // Quản lý người dùng (chỉ thao tác khóa/mở khóa và phê duyệt)
    Route::resource('users', AdminUserController::class)->except(['create', 'store', 'show', 'edit', 'update']);
    Route::post('users/{id}/approve', [AdminUserController::class, 'approve'])->name('users.approve');
    Route::post('users/{id}/lock', [AdminUserController::class, 'lock'])->name('users.lock');
    Route::post('users/{id}/unlock', [AdminUserController::class, 'unlock'])->name('users.unlock');
    
    // Quản lý báo cáo bài viết (nếu có)
    Route::get('reports', [AdminReportController::class, 'index'])->name('reports.index');
        // Quản lý Chủ đề (Category) và Người dùng đã có từ trước...
    Route::resource('categories', \App\Http\Controllers\Admin\AdminCategoryController::class);
    Route::resource('users', \App\Http\Controllers\Admin\AdminUserController::class)->except(['create', 'store', 'show', 'edit', 'update']);
    Route::post('users/{id}/approve', [\App\Http\Controllers\Admin\AdminUserController::class, 'approve'])->name('users.approve');
    Route::post('users/{id}/lock', [\App\Http\Controllers\Admin\AdminUserController::class, 'lock'])->name('users.lock');
    Route::post('users/{id}/unlock', [\App\Http\Controllers\Admin\AdminUserController::class, 'unlock'])->name('users.unlock');
    Route::get('reports', [\App\Http\Controllers\Admin\AdminReportController::class, 'index'])->name('reports.index');

    // Thêm resource route cho Subject
    Route::resource('subjects', \App\Http\Controllers\Admin\AdminSubjectController::class);
});

Route::get('password/forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('password/forgot', [ForgotPasswordController::class, 'handleEmailRequest'])
    ->name('password.handleEmail');

Route::get('password/reset', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update');