@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm Subject mới</h1>
    <form action="{{ route('admin.subjects.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="category_id">Chọn Category:</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">-- Chọn Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Tên Subject:</label>
            <input type="text" name="name" id="name" class="form-control" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea name="description" id="description" class="form-control"></textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Thêm Subject</button>
        <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm Subject mới</h1>
    <form action="{{ route('admin.subjects.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="category_id">Chọn Category:</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">-- Chọn Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Tên Subject:</label>
            <input type="text" name="name" id="name" class="form-control" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea name="description" id="description" class="form-control"></textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Thêm Subject</button>
        <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
