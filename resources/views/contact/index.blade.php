@extends('layouts.app')

@section('title', 'Tài khoản của tôi')

@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">Thông tin tài khoản</h1>

    <!-- Thông báo thành công nếu có -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Hiển thị thông tin người dùng -->
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Tên</th>
                <th scope="col">Email</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Số dư tài khoản</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ number_format($user->balance, 2) }} VND</td>
            </tr>
        </tbody>
    </table>

    <!-- Form để cập nhật thông tin người dùng -->
    <h2 class="mt-5">Cập nhật thông tin tài khoản</h2>
    <form action="{{ route('user.update') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="username">Tên</label>
        <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>

    <div class="form-group">
        <label for="phone">Số điện thoại</label>
        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
    </div>

    <!-- Thêm trường để người dùng cập nhật mật khẩu -->
    <a href="{{ route('user.password.form') }}" class="btn btn-warning mt-3">Đổi mật khẩu</a>


    <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
</form>
</div>

@endsection
