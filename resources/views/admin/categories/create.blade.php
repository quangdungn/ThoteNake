@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm chủ đề mới</h1>
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên chủ đề:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Thêm chủ đề</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
