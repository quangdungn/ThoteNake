@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Đăng nhập</h4>
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

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" 
                               value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
                </div>
            </div>
            <div class="card-footer text-center">
                Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a>
            </div>
        </div>
    </div>
</div>
@endsection
