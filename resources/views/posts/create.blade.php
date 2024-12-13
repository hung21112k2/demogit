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

    .image-preview-item {
        position: relative;
    }

    .image-preview img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .delete-image {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: #ff0000;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        cursor: pointer;
        font-size: 14px;
        line-height: 16px;
        text-align: center;
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

            <!-- Chọn hãng xe -->
            <div class="form-group">
                <label for="make">Chọn hãng xe</label>
                <select name="make" id="make" class="form-control" required>
                    <option value="">Chọn hãng xe...</option>
                    @foreach ($makes as $make)
                        <option value="{{ $make }}">{{ $make }}</option>
                    @endforeach
                    <option value="other">Khác</option>
                </select>
            </div>

            <!-- Nhập hãng xe khác -->
            <div id="other-make-field" style="display: none;">
                <div class="form-group">
                    <label for="other_make">Hãng xe khác:</label>
                    <input type="text" name="other_make" id="other_make" class="form-control">
                </div>
            </div>

            <!-- Chọn model xe -->
            <div class="form-group">
                <label for="model">Chọn model xe</label>
                <select name="model" id="model" class="form-control" required>
                    <option value="">Chọn model...</option>
                    <option value="other">Khác</option>
                    <!-- Options for model will be dynamically populated based on selected make -->
                </select>
            </div>

            <!-- Nhập model xe khác -->
            <div id="other-model-field" style="display: none;">
                <div class="form-group">
                    <label for="other_model">Model xe khác:</label>
                    <input type="text" name="other_model" id="other_model" class="form-control">
                </div>
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

            <!-- Năm sản xuất -->
            <div class="form-group">
                <label for="year">Năm sản xuất</label>
                <input type="number" name="year" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Đăng tin</button>
        </form>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var makeSelect = document.getElementById('make');
    var otherMakeField = document.getElementById('other-make-field');
    var modelSelect = document.getElementById('model');
    var otherModelField = document.getElementById('other-model-field');
    var imagePreview = document.getElementById('image-preview');
    var imageContainer = document.getElementById('image-container');
    var imageInputTemplate = document.createElement('div'); // Tạo template cho trường nhập ảnh
    imageInputTemplate.classList.add('form-group');
    imageInputTemplate.innerHTML = `
        <label for="images">Tải ảnh lên</label>
        <input type="file" name="images[]" class="form-control" multiple>
    `;

    var allSelectedFiles = []; // Biến lưu trữ tất cả các ảnh đã chọn

    // Dữ liệu mẫu cho các hãng xe và model
    var carData = @json($cars);

    makeSelect.addEventListener('change', function () {
        if (makeSelect.value === 'other') {
            otherMakeField.style.display = 'block';
            document.getElementById('other_make').required = true;
            modelSelect.innerHTML = '<option value="other">Khác</option>';
            modelSelect.value = 'other';
            otherModelField.style.display = 'block';
            document.getElementById('other_model').required = true;
        } else {
            otherMakeField.style.display = 'none';
            document.getElementById('other_make').required = false;
            updateModelOptions();
        }
    });

    modelSelect.addEventListener('change', function () {
        if (modelSelect.value === 'other') {
            otherModelField.style.display = 'block';
            document.getElementById('other_model').required = true;
        } else {
            otherModelField.style.display = 'none';
            document.getElementById('other_model').required = false;
        }
    });

    function updateModelOptions() {
        var selectedMake = makeSelect.value;
        modelSelect.innerHTML = '<option value="">Chọn model...</option>'; // Reset model options

        if (selectedMake !== 'other') {
            var filteredModels = carData.filter(function(car) {
                return car.make === selectedMake;
            });

            filteredModels.forEach(function(car) {
                var option = document.createElement('option');
                option.value = car.model;
                option.textContent = car.model;
                modelSelect.appendChild(option);
            });

            var otherOption = document.createElement('option');
            otherOption.value = 'other';
            otherOption.textContent = 'Khác';
            modelSelect.appendChild(otherOption);
        }
    }

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
    }

    function updateImagePreview() {
        imagePreview.innerHTML = ''; // Xóa toàn bộ preview cũ

        // Hiển thị toàn bộ các ảnh trong danh sách allSelectedFiles
        allSelectedFiles.forEach(function(file, index) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var previewItem = document.createElement('div');
                previewItem.classList.add('image-preview-item');

                var img = document.createElement('img');
                img.src = e.target.result;
                previewItem.appendChild(img);

                var deleteButton = document.createElement('button');
                deleteButton.classList.add('delete-image');
                deleteButton.textContent = 'X';
                deleteButton.addEventListener('click', function() {
                    allSelectedFiles.splice(index, 1);
                    updateImagePreview();
                });
                previewItem.appendChild(deleteButton);

                imagePreview.appendChild(previewItem);
            };
            reader.readAsDataURL(file);
        });

        // Cập nhật lại các trường input[type="file"] với danh sách tệp hiện tại
        updateFileInputs();
    }

    function updateFileInputs() {
        // Xóa tất cả các trường nhập file hiện có
        imageContainer.innerHTML = '';

        // Tạo lại trường nhập file và đặt các tệp đã chọn vào
        allSelectedFiles.forEach(function(file) {
            var newImageInput = imageInputTemplate.cloneNode(true);
            var input = newImageInput.querySelector('input');

            // Tạo một đối tượng DataTransfer để thêm tệp vào trường nhập file
            var dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            input.files = dataTransfer.files;

            imageContainer.appendChild(newImageInput);
        });

        // Thêm trường nhập file trống để có thể chọn thêm ảnh mới
        createImageInput();
    }

    // Khởi tạo chỉ một trường nhập ảnh đầu tiên khi trang được tải
    createImageInput();

    // Định dạng số thành dạng có dấu chấm sau mỗi 3 chữ số
    var priceInput = document.getElementById('price');
    var mileageInput = document.getElementById('mileage');

    function formatNumberInput(input) {
        input.addEventListener('input', function () {
            // Lấy giá trị của input và loại bỏ tất cả các dấu chấm cũ
            var value = input.value.replace(/\./g, '');

            // Định dạng lại giá trị với dấu chấm sau mỗi 3 chữ số
            var formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Gán lại giá trị cho input
            input.value = formattedValue;
        });
    }

    // Áp dụng định dạng cho các trường nhập
    formatNumberInput(priceInput);
    formatNumberInput(mileageInput);
});

</script>

@endsection