@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa bài viết</h2>
    <div class="card shadow mb-3">
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                           <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form chỉnh sửa bài viết -->
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Tiêu đề:</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                </div>
                <div class="form-group">
                    <label for="content">Nội dung:</label>
                    <textarea name="content" id="content" rows="6" class="form-control" required>{{ old('content', $post->content) }}</textarea>
                </div>
                <!-- Hiển thị hình ảnh hiện tại nếu có -->
                @if($post->image_path)
                    <div class="form-group">
                        <label>Hình ảnh hiện tại:</label><br>
                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="Hình ảnh bài viết" class="img-fluid" style="max-width:300px;">
                    </div>
                @endif
                <!-- Tải lên hình ảnh mới nếu cần -->
                <div class="form-group">
                    <label for="image">Tải lên hình ảnh mới (nếu muốn thay đổi):</label>
                    <input type="file" name="image" id="image" class="form-control-file">
                </div>
                <!-- Hiển thị tài liệu hiện tại nếu có -->
                @if($post->file_path)
                    <div class="form-group">
                        <label>Tài liệu hiện tại:</label><br>
                        <a href="{{ asset('storage/' . $post->file_path) }}" target="_blank" class="btn btn-info">Xem tài liệu</a>
                    </div>
                @endif
                <!-- Tải lên tài liệu mới nếu cần -->
                <div class="form-group">
                    <label for="document">Tải lên tài liệu mới (nếu muốn thay đổi):</label>
                    <input type="file" name="document" id="document" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>
@endsection
