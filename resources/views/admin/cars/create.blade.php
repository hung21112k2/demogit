@extends('layouts.admin')

@section('title', 'Thêm xe mới')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Thêm Xe Mới</h1>

    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="make">Hãng xe:</label>
            <input type="text" name="make" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="model">Model:</label>
            <input type="text" name="model" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="image">Ảnh xe:</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Thêm xe</button>
    </form>
</div>
@endsection
