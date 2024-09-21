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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Chọn Xe từ bảng cars -->
        <div class="form-group">
            <label for="car_id">Chọn xe</label>
            <select name="car_id" class="form-control" required>
                @foreach ($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->make }} {{ $car->model }}</option>
                @endforeach
            </select>
        </div>

        <!-- Chọn Gói -->
        <div class="form-group">
            <label for="package_id">Chọn gói</label>
            <select name="package_id" class="form-control" required>
                @foreach ($packages as $package)
                    <option value="{{ $package->id }}">{{ $package->name }} - Giá: {{ number_format($package->price) }} VND</option>
                @endforeach
            </select>
        </div>

        <!-- Giá xe -->
        <div class="form-group">
            <label for="price">Giá xe</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <!-- Mô tả -->
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <!-- Tải ảnh lên -->
        <div class="form-group">
            <label for="image">Tải ảnh lên</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <!-- Số km đã đi -->
        <div class="form-group">
            <label for="mileage">Số km đã đi</label>
            <input type="number" name="mileage" class="form-control" required>
        </div>

        <!-- Năm sản xuất -->
        <div class="form-group">
            <label for="year">Năm sản xuất</label>
            <input type="number" name="year" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Đăng tin và Thanh toán</button>
    </form>
</div>

@endsection
