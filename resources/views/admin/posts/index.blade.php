@extends('layouts.admin')

@section('title', 'Quản lý Bài đăng')

@section('content')

<style>
/* admin.css */
.container {
    margin-top: 50px;
    max-width: 1200px;
}

h1, h3 {
    text-align: center;
    color: #dc3545;
    font-weight: bold;
}

.table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
    border-spacing: 0;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border-radius: 8px;
}

.table th, .table td {
    padding: 15px;
    text-align: left;
}

.table th {
    background-color: #dc3545;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    border-bottom: 2px solid #bd2130;
}

.table td {
    background-color: #ffffff;
    border-bottom: 1px solid #ddd;
}

.table img {
    max-width: 100px;
    height: auto;
    border-radius: 5px;
}

.table tbody tr:hover {
    background-color: #f9f9f9;
}

.table-bordered {
    border: 1px solid #ddd;
}

.btn {
    padding: 8px 12px;
    font-size: 14px;
    color: white;
    border: none;
    border-radius: 5px;
    margin-right: 5px;
    display: inline-block;
    transition: background-color 0.3s ease;
}

.btn-primary {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-primary:hover {
    background-color: #bd2130;
    border-color: #bd2130;
}

.btn-secondary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-secondary:hover {
    background-color: #0056b3;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    background-color: #bd2130;
    border-color: #bd2130;
}

.form-inline {
    display: inline-block;
}

@media (max-width: 768px) {
    .table {
        display: block;
        overflow-x: auto;
        width: 100%;
    }
    .btn {
        margin-bottom: 5px;
    }
}

</style>

<div class="container">
    <h1 class="mb-4">Danh sách Bài đăng</h1>

    <!-- Bài đăng chờ phê duyệt -->
    <h3 class="mt-4">Bài đăng chờ phê duyệt</h3>
    <table class="table table-bordered">
        <thead>
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
                <td>
                    @if ($post->car)
                        {{ $post->car->make }} {{ $post->car->model }}
                    @elseif ($post->pendingCar)
                        {{ $post->pendingCar->make }} {{ $post->pendingCar->model }}
                    @else
                        Chưa xác định
                    @endif
                </td>
                <td>{{ $post->package->name }}</td>
                <td>{{ $post->status }}</td>
                <td>{{ number_format($post->price) }} VND</td>
                <td><img src="{{ asset($post->image_url) }}" alt="Image"></td>
                <td>{{ $post->start_date }}</td>
                <td>
                    <a href="{{ route('admin.posts.showForApproval', $post->id) }}" class="btn btn-primary">Xét phê duyệt</a>
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-secondary">Sửa</a>
                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="form-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bài đăng này không?')">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

<!-- Bài đăng đã được duyệt -->
<h3 class="mt-4">Danh sách Bài đăng đã được duyệt</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Người dùng</th>
            <th>Xe</th>
            <th>Gói dịch vụ</th>
            <th>Trạng thái</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->user->username }}</td>
            <td>
                @if ($post->car)
                    {{ $post->car->make }} {{ $post->car->model }}
                @elseif ($post->pendingCar)
                    {{ $post->pendingCar->make }} {{ $post->pendingCar->model }}
                @else
                    Chưa xác định
                @endif
            </td>
            <td>{{ $post->package->name }}</td>
            <td>
    {{ $post->status }}
    @if($post->isExpiringSoon)
        <span class="badge badge-warning">Sắp hết hạn</span>
    @endif
    <!-- Hiển thị số ngày còn lại mà không có dấu âm -->
    <small>({{ abs(Carbon\Carbon::parse($post->end_date)->diffInDays(Carbon\Carbon::now()->startOfDay(), false)) }} ngày còn lại)</small>
</td>




            <td>{{ number_format($post->price) }} VND</td>
            <td><img src="{{ asset($post->image_url) }}" alt="Image"></td>
            <td>{{ $post->start_date }}</td>
            <td>{{ $post->end_date }}</td>
            <td>
                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-secondary">Sửa</a>
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="form-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bài đăng này không?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


    <!-- Bài đăng bị từ chối -->
    <h3 class="mt-4">Danh sách Bài đăng bị từ chối</h3>
    <table class="table table-bordered">
        <thead>
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
        @foreach($rejectedPosts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->user->username }}</td>
                <td>
                    @if ($post->car)
                        {{ $post->car->make }} {{ $post->car->model }}
                    @elseif ($post->pendingCar)
                        {{ $post->pendingCar->make }} {{ $post->pendingCar->model }}
                    @else
                        Chưa xác định
                    @endif
                </td>
                <td>{{ $post->package->name }}</td>
                <td>{{ $post->status }}</td>
                <td>{{ number_format($post->price) }} VND</td>
                <td><img src="{{ asset($post->image_url) }}" alt="Image"></td>
                <td>{{ $post->start_date }}</td>
                <td>
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-secondary">Sửa</a>
                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="form-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bài đăng này không?')">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
@endsection 
