@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Đặt lại mật khẩu</h1>
    
    <form method="POST" action="{{ route('password.update') }}" class="w-50 mx-auto bg-light p-4 rounded shadow-sm">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="password" class="form-label">Mật khẩu mới:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu:</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
        </div>
    </form>
</div>
@endsection
