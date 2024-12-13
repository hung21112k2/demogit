@extends('layouts.admin')

@section('title', 'Chỉnh sửa gói dịch vụ')

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

    /* Nhãn và ô nhập liệu */
    label {
        color: #343a40; /* Màu chữ tối cho nhãn */
        font-weight: bold;
    }

    .form-control {
        border: 1px solid #dc3545; /* Viền đỏ cho các ô nhập liệu */
        border-radius: 4px;
        padding: 10px;
    }

    .form-control:focus {
        border-color: #c82333; /* Đỏ đậm hơn khi focus */
        box-shadow: 0 0 5px rgba(220, 53, 69, 0.5);
    }

    /* Nút cập nhật */
    .btn-success {
        background-color: #dc3545; /* Nền đỏ cho nút */
        border-color: #dc3545;
        color: white;
        padding: 10px 20px;
        font-weight: bold;
        border-radius: 4px;
        width: 100%;
    }

    .btn-success:hover {
        background-color: #c82333; /* Đỏ đậm hơn khi hover */
        border-color: #bd2130;
    }

    /* Khoảng cách giữa các trường */
    .form-group {
        margin-bottom: 20px;
    }
</style>

<div class="container mt-5">
    <h1 class="text-center mb-4">Chỉnh sửa gói dịch vụ</h1>

    <form action="{{ route('admin.packages.update', $package->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên gói:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $package->name }}" required>
        </div>

        <div class="form-group">
            <label for="price">Giá:</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $package->price }}" required>
        </div>

        <div class="form-group">
            <label for="duration">Thời hạn (ngày):</label>
            <input type="number" class="form-control" id="duration" name="duration" value="{{ $package->duration }}" required>
        </div>

        <div class="form-group">
            <label for="post_limit">Giới hạn bài đăng:</label>
            <input type="number" class="form-control" id="post_limit" name="post_limit" value="{{ $package->post_limit }}" required>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật gói dịch vụ</button>
    </form>
</div>
@endsection
