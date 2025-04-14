@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Quản lý Báo cáo Bài viết</h1>
    @if($reports->count())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID báo cáo</th>
                    <th>Bài viết</th>
                    <th>Người báo cáo</th>
                    <th>Lý do</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>
                            <a href="{{ route('posts.show', $report->post->id) }}">
                                {{ $report->post->title }}
                            </a>
                        </td>
                        <td>{{ $report->user->name }}</td>
                        <td>{{ $report->reason }}</td>
                        <td>
                            <!-- Bạn có thể thêm nút xử lý nếu cần -->
                            <span class="badge badge-danger">Chờ xử lý</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Không có báo cáo nào mới.</p>
    @endif
</div>
@endsection
