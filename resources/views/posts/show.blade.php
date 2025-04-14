@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow mb-3">
        <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            <p class="card-text">
                <small class="text-muted">Đăng bởi {{ $post->user->name }} - {{ $post->created_at->format('d/m/Y H:i') }}</small>
            </p>
            <hr>
            <div class="card-text">
                {!! nl2br(e($post->content)) !!}
            </div>
            <!-- Hiển thị hình ảnh nếu có -->
            @if($post->image_path)
                <div class="mt-3">
                    <img src="{{ asset('storage/' . $post->image_path) }}" class="img-fluid" alt="Hình ảnh bài viết">
                </div>
            @endif
            <!-- Hiển thị tài liệu nếu có -->
            @if($post->file_path)
                <div class="mt-3">
                    <a href="{{ asset('storage/' . $post->file_path) }}" target="_blank" class="btn btn-info">
                        Xem tài liệu
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Nút chỉnh sửa bài viết: chỉ hiển thị nếu người dùng là chủ sở hữu hoặc Admin -->
    @auth
        @if(Auth::id() == $post->user_id || Auth::user()->role === 'admin')
            <div class="mb-3">
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Chỉnh sửa bài viết</a>
            </div>
        @endif
    @endauth

    <!-- Nút xóa bài viết (nếu có) và các phần khác -->
    @auth
        @if(Auth::id() == $post->user_id || Auth::user()->role === 'admin')
            <div class="mb-3">
                <button class="btn btn-danger" onclick="confirmDelete('{{ route('posts.destroy', $post->id) }}')">
                    Xóa bài viết
                </button>
            </div>
        @endif
    @endauth


    <!-- Phần bình luận (nếu có) -->
    <div class="card shadow mb-3">
        <div class="card-header">
            <h5>Bình luận</h5>
        </div>
        <div class="card-body">
            @forelse($post->comments as $comment)
                <div class="media mb-3">
                    <div class="media-body">
                        <h6 class="mt-0">{{ $comment->user->name }}</h6>
                        <p>{{ $comment->content }}</p>
                    </div>
                </div>
            @empty
                <p>Chưa có bình luận nào.</p>
            @endforelse
        </div>
        @auth
        <div class="card-footer">
            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea name="content" rows="3" class="form-control" placeholder="Viết bình luận..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Gửi bình luận</button>
            </form>
        </div>
        @endauth
    </div>

    <!-- Phần báo cáo bài viết (chỉ hiển thị khi đã đăng nhập) -->
    @auth
    <div class="card shadow mb-3">
        <div class="card-header">
            <h5>Báo cáo bài viết</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('report.store', $post->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="reason">Lý do báo cáo:</label>
                    <textarea name="reason" id="reason" class="form-control" rows="3" placeholder="Nhập lý do báo cáo bài viết" required></textarea>
                    @error('reason')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-danger">Gửi báo cáo</button>
            </form>
        </div>
    </div>
    @endauth

    <a href="{{ route('posts.index', $post->subject->id) }}" class="btn btn-secondary">Quay lại danh sách bài viết</a>
</div>
@endsection
