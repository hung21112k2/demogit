@extends('layouts.admin')

@section('title', 'Quản lý Bài đăng')

@section('content')

<style>
/* admin.css */
.container {
    margin-top: 50px;
}

h1, h3 {
    text-align: center;
    color: #333;
    font-weight: bold;
}

.table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
    border-spacing: 0;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}

.table th, .table td {
    padding: 15px;
    text-align: left;
}

.table th {
    background-color: #343a40;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
}

.table td {
    background-color: #f9f9f9;
    border-bottom: 1px solid #ddd;
}

.table img {
    max-width: 100px;
    height: auto;
    border-radius: 5px;
}

.table tbody tr:hover {
    background-color: #f1f1f1;
}

.table-bordered {
    border: 1px solid #ddd;
}

.btn {
    padding: 8px 12px;
    font-size: 14px;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

</style>
<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách Bài đăng</h1>

    <!-- Thêm phần hiển thị bài đăng chờ phê duyệt -->
    <h3 class="mt-4">Bài đăng chờ phê duyệt</h3>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Người dùng</th>
                <th>Xe</th>
                <th>Gói dịch vụ</th>
                <th>Trạng thái</th>
                <th>Giá</th>
                <th>Ảnh</th>
                <th>Ngày bắt đầu</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
        @foreach($pendingPosts as $post)
    <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post->user->username }}</td>
        <td>{{ $post->car->make }} {{ $post->car->model }}</td>
        <td>{{ $post->package->name }}</td>
        <td>{{ $post->status }}</td>
        <td>{{ number_format($post->price) }} VND</td>
        <td><img src="{{ asset($post->image_url) }}" alt="Image" style="max-width: 100px;"></td>
        <td>{{ $post->start_date }}</td>
        
        <td>
            <a href="{{ route('admin.posts.showForApproval', $post->id) }}" class="btn btn-primary">Xét phê duyệt</a>
        </td>
    </tr>
@endforeach

        </tbody>
    </table>

    <!-- Danh sách các bài đăng đã được duyệt -->
    <h3 class="mt-4">Danh sách Bài đăng đã được duyệt</h3>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>ID Người dùng</th>
                <th>ID Xe</th>
                <th>Gói dịch vụ</th>
                <th>Trạng thái</th>
                <th>Giá</th>
                <th>Ảnh</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->user_id }}</td>
                <td>{{ $post->car_id }}</td>
                <td>{{ $post->package_id }}</td>
                <td>{{ $post->status }}</td>
                <td>{{ number_format($post->price) }} VND</td>
                <td><img src="{{ asset($post->image_url) }}" alt="Image" style="max-width: 100px;"></td>
                <td>{{ $post->start_date }}</td>
                <td>{{ $post->end_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
