@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Quản lý Subject</h1>
    <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary mb-3">Thêm Subject mới</a>
    @if($subjects->count())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Subject</th>
                    <th>Thuộc Category</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                    <tr>
                        <td>{{ $subject->id }}</td>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->category->name ?? 'N/A' }}</td>
                        <td>{{ $subject->description }}</td>
                        <td>
                            <a href="{{ route('admin.subjects.edit', $subject->id) }}" class="btn btn-sm btn-warning">Chỉnh sửa</a>
                            <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('admin.subjects.destroy', $subject->id) }}')">Xóa</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Không có Subject nào.</p>
    @endif
</div>
@endsection
