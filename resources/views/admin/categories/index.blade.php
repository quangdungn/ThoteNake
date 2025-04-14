@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Quản lý Chủ đề</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Thêm chủ đề mới</a>
    @if($categories->count())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên chủ đề</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Chỉnh sửa</a>
                            <!-- Sử dụng nút xóa với modal xác nhận -->
                            <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('admin.categories.destroy', $category->id) }}')">Xóa</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Không có chủ đề nào.</p>
    @endif
</div>
@endsection
