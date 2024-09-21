@extends('layouts.app')

@section('title', 'Quên mật khẩu')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Quên mật khẩu</h1>

    <!-- Thêm thông báo -->
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="w-50 mx-auto bg-light p-4 rounded shadow-sm">
        @csrf

        <div class="form-group mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" placeholder="Nhập địa chỉ email của bạn" required>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Gửi liên kết đặt lại mật khẩu</button>
        </div>
    </form>
</div>
@endsection
