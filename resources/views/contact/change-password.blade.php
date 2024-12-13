@extends('layouts.app')

@section('title', 'Đổi mật khẩu')

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
    h1 {
        color: #dc3545; /* Màu đỏ cho tiêu đề */
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
    }

    /* Style cho form và input */
    .form-group label {
        color: #343a40; /* Màu chữ tối cho nhãn */
        font-weight: bold;
    }

    .form-control {
        border: 1px solid #dc3545; /* Viền đỏ cho ô nhập liệu */
        border-radius: 4px;
        padding: 10px;
    }

    .form-control:focus {
        border-color: #c82333; /* Viền đỏ đậm hơn khi focus */
        box-shadow: 0 0 5px rgba(220, 53, 69, 0.5);
    }

    /* Nút Đổi mật khẩu */
    .btn-primary {
        background-color: #dc3545; /* Nút đỏ */
        border-color: #dc3545;
        padding: 10px 20px;
        border-radius: 4px;
        font-weight: bold;
    }

    .btn-primary:hover {
        background-color: #c82333; /* Đỏ đậm hơn khi hover */
        border-color: #bd2130;
    }

    /* Thông báo lỗi */
    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
        padding: 10px;
        border-radius: 4px;
    }

</style>

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
