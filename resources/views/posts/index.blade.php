@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách bài viết trong {{ $subject->name }}</h1>
    
    @if($posts->count())
        <ul>
            @foreach($posts as $post)
                <li>
                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>Chưa có bài viết nào.</p>
    @endif
    
    <a href="{{ route('subjects.show', $subject->id) }}">Quay lại Subject</a>
</div>
@endsection
    