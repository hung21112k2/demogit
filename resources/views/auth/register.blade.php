@extends('layouts.loginapp')

@section('title', 'Đăng Ký')

@section('content')
<style>
    /* Centering and spacing */
    .register-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f7f7f7;
        padding: 20px; /* Added padding for small screens */
    }

    .register-card {
        background-color: #ffffff;
        border-radius: 10px;
        padding: 30px 40px; /* More padding for a spacious feel */
        width: 100%;
        max-width: 500px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Enhanced shadow */
    }

    .register-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .register-header h2 {
        font-weight: bold;
        font-size: 1.8em;
        color: #333;
    }

    .register-form label {
        font-size: 1em;
        color: #555; /* Lighter color for labels */
        font-weight: bold;
    }

    .register-form input[type="text"],
    .register-form input[type="email"],
    .register-form input[type="password"] {
        width: 100%;
        padding: 12px 15px; /* Adjusted padding for consistent spacing */
        margin-top: 5px; /* Spacing between label and input */
        margin-bottom: 20px; /* More spacing between inputs */
        border: 1px solid #d11f2e; /* Red border */
        border-radius: 5px;
        font-size: 1em;
        transition: border-color 0.3s;
    }

    .register-form input:focus {
        border-color: #d11f2e; /* Red border on focus */
        outline: none;
        box-shadow: 0 0 5px rgba(209, 31, 46, 0.2); /* Red shadow */
    }

    .btn-register {
        background-color: #d11f2e; /* Red background for button */
        color: #ffffff;
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 5px;
        font-size: 1.1em;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 10px;
    }

    .btn-register:hover {
        background-color: #b31e27; /* Darker red on hover */
    }

    .text-center {
        text-align: center;
    }

    .register-footer {
        margin-top: 20px;
        font-size: 1em;
    }

    .register-footer a {
        color: #d11f2e; /* Red link color */
        text-decoration: none;
    }

    .register-footer a:hover {
        text-decoration: underline;
    }

    /* Alert styles for session messages */
    .alert {
        position: fixed;
        top: 10px;
        right: 10px;
        padding: 15px 20px;
        border-radius: 5px;
        color: #ffffff;
        background-color: #d11f2e; /* Red background for alert */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.5s;
    }

    .alert-info {
        background-color: #2196F3;
    }

    .alert-success {
        background-color: #d11f2e; /* Same red color for success alert */
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .form-group {
        margin-bottom: 20px;
    }

    .input-icon {
        position: relative;
    }

    .input-icon input {
        padding-left: 40px;
    }

    .input-icon i {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.2em;
        color: #d11f2e; /* Red color for icons */
    }

</style>

<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <h2>Tạo Tài Khoản Của Bạn</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}" class="register-form">
                @csrf
                <div class="form-group">
                    <label for="username">Tên Đăng Nhập</label>
                    <input type="text" name="username" class="form-control" id="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Địa Chỉ Email</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Số Điện Thoại</label>
                    <input type="text" name="phone" class="form-control" id="phone" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật Khẩu</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="form-group">
                    <label for="password-confirm">Xác Nhận Mật Khẩu</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password-confirm" required>
                </div>

                <button type="submit" class="btn btn-register">Đăng Ký</button>
            </form>
        </div>

        <div class="register-footer text-center">
            <p>Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập tại đây</a></p>
        </div>
    </div>
</div>
@endsection

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif  
