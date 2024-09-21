@extends('layouts.app')

@section('title', 'Đổi mật khẩu')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Đổi mật khẩu</h1>

    <!-- Hiển thị lỗi xác thực nếu có -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form thay đổi mật khẩu -->
    <form action="{{ route('user.password.update') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="current_password">Mật khẩu hiện tại</label>
            <input type="password" name="current_password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="new_password">Mật khẩu mới</label>
            <input type="password" name="new_password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
            <input type="password" name="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Đổi mật khẩu</button>
    </form>
</div>
@endsection
