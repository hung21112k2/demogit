@extends('layouts.admin')

@section('title', 'Tạo gói dịch vụ mới')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Tạo gói dịch vụ mới</h1>

    <form action="{{ route('admin.packages.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên gói:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="price">Giá:</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>

        <div class="form-group">
            <label for="duration">Thời hạn (ngày):</label>
            <input type="number" class="form-control" id="duration" name="duration" required>
        </div>

        <div class="form-group">
            <label for="post_limit">Giới hạn bài đăng:</label>
            <input type="number" class="form-control" id="post_limit" name="post_limit" required>
        </div>

        <button type="submit" class="btn btn-success">Tạo gói dịch vụ</button>
    </form>
</div>
@endsection
