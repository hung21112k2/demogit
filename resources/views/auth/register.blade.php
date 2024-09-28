@extends('layouts.loginapp')

@section('title', 'Register')

@section('content')
<style>
    /* CSS cho phần đăng ký */
    .register-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #FFFFFF;
    }

    .register-card {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        width: 100%;
        max-width: 600px; /* Tăng kích thước chiều rộng */
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .register-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .register-header h2 {
        font-weight: bold;
        font-size: 1.8em; /* Tăng kích thước chữ của tiêu đề */
    }

    .register-form input[type="text"],
    .register-form input[type="email"],
    .register-form input[type="password"] {
        width: 100%;
        padding: 15px; /* Tăng kích thước padding cho input */
        margin-bottom: 15px; /* Tăng khoảng cách giữa các input */
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1.2em; /* Tăng kích thước font của input */
    }

    .btn-register {
        background-color: #4CAF50;
        color: white;
        width: 100%;
        padding: 15px; /* Tăng kích thước padding cho nút */
        border: none;
        border-radius: 5px;
        font-size: 1.2em; /* Tăng kích thước chữ của nút */
    }

    .btn-register:hover {
        background-color: #388E3C;
    }

    .text-center {
        text-align: center;
    }

    .register-footer {
        margin-top: 20px;
        font-size: 1em;
    }

    .register-footer a {
        color: #4CAF50;
        text-decoration: none;
    }

    .register-footer a:hover {
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

</style>

<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <h2>Create Your Account</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}" class="register-form">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" class="form-control" id="phone" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password-confirm" required>
                </div>

                <button type="submit" class="btn btn-register">Register</button>
            </form>
        </div>

        <div class="register-footer text-center">
            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </div>
    </div>
</div>
@endsection

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
