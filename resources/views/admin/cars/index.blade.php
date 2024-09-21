@extends('layouts.admin')

@section('title', 'Quản lý Sản phẩm')

@section('content')
<style>
    /* Căn chỉnh các nút và bảng trong admin-content */
.container {
    width: 80%;
    margin: 0 auto;
}

.table {
    background-color: #ffffff;
    width: 100%;
    margin-bottom: 1rem;
    border-collapse: collapse;
}

.table thead {
    background-color: #228dff;
    color: white;
}

.table th, .table td {
    padding: 12px;
    text-align: center;
    border: 1px solid #dddddd;
}

.table img {
    max-width: 100px;
    height: auto;
}

.btn-primary, .btn-warning, .btn-danger {
    color: white;
    padding: 8px 12px;
    text-decoration: none;
    border-radius: 5px;
    margin-right: 5px;
}

.btn-primary {
    background-color: #228dff;
}

.btn-warning {
    background-color: #ffc107;
}

.btn-danger {
    background-color: #dc3545;
}

/* Thêm hover cho nút */
.btn-primary:hover {
    background-color: #1a6bcc;
}

.btn-warning:hover {
    background-color: #e0a800;
}

.btn-danger:hover {
    background-color: #c82333;
}
    </style>
<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách Sản phẩm (Xe)</h1>

    <!-- Nút thêm xe mới -->
    <a href="{{ route('cars.create') }}" class="btn btn-primary mb-3">Thêm xe mới</a>

    <table class="table table-bordered">
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
                <td><img src="{{ asset($car->image) }}" alt="{{ $car->make }}" style="max-width: 100px;"></td>
                <td>
                    <!-- Nút sửa xe -->
                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-sm btn-warning">Sửa</a>

                    <!-- Nút xóa xe -->
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
@endsection