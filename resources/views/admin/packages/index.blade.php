@extends('layouts.admin')

@section('title', 'Quản lý Gói dịch vụ')

@section('content')
<style>
    /* Căn chỉnh container */
    .container {
        margin-top: 50px;
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #dc3545; /* Màu đỏ cho tiêu đề */
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
    }

    /* Căn chỉnh bảng */
    .table {
        width: 100%;
        background-color: #fff;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #dddddd;
    }

    .table thead {
        background-color: #dc3545; /* Nền đỏ cho phần tiêu đề */
        color: white; /* Chữ màu trắng */
    }

    .table tbody tr:nth-child(odd) {
        background-color: #f8f9fa; /* Màu nền nhạt cho hàng lẻ */
    }

    .table tbody tr:nth-child(even) {
        background-color: #ffffff; /* Màu trắng cho hàng chẵn */
    }

    /* Nút thêm mới */
    .btn-primary {
        background-color: #dc3545; /* Nền đỏ */
        border: none;
        color: white;
        font-weight: bold;
    }

    .btn-primary:hover {
        background-color: #c82333; /* Đỏ đậm hơn khi hover */
    }

    /* Nút sửa */
    .btn-warning {
        background-color: #ffc107; /* Nền vàng */
        color: white;
        border: none;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    /* Nút xóa */
    .btn-danger {
        background-color: #dc3545; /* Nền đỏ */
        border: none;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c82333; /* Đỏ đậm hơn khi hover */
    }
</style>

<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách Gói dịch vụ</h1>

    <!-- Nút thêm gói dịch vụ mới -->
    <a href="{{ route('admin.packages.create') }}" class="btn btn-primary mb-3">Thêm gói dịch vụ mới</a>

    <!-- Bảng danh sách gói dịch vụ -->
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Tên gói</th>
                <th>Giá</th>
                <th>Thời hạn (ngày)</th>
                <th>Giới hạn bài đăng</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($packages as $package)
            <tr>
                <td>{{ $package->id }}</td>
                <td>{{ $package->name }}</td>
                <td>{{ number_format($package->price) }} VND</td>
                <td>{{ $package->duration }}</td>
                <td>{{ $package->post_limit }}</td>
                <td>{{ $package->created_at }}</td>
                <td>
                    <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-warning">Sửa</a>

                    <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa gói dịch vụ này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
