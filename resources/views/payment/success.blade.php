@extends('layouts.loginapp')

@section('content')
<style>
    .container {
    background-color: #ffffff; /* Nền trắng */
    border: 1px solid #007bff; /* Viền xanh dương */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #007bff; /* Màu xanh dương cho tiêu đề */
    font-weight: bold;
}

p {
    color: #6c757d; /* Màu xám nhạt cho văn bản */
    font-size: 1.1rem;
}

.btn-primary {
    background-color: #007bff; /* Nền xanh dương */
    border-color: #007bff;
    color: #fff; /* Chữ trắng */
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 5px;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

/* Hiệu ứng logo VNPay */
img {
    width: 150px;
    margin-bottom: 20px;
}

    </style>
    <div class="container mt-5 text-center">
        <img src="{{ asset('images/1581089357407-1580819448160-vnpay.png') }}" alt="VNPay Logo" class="mb-4" style="width: 150px; height: auto;">

        <h1 class="text-primary mb-4">Nạp tiền thành công</h1>
        <p class="text-secondary">Cảm ơn bạn! Số tiền đã được nạp vào tài khoản của bạn.</p>

        <a href="{{ url('/') }}" class="btn btn-primary mx-auto" style="width: 200px;">Quay lại trang chủ</a>
    </div>
@endsection
