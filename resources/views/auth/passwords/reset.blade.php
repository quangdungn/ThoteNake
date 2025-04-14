@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Đặt lại mật khẩu</h2>
    @if($errors->any())
      <div class="alert alert-danger">
         <ul>
           @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
           @endforeach
         </ul>
      </div>
    @endif
    <form action="{{ route('password.update') }}" method="POST">
      @csrf
      <input type="hidden" name="email" value="{{ $email }}">
      <input type="hidden" name="token" value="{{ $token }}">
      <div class="form-group">
          <label for="password">Mật khẩu mới:</label>
          <input type="password" name="password" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="password_confirmation">Xác nhận mật khẩu mới:</label>
          <input type="password" name="password_confirmation" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
    </form>
</div>
@endsection
