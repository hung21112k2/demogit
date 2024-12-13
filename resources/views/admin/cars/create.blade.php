@extends('layouts.admin')

@section('title', 'Thêm mẫu xe mới')

@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">Thêm mẫu xe mới</h1>

    <!-- Hiển thị lỗi nếu có -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form thêm xe mới -->
    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="make">Hãng xe:</label>
            <input type="text" name="make" class="form-control" placeholder="Nhập hãng xe" required>
        </div>

        <div class="form-group">
            <label for="model">Model:</label>
            <input type="text" name="model" class="form-control" placeholder="Nhập model" required>
        </div>

        <div class="form-group">
            <label for="image_url">Ảnh xe:</label>
            <input type="file" name="image_url" class="form-control-file" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Thêm xe</button>
    </form>
</div>

<!-- CSS tùy chỉnh -->
<style>
    .container {
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 600px;
    }
    h1 {
        color: #333;
    }
    .form-group label {
        font-weight: bold;
    }
    .form-control, .form-control-file {
        border-radius: 8px;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .alert-danger {
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(255, 0, 0, 0.2);
    }
</style>
@endsection
