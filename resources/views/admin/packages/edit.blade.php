@extends('layouts.admin')

@section('title', 'Chỉnh sửa gói dịch vụ')

@section('content')
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
