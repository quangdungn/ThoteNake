@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Quên mật khẩu</h2>
    @if(session('success'))
       <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
       <div class="alert alert-danger">
           <ul>
              @foreach($errors->all() as $error)
                 <li>{{ $error }}</li>
              @endforeach
           </ul>
       </div>
    @endif
    <form action="{{ route('password.handleEmail') }}" method="POST">
       @csrf
       <div class="form-group">
         <label for="email">Nhập Email của bạn:</label>
         <input type="email" name="email" class="form-control" required>
       </div>
       <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
    </form>
</div>
@endsection
