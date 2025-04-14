@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Thông tin Category -->
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white">
            <h2 class="mb-0">{{ $category->name }}</h2>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $category->description }}</p>
        </div>
    </div>

    <!-- Danh sách Subject thuộc Category -->
    <h3>Các chủ đề con trong "{{ $category->name }}"</h3>
    @if($category->subjects->count())
        <div class="row">
            @foreach($category->subjects as $subject)
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ $subject->name }}</h5>
                            <p class="card-text">{{ $subject->description }}</p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-primary btn-block">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            Hiện không có chủ đề con nào trong "{{ $category->name }}".
        </div>
    @endif

    <div class="mt-3">
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại danh sách Category</a>
    </div>
</div>
@endsection
