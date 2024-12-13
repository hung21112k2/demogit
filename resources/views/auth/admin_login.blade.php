<!-- resources/views/auth/admin_login.blade.php -->
@extends('layouts.loginapp')

@section('title', 'Đăng nhập Admin')

@section('content')
<style>
/* CSS cho phần đăng nhập Admin */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #F5F5F5;
}

.login-card {
    background-color: white;
    border-radius: 10px;
    padding: 30px;
    width: 100%;
    max-width: 600px; /* Kích thước chiều rộng giống login.blade.php */
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

.login-header {
    text-align: center;
    margin-bottom: 20px;
}

.login-header h3 {
    font-weight: bold;
    font-size: 1.8em; /* Giữ kích thước chữ giống phần login */
}

.login-form input[type="email"],
.login-form input[type="password"] {
    width: 100%;
    padding: 15px; /* Tăng kích thước padding cho input */
    margin-bottom: 15px; /* Tăng khoảng cách giữa các input */
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1.2em; /* Tăng kích thước font của input */
}

.login-form input[type="checkbox"] {
    margin-right: 10px;
}

.btn-login {
    background-color: #f44336;
    color: white;
    width: 100%;
    padding: 15px; /* Tăng kích thước padding cho nút */
    border: none;
    border-radius: 5px;
    font-size: 1.2em; /* Tăng kích thước chữ của nút */
}

.btn-login:hover {
    background-color: #d32f2f;
}

.text-center {
    text-align: center;
}

.login-footer {
    margin-top: 20px;
    font-size: 1em;
}

.login-footer a {
    color: #f44336;
    text-decoration: none;
}

.login-footer a:hover {
    text-decoration: underline;
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
    color: #888;
}

.form-check-label {
    font-size: 1em; /* Tăng kích thước chữ của phần nhớ tài khoản */
}

/* Đăng nhập dành cho Admin */
.admin-login {
    font-size: 1em; /* Tăng kích thước chữ */
    color: #f44336;
    text-decoration: none;
}

.admin-login:hover {
    text-decoration: underline;
}

</style>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h3>Đăng nhập Admin</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.login.submit') }}" class="login-form">
                @csrf
                <div class="form-group input-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Địa chỉ email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group input-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Mật khẩu" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                </div>

                <button type="submit" class="btn btn-login">Đăng nhập</button>
            </form>
        </div>
    </div>
</div>
@endsection
