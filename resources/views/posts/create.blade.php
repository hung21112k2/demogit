@extends('layouts.app')

@section('title', 'Đăng tin')

@section('content')
<div class="container">
    <h1>Đăng tin bán xe</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Thêm phần chọn Xe từ bảng cars -->
        <div class="form-group">
            <label for="car_id">Chọn xe</label>
            <select name="car_id" class="form-control" required>
                @foreach ($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->make }} {{ $car->model }}</option>
                @endforeach
            </select>
        </div>

        <!-- Thêm trường chọn Gói -->
        <div class="form-group">
            <label for="package_id">Chọn gói</label>
            <select name="package_id" class="form-control" required>
                @foreach ($packages as $package)
                    <option value="{{ $package->id }}">{{ $package->name }} - Giá: {{ number_format($package->price) }} VND, Số bài đăng: {{ $package->post_limit }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="price">Giá xe</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <!-- Cho phép người dùng tải lên ảnh -->
        <div class="form-group">
            <label for="image">Tải ảnh lên</label>
            <input type="file" name="image" class="form-control" required onchange="previewImage(event)">
        </div>

        <!-- Nơi hiển thị hình ảnh preview -->
        <div class="form-group">
            <img id="preview" src="#" alt="Hình ảnh" style="display: none; max-width: 200px; margin-top: 10px;">
        </div>

        <div class="form-group">
            <label for="mileage">Số km đã đi</label>
            <input type="number" name="mileage" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="year">Năm sản xuất</label>
            <input type="number" name="year" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Đăng tin</button>
    </form>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
