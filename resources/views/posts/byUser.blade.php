@extends('layouts.loginapp')

@section('title', 'Bài Đăng của Người Dùng')

@section('content')
<style>
    /* Đặt toàn bộ trang với font và căn giữa */
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    color: #333;
    margin: 0;
    padding: 0;
}

/* Căn giữa toàn bộ nội dung và tạo khoảng cách */
.container {
    max-width: 900px;
    margin: auto;
    padding: 20px;
}

/* Tạo style cho tiêu đề */
h1 {
    font-size: 2rem;
    color: #333;
    font-weight: bold;
    text-align: center;
}

/* Căn chỉnh bảng */
.table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 5px;
    overflow: hidden;
    margin-top: 20px;
}

/* Màu nền và màu chữ cho header của bảng */
.table thead th {
    background-color: #343a40;
    color: #ffffff;
    padding: 12px;
    text-align: center;
    font-weight: bold;
}

/* Kiểu bảng */
.table tbody td {
    padding: 12px;
    border-bottom: 1px solid #dee2e6;
    text-align: center;
}

/* Viền tròn cho hình ảnh trong bảng */
.table img {
    border-radius: 5px;
    max-width: 100px;
}

/* Hiệu ứng hover cho các hàng trong bảng */
.table-hover tbody tr:hover {
    background-color: #f5f5f5;
    cursor: pointer;
}

/* Căn giữa thông báo nếu không có bài đăng nào */
.alert-warning {
    font-size: 1.1rem;
    color: #856404;
    background-color: #fff3cd;
    border-color: #ffeeba;
    text-align: center;
    padding: 10px;
    border-radius: 5px;
}

/* Style cho nút */
.btn {
    display: inline-block;
    font-weight: 400;
    color: #fff;
    text-align: center;
    vertical-align: middle;
    user-select: none;
    background-color: #007bff;
    border: 1px solid #007bff;
    padding: 10px 15px;
    font-size: 1rem;
    border-radius: 5px;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
    text-decoration: none;
    width: 100%;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

/* Media query để đảm bảo giao diện tốt trên các thiết bị nhỏ */
@media (max-width: 768px) {
    .table, .table thead, .table tbody, .table th, .table td, .table tr {
        display: block;
        width: 100%;
    }
    
    .table thead tr {
        display: none;
    }
    
    .table tbody tr {
        margin-bottom: 15px;
        border: 1px solid #ddd;
    }

    .table tbody td {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        text-align: left;
    }

    .table tbody td::before {
        content: attr(data-label);
        font-weight: bold;
        width: 50%;
    }

    h1 {
        font-size: 1.5rem;
    }
}

    </style>
<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách Bài Đăng của Người Dùng</h1>

    @if($posts->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            Người dùng này chưa có bài đăng nào.
        </div>
    @else
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số km đã đi</th>
                    <th scope="col">Năm sản xuất</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col"></th> <!-- Thêm cột Hành động -->
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->description }}</td>
                        <td>{{ number_format($post->price) }} VND</td>
                        <td>{{ $post->mileage }} km</td>
                        <td>{{ $post->year }}</td>
                        <td><img src="{{ asset($post->image_url) }}" alt="Hình ảnh" style="max-width: 100px;" class="img-thumbnail"></td>
                        <td>
                            <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="btn btn-primary w-100">Xem chi tiết</a> <!-- Thêm nút Xem chi tiết -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
