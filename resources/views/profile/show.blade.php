@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white">
            <h3>Thông tin cá nhân</h3>
        </div>
        <div class="card-body">
            <p><strong>Tên:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <!-- Thêm các thông tin khác nếu cần -->
        </div>
    </div>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại trang chủ</a>
</div>
@endsection
