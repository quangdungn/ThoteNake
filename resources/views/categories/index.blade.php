@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Danh sách Chủ đề</h1>
    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="card-text">{{ $category->description }}</p>
                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
