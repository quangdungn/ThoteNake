@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Quản lý Người dùng</h1>
    @if($users->count())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Đã phê duyệt</th>
                    <th>Bị khóa</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->approved ? 'Có' : 'Chưa' }}</td>
                        <td>{{ $user->locked ? 'Có' : 'Không' }}</td>
                        <td>
                            @if(!$user->locked)
                                <form action="{{ route('admin.users.lock', $user->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button class="btn btn-sm btn-warning" onclick="return confirm('Bạn có chắc muốn khóa tài khoản này?')">Khóa</button>
                                </form>
                            @else
                                <form action="{{ route('admin.users.unlock', $user->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button class="btn btn-sm btn-info" onclick="return confirm('Bạn có chắc muốn mở khóa tài khoản này?')">Mở khóa</button>
                                </form>
                            @endif
                            @if(!$user->approved)
                                <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button class="btn btn-sm btn-success" onclick="return confirm('Phê duyệt tài khoản này?')">Phê duyệt</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Không có tài khoản người dùng nào.</p>
    @endif
</div>
@endsection
