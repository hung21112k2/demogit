@extends('layouts.admin')

@section('title', 'Thống kê người dùng')

@section('content')
<style>
    .container {
        margin-top: 30px;
        background-color: #ffffff; /* Nền trắng cho container */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    
    }

    h1.text-center {
        font-size: 2rem;
        color: #dc3545; /* Màu đỏ cho tiêu đề */
        margin-bottom: 20px;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 8px;
        overflow: hidden;
    }

    .table thead {
        background-color: #dc3545; /* Nền đỏ cho phần tiêu đề bảng */
        color: white;
    }

    .table th {
        padding: 12px;
        text-align: center;
        font-size: 1rem;
        font-weight: bold;
    }

    .table td {
        padding: 12px;
        text-align: center;
        color: #343a40; /* Màu chữ đen cho phần nội dung */
        background-color: #ffffff; /* Nền trắng cho các ô */
    }

    /* Phong cách cho cột vai trò và số dư tài khoản */
    .table td:nth-child(5), .table td:nth-child(6) {
        font-weight: bold;
        color: #dc3545; /* Màu đỏ nổi bật cho vai trò và số dư */
    }

    /* Responsive bảng */
    @media (max-width: 768px) {
        .table th, .table td {
            font-size: 0.85rem;
            padding: 8px;
        }

        h1.text-center {
            font-size: 1.5rem;
        }
    }
</style>

<div class="container">
    <h1 class="text-center">Thống kê người dùng</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên người dùng</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Vai trò</th>
                <th>Số dư tài khoản</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>{{ number_format($user->balance, 2) }} VND</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
