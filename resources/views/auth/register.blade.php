@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Đăng ký</h4>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tên:</label>
                        <input type="text" class="form-control" name="name" id="name" 
                               value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" 
                               value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Xác nhận mật khẩu:</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Đăng ký</button>
                </form>
            </div>
            <div class="card-footer text-center">
                Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
            </div>
        </div>
    </div>
</div>
@endsection
