@extends('layouts.admin')

@section('title', 'Quản lý Gói dịch vụ')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách Gói dịch vụ</h1>

    <a href="{{ route('admin.packages.create') }}" class="btn btn-primary mb-3">Thêm gói dịch vụ mới</a>

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
