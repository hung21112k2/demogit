@extends('layouts.app')

@section('title', 'Đăng ký thành công')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h2>Tài khoản của bạn đã được xác nhận!</h2>
            <p>Bạn đã xác thực tài khoản thành công. Bây giờ bạn có thể đăng nhập và sử dụng hệ thống.</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập ngay</a>
        </div>
    </div>
</div>
@endsection
