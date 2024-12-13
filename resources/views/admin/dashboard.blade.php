@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<style>
    .admin-content {
        background-color: #ffffff; /* Nền trắng cho nội dung */
        padding: 20px;
    }

    .admin-content h2 {
        text-align: center; /* Căn giữa tiêu đề */
        font-size: 2.2rem;
        color: #000000; /* Màu đỏ */
        margin-bottom: 30px; /* Khoảng cách dưới tiêu đề */
    }

    .admin-card {
        background-color: #f44336; /* Màu nền đỏ */
        color: #ffffff; /* Màu chữ trắng */
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 8px; /* Bo góc cho các thẻ */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Hiệu ứng bóng nhẹ */
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .admin-card h3 {
        font-size: 1.8rem;
        font-weight: bold;
        margin-bottom: 10px;
        color: #ffffff; /* Màu chữ trắng */
    }

    .admin-card p {
        font-size: 1rem;
        line-height: 1.5;
        color: #ffffff; /* Màu chữ trắng */
    }

    /* Hiệu ứng khi hover lên thẻ admin */
    .admin-card:hover {
        transform: translateY(-5px); /* Thẻ sẽ hơi nhô lên khi hover */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Bóng mạnh hơn khi hover */
    }

    /* Căn giữa các tiêu đề và nội dung */
    .admin-card h3, .admin-card p {
        text-align: center;
    }


</style>

<div class="admin-content">
    <h2>Welcome to the Admin Dashboard</h2>
    <div class="admin-card">
        <h3>Thống kê người dùng</h3>
        <p>Hiển thị số liệu về người dùng.</p>
    </div>

    <div class="admin-card">
        <h3> Các loại xe đang được đăng trên web </h3>
        <p>Hiển thị các chức năng quản lý sản phẩm.</p>
    </div>

    <div class="admin-card">
        <h3>Quản lý bài đăng</h3>
        <p>Hiển thị các bài đăng của khách.</p>
    </div>

    <div class="admin-card">
        <h3>Quản lý các gói dịch vụ</h3>
        <p>Hiển thị các gói dịch vụ của bạn.</p>
    </div>
</div>
@endsection
