@extends('layouts.admin')

@section('title', 'Chỉnh sửa xe')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Chỉnh sửa Xe</h1>

    <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="make">Hãng xe:</label>
            <input type="text" name="make" class="form-control" value="{{ $car->make }}" required>
        </div>
        <div class="form-group">
            <label for="model">Model:</label>
            <input type="text" name="model" class="form-control" value="{{ $car->model }}" required>
        </div>
        <div class="form-group">
            <label for="image">Ảnh xe:</label>
            <input type="file" name="image" class="form-control">
            <img src="{{ asset($car->image) }}" alt="{{ $car->make }}" style="max-width: 100px;">
        </div>
        <button type="submit" class="btn btn-success">Cập nhật xe</button>
    </form>
</div>
@endsection
