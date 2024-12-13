@extends('layouts.loginapp')

@section('title', 'Tài khoản của tôi')

@section('content')
<style>
    /* Căn chỉnh container */
    .container {
        margin-top: 50px;
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Tiêu đề */
    h1, h2 {
        color: #dc3545; /* Màu đỏ cho tiêu đề */
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
    }

    /* Bảng thông tin người dùng */
    .table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        border-spacing: 0;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .table th, .table td {
        padding: 15px;
        text-align: left;
    }

    .table th {
        background-color: #343a40; /* Nền đen cho tiêu đề bảng */
        color: white;
        font-weight: bold;
        text-transform: uppercase;
    }

    .table td {
        background-color: #f9f9f9;
        border-bottom: 1px solid #ddd;
    }

    .table-bordered {
        border: 1px solid #ddd;
    }

    /* Căn chỉnh nút và form */
    label {
        color: #343a40; /* Màu chữ tối cho nhãn */
        font-weight: bold;
    }

    .form-control {
        border: 1px solid #dc3545; /* Viền đỏ cho ô nhập liệu */
        border-radius: 4px;
        padding: 10px;
    }

    .form-control:focus {
        border-color: #c82333;
        box-shadow: 0 0 5px rgba(220, 53, 69, 0.5);
    }

    /* Nút cập nhật và đổi mật khẩu */
    .btn-primary, .btn-warning {
        padding: 10px 20px;
        border-radius: 4px;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #dc3545; /* Nút đỏ */
        border-color: #dc3545;
    }

    .btn-primary:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .btn-warning {
        background-color: #ffc107; /* Nút vàng */
        border-color: #ffc107;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
    }

    /* Hiển thị thông báo thành công */
    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        padding: 10px;
        border-radius: 4px;
    }
</style>

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
