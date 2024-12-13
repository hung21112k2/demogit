@extends('layouts.app')

@section('content')
<style>
    /* Custom CSS cho tone màu đỏ và trắng */
    .container {
        margin-top: 50px;
        background-color: white; /* Nền trắng */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Hiệu ứng đổ bóng */
    }

    h1 {
        color: #dc3545; /* Màu đỏ */
        font-size: 2rem;
        font-weight: bold;
    }

    p {
        color: #555;
        font-size: 1.1rem;
        text-align: center;
    }

    .btn-primary {
        background-color: #dc3545; /* Nút màu đỏ */
        border-color: #dc3545;
        color: white;
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #c82333; /* Đỏ đậm khi hover */
        border-color: #c82333;
    }

    /* Tạo hiệu ứng cho button */
    .btn {
        display: block;
        width: 200px;
        margin: 20px auto 0;
    }

</style>

<div class="container">
    <h1 class="text-center">Thanh toán thất bại</h1>
    <p class="text-center">Xin lỗi, quá trình thanh toán đã không thành công. Vui lòng thử lại.</p>
    <a href="{{ url('/') }}" class="btn btn-primary d-block mx-auto">Quay lại trang chủ</a>
</div>
@endsection
