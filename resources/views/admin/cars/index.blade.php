@extends('layouts.admin')

@section('title', 'Quản lý Xe')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách Xe</h1>

    <!-- Nút thêm xe mới (chỉ admin mới thấy) -->
    <a href="{{ route('cars.create') }}" class="btn btn-primary mb-3">Thêm xe mới</a>

    <table class="table table-bordered table-hover table-striped shadow-sm">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Hãng xe</th>
                <th>Model</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
            <tr>
                <td>{{ $car->id }}</td>
                <td>{{ $car->make }}</td>
                <td>{{ $car->model }}</td>
                <td>
                    <!-- Hiển thị ảnh của xe từ public/images -->
                    <img src="{{ asset($car->image_url) }}" alt="{{ $car->make }}" class="img-fluid img-thumbnail" width="150">
                </td>
                <td>
                    <!-- Nút sửa và xóa xe -->
                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa xe này?');">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- CSS tùy chỉnh -->
<style>
    .container {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .table th, .table td {
        vertical-align: middle;
        text-align: center;
    }
    .table img {
        transition: transform 0.2s ease;
    }
    .table img:hover {
        transform: scale(1.1);
    }
    .btn {
        border-radius: 20px;
    }
</style>
@endsection
