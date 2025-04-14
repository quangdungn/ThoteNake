@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Thông tin Subject -->
    <div class="card shadow mb-4">
        <div class="card-header bg-secondary text-white">
            <h2 class="mb-0">{{ $subject->name }}</h2>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $subject->description }}</p>
        </div>
    </div>

    <!-- Nút tạo bài viết (chỉ hiển thị nếu đã đăng nhập) -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Danh sách bài viết</h3>
        @auth
            <a href="{{ route('posts.create', $subject->id) }}" class="btn btn-primary">Tạo bài viết mới</a>
        @endauth
    </div>

    <!-- Danh sách bài viết của Subject -->
    @if($subject->posts->count())
        <div class="list-group">
            @foreach($subject->posts as $post)
                <a href="{{ route('posts.show', $post->id) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $post->title }}</h5>
                        <small>{{ $post->created_at->format('d/m/Y') }}</small>
                    </div>
                    <p class="mb-1">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                    <small>Đăng bởi: {{ $post->user->name }}</small>
                </a>
            @endforeach
        </div>
    @else
        <p>Chưa có bài viết nào.</p>
    @endif

    <div class="mt-4">
        <a href="{{ route('subjects.index', $subject->category->id) }}" class="btn btn-secondary">Quay lại danh sách chủ đề</a>
    </div>
</div>
@endsection
