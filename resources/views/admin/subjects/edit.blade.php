@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa Subject</h1>
    <form action="{{ route('admin.subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category_id">Chọn Category:</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">-- Chọn Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $subject->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Tên Subject:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $subject->name }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea name="description" id="description" class="form-control">{{ $subject->description }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật Subject</button>
        <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
