@extends('layouts.admin')

@section('title', 'Chỉnh sửa Xe')

@section('content')
<style>
    .container {
        margin-top: 30px;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 600px;
    }

    h1.text-center {
        font-size: 2rem;
        color: #dc3545;
        margin-bottom: 30px;
    }

    .form-group label {
        font-size: 1.1rem;
        color: #343a40;
        font-weight: bold;
    }

    .form-control {
        padding: 12px;
        font-size: 1rem;
        border-radius: 5px;
        border: 1px solid #dddddd;
        margin-bottom: 20px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #dc3545;
        box-shadow: 0 0 5px rgba(220, 53, 69, 0.5);
    }

    .btn-success {
        background-color: #dc3545;
        border-color: #dc3545;
        padding: 12px 20px;
        font-size: 1.2rem;
        border-radius: 5px;
        color: #ffffff;
        font-weight: bold;
        width: 100%;
        transition: background-color 0.3s ease;
        margin-top: 10px;
    }

    .btn-success:hover {
        background-color: #c82333;
    }

    .form-group img {
        margin-top: 10px;
        max-width: 150px;
        border-radius: 5px;
        border: 1px solid #dddddd;
        display: block;
    }

    .form-group p {
        font-size: 0.9rem;
        color: #6c757d;
        margin-top: 10px;
    }

    #new-image {
        margin-top: 10px;
        max-width: 150px;
        border-radius: 5px;
        border: 1px solid #dddddd;
    }
</style>

<div class="container">
    <h1 class="text-center">Chỉnh sửa Xe</h1>

    <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Hãng xe -->
        <div class="form-group">
            <label for="make">Hãng xe:</label>
            <input type="text" name="make" class="form-control" value="{{ old('make', $car->make) }}" required>
        </div>

        <!-- Model -->
        <div class="form-group">
            <label for="model">Model:</label>
            <input type="text" name="model" class="form-control" value="{{ old('model', $car->model) }}" required>
        </div>

        <!-- Ảnh xe -->
        <div class="form-group">
            <label for="image">Ảnh xe (Nếu muốn thay đổi):</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">

            <!-- Hiển thị ảnh cũ -->
            @if($car->image_url && file_exists(public_path($car->image_url)))
                <p>Ảnh hiện tại:</p>
                <img id="current-image" src="{{ asset($car->image_url) }}" alt="Ảnh xe {{ $car->make }}">
            @else
                <p>Không tìm thấy ảnh hiện tại.</p>
            @endif

            <!-- Hiển thị ảnh mới -->
            <img id="new-image" style="display:none;" alt="Ảnh mới">
        </div>

        <!-- Nút cập nhật -->
        <button type="submit" class="btn btn-success">Cập nhật xe</button>
    </form>
</div>

<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            // Hiển thị ảnh mới
            const newImage = document.getElementById('new-image');
            newImage.src = URL.createObjectURL(file);
            newImage.style.display = 'block';

            // Ẩn ảnh cũ
            const currentImage = document.getElementById('current-image');
            if (currentImage) {
                currentImage.style.display = 'none';
            }
        }
    });
</script>
@endsection
