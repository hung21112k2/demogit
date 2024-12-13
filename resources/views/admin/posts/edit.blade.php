@extends('layouts.admin')

@section('title', 'Chỉnh sửa Bài đăng')

@section('content')
<style>
    .container {
        margin-top: 50px;
        padding: 40px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        max-width: 700px;
    }

    h1 {
        text-align: center;
        color: #343a40;
        font-weight: bold;
        margin-bottom: 30px;
    }

    label {
        font-weight: bold;
        color: #495057;
        font-size: 1rem;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-control {
        height: 45px;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ced4da;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }

    textarea.form-control {
        height: auto;
        min-height: 120px;
        resize: vertical;
    }

    .img-fluid {
        display: block;
        margin-top: 15px;
        border-radius: 10px;
        max-width: 100%;
        height: auto;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .img-container {
        text-align: center;
    }

    button.btn-primary {
        background-color: #007bff;
        border: none;
        padding: 12px 20px;
        font-size: 18px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        width: 100%;
        font-weight: bold;
    }

    button.btn-primary:hover {
        background-color: #0056b3;
    }

    .alert-danger {
        margin-top: 15px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(220, 53, 69, 0.2);
    }

</style>

<div class="container">
    <h1>Chỉnh sửa Bài đăng</h1>

    <!-- Hiển thị lỗi -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

<!-- Hãng xe -->
<div class="form-group">
    <label for="make">Hãng xe</label>
    <input type="text" class="form-control" id="make" name="make" 
           value="{{ optional($post->car)->make ?? 'Chưa xác định' }}" readonly>
</div>

<!-- Trạng thái -->
<div class="form-group">
    <label for="status">Trạng thái</label>
    <select class="form-control" id="status" name="status" required>
    <option value="pending" {{ $post->status == 'pending' ? 'selected' : '' }}>Chờ phê duyệt</option>
    <option value="active" {{ $post->status == 'active' ? 'selected' : '' }}>Đã phê duyệt</option>
    <option value="rejected" {{ $post->status == 'rejected' ? 'selected' : '' }}>Bị từ chối</option>
    <option value="expired" {{ $post->status == 'expired' ? 'selected' : '' }}>Đã hết hạn</option>
</select>

</div>

<!-- Model xe -->
<div class="form-group">
    <label for="model">Model xe</label>
    <input type="text" class="form-control" id="model" name="model" 
           value="{{ optional($post->car)->model ?? 'Chưa xác định' }}" readonly>
</div>


        <!-- Giá -->
        <div class="form-group">
            <label for="price">Giá</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ number_format($post->price, 0, ',', '.') }}" required>
        </div>

        <!-- Mô tả -->
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $post->description }}</textarea>
        </div>

        <!-- Ảnh xe -->
        <div class="form-group img-container">
            <label for="image_url">Ảnh</label>
            <img src="{{ asset($post->image_url) }}" alt="Image" class="img-fluid">
        </div>

        <!-- Số km đã đi -->
        <div class="form-group">
            <label for="mileage">Số km đã đi</label>
            <input type="text" class="form-control" id="mileage" name="mileage" value="{{ number_format($post->mileage, 0, ',', '.') }}" required>
        </div>

        <!-- Năm sản xuất -->
        <div class="form-group">
            <label for="year">Năm sản xuất</label>
            <input type="number" class="form-control" id="year" name="year" value="{{ $post->year }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var priceInput = document.getElementById('price');
        var mileageInput = document.getElementById('mileage');
        var form = document.querySelector('form');

        function formatNumber(input) {
            input.value = input.value.replace(/\D/g, ""); 
            input.value = input.value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function removeDots(input) {
            return input.value.replace(/\./g, ''); 
        }

        priceInput.addEventListener('input', function () {
            formatNumber(priceInput);
        });

        mileageInput.addEventListener('input', function () {
            formatNumber(mileageInput);
        });

        form.addEventListener('submit', function (event) {
            priceInput.value = removeDots(priceInput);
            mileageInput.value = removeDots(mileageInput);
        });
    });
</script>
@endsection
