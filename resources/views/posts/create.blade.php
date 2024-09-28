@extends('layouts.loginapp')

@section('title', 'Đăng tin')

@section('content')

<style>
    /* Form container */
    .container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin: 20px auto;
        max-width: 800px;
    }

    h1 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
    }

    label {
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    input[type="text"],
    input[type="number"],
    select,
    textarea {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: none;
        transition: all 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    select:focus,
    textarea:focus {
        border-color: #007bff;
        box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.2);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .input-group-text {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 0px 5px 5px 0px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Custom styling for package-info section */
    #package-info {
        background-color: #f8f9fa;
        padding: 10px;
        border-left: 4px solid #007bff;
        margin-top: 10px;
        font-size: 14px;
    }

    /* Styling for alerts */
    .alert {
        border-radius: 5px;
        font-size: 14px;
        padding: 10px;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

    .alert-warning {
        background-color: #fff3cd;
        border-color: #ffeeba;
        color: #856404;
    }

    /* File input customization */
    input[type="file"] {
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f8f9fa;
    }

    .input-group {
        display: flex;
        align-items: center;
    }

    .input-group-append {
        display: flex;
    }

    /* Adjust button to be aligned right */
    .btn {
        display: block;
        margin-top: 15px;
        margin-left: auto;
    }

    /* Image preview styling */
    .image-preview {
        display: flex;
        gap: 10px;
        margin-top: 10px;
        flex-wrap: wrap;
    }

    .image-preview img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        h1 {
            font-size: 20px;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            font-size: 13px;
        }

        .btn-primary {
            padding: 8px 16px;
            font-size: 14px;
        }
    }
</style>

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

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($packages->isEmpty())
        <div class="alert alert-warning">
            Bạn không có gói nào hoặc các gói đã hết lượt đăng bài. Vui lòng <a href="{{ route('packages.purchase') }}">mua gói</a> để tiếp tục.
        </div>
    @else
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" id="post-form">
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

            <!-- Chọn Gói từ package_user -->
            <div class="form-group">
                <label for="package_id">Chọn gói</label>
                <select name="package_id" id="package_id" class="form-control" required>
                    <option value="">Chọn gói...</option>
                    @foreach ($packages as $package)
                        <option value="{{ $package->id }}" 
                            data-duration="{{ $package->duration }}" 
                            data-post-limit="{{ $package->remaining_posts }}">
                            {{ $package->name }} - Số bài đăng còn lại: {{ $package->remaining_posts }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Hiển thị thông tin gói -->
            <div id="package-info" style="display: none;">
                <p>Bạn còn <span id="post-limit"></span> bài đăng cho gói này.</p>
                <p>Bài đăng sẽ tồn tại trong <span id="package-duration"></span> ngày.</p>
            </div>

            <!-- Giá xe -->
            <div class="form-group">
                <label for="price">Giá xe</label>
                <div class="input-group">
                    <input type="text" id="price" name="price" class="form-control" required>
                    <div class="input-group-append">
                        <span class="input-group-text">VNĐ</span>
                    </div>
                </div>
            </div>

            <!-- Mô tả -->
            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <!-- Khu vực tải ảnh lên -->
            <div id="image-container" class="form-group">
                <!-- Tạo trường tải ảnh mới bằng JavaScript -->
            </div>

            <!-- Preview các ảnh đã chọn -->
            <div class="image-preview" id="image-preview"></div>

            <!-- Số km đã đi -->
            <div class="form-group">
                <label for="mileage">Số km đã đi</label>
                <input type="text" id="mileage" name="mileage" class="form-control" required>
            </div>

            <label for="year">Năm sản xuất</label>
                <input type="number" name="year" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Đăng tin</button>
        </form>
    @endif
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    var imagePreview = document.getElementById('image-preview');
    var imageContainer = document.getElementById('image-container');
    var imageInputTemplate = document.createElement('div'); // Tạo template cho trường nhập ảnh
    imageInputTemplate.classList.add('form-group');
    imageInputTemplate.innerHTML = `
        <label for="images">Tải ảnh lên</label>
        <input type="file" name="images[]" class="form-control" multiple>
    `;

    var allSelectedFiles = []; // Biến lưu trữ tất cả các ảnh đã chọn

    function createImageInput() {
        var newImageInput = imageInputTemplate.cloneNode(true);
        newImageInput.querySelector('input').addEventListener('change', function(event) {
            handleImageChange(event, newImageInput);
        });
        imageContainer.appendChild(newImageInput); // Thêm trường nhập ảnh mới
    }

    function handleImageChange(event, imageInput) {
        var files = event.target.files;

        // Nếu không có file nào được chọn, không làm gì
        if (files.length === 0) {
            return;
        }

        // Thêm các ảnh đã chọn vào danh sách allSelectedFiles
        for (var i = 0; i < files.length; i++) {
            allSelectedFiles.push(files[i]);
        }

        // Hiển thị các file vừa chọn ngay lập tức
        updateImagePreview();

        // Sau khi chọn ảnh đầu tiên, tạo trường nhập ảnh mới nếu cần
        if (imageInput === imageContainer.lastChild) {
            createImageInput(); // Tạo trường tải ảnh mới sau khi đã chọn ảnh
        }
    }

    function updateImagePreview() {
        imagePreview.innerHTML = ''; // Xóa toàn bộ preview cũ

        // Hiển thị toàn bộ các ảnh trong danh sách allSelectedFiles
        allSelectedFiles.forEach(function(file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                imagePreview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    }

    // Khởi tạo chỉ một trường nhập ảnh đầu tiên khi trang được tải
    createImageInput();
});
</script>

@endsection

