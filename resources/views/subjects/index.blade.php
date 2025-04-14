@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách Chủ đề con trong {{ $category->name }}</h1>
    <ul class="list-group">
        @foreach($subjects as $subject)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('subjects.show', $subject->id) }}">{{ $subject->name }}</a>
                <span class="badge badge-primary badge-pill">{{ $subject->posts->count() }} bài viết</span>
            </li>
        @endforeach
    </ul>
    <div class="mt-3">
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại danh sách chủ đề</a>
    </div>
</div>
@endsection
