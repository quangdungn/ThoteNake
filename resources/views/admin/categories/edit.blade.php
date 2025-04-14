@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa Chủ đề</h1>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tên chủ đề:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea name="description" id="description" class="form-control">{{ $category->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
