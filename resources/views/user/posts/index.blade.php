@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Bài viết của tôi</h3>
    @if($posts->count())
        <div class="list-group">
            @foreach($posts as $post)
                <a href="{{ route('posts.show', $post->id) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $post->title }}</h5>
                        <small>{{ $post->created_at->format('d/m/Y') }}</small>
                    </div>
                    <p class="mb-1">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                </a>
            @endforeach
        </div>
        <div class="mt-3">
            {{ $posts->links() }}
        </div>
    @else
        <p>Bạn chưa đăng bài viết nào.</p>
    @endif
    <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Quay lại trang chủ</a>
</div>
@endsection
