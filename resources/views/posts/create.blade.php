@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tạo bài viết mới trong {{ $subject->name }}</h2>
    <div class="card shadow">
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

            <!-- Thêm attribute enctype để cho phép upload file -->
            <form action="{{ route('posts.store', $subject->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Tiêu đề:</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="form-group">
                    <label for="content">Nội dung:</label>
                    <textarea name="content" id="content" rows="6" class="form-control" required>{{ old('content') }}</textarea>
                </div>
                <!-- Trường upload hình ảnh -->
                <div class="form-group">
                    <label for="image">Hình ảnh (tùy chọn):</label>
                    <input type="file" name="image" id="image" class="form-control-file">
                </div>
                <!-- Trường upload tài liệu -->
                <div class="form-group">
                    <label for="document">Tài liệu (tùy chọn):</label>
                    <input type="file" name="document" id="document" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Tạo bài viết</button>
            </form>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-secondary">Quay lại</a>
    </div>
</div>
@endsection
