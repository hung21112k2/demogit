@extends('layouts.admin')

@section('title', 'Quản lý Bài đăng')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách Bài đăng</h1>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>ID Người dùng</th>
                <th>ID Xe</th>
                <th>Gói dịch vụ</th>
                <th>Trạng thái</th>
                <th>Giá</th>
                <th>Mô tả</th>
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
                <td>{{ $post->description }}</td>
                <td><img src="{{ asset($post->image_url) }}" alt="Image" style="max-width: 100px;"></td>
                <td>{{ $post->start_date }}</td>
                <td>{{ $post->end_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
