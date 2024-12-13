@extends('layouts.admin')

@section('title', 'Phê duyệt Bài đăng')

@section('content')
<style>
/* Căn chỉnh container */
.container {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px 20px 30px; /* Extra bottom padding for spacing */
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

/* Đặt khoảng cách trên và dưới cho các thẻ h1 và h4 */
h1, h4 {
    color: #dc3545; /* Màu đỏ chủ đạo */
    margin-bottom: 20px;
    font-weight: bold;
}

h4 {
    font-size: 1.5rem;
}

/* Thẻ p để hiển thị các thông tin thêm */
p {
    margin: 10px 0;
    font-size: 1rem;
    color: #333;
}

/* Thêm padding và bo viền cho khung card */
.card {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

/* Style cho các nút (button) */
.btn {
    font-size: 1rem;
    padding: 10px 15px;
    border-radius: 5px;
    color: white;
}

/* Nút phê duyệt (màu đỏ) */
.btn-success {
    background-color: #dc3545; /* Nền đỏ */
    border-color: #dc3545;
}

.btn-success:hover {
    background-color: #c82333;
    border-color: #bd2130;
}

/* Nút từ chối (màu đậm hơn) */
.btn-danger {
    background-color: #343a40; /* Nền đen */
    border-color: #343a40;
    margin-bottom: 10px; /* Adds space below the button */
}

.btn-danger:hover {
    background-color: #23272b;
    border-color: #1d2124;
}

/* Căn chỉnh hình ảnh trong bảng và thẻ card */
.card-body img {
    max-width: 150px;
    height: auto;
    border-radius: 5px;
    margin-right: 10px;
}

/* Style cho các tiêu chí phê duyệt */
.form-check-label {
    font-size: 1rem;
    color: #333;
}

.form-check-input {
    margin-right: 10px;
}

/* Style cho phần form */
form {
    margin-top: 20px;
}

/* Tạo khoảng cách giữa các nút */
button {
    margin-right: 10px;
}
</style>

<div class="container mt-5">
    <h1 class="text-center mb-4">Xét duyệt Bài đăng</h1>

    <div class="card mb-4">
        <div class="card-body">
        <h4>
    @if ($post->car)
        {{ $post->car->make }} {{ $post->car->model }} - {{ $post->year }}
    @elseif ($post->pendingCar)
        {{ $post->pendingCar->make }} {{ $post->pendingCar->model }} - {{ $post->year }}
    @else
        Chưa xác định
    @endif
</h4>

            <p><strong>Người đăng:</strong> {{ $post->user->username }}</p>
            <p><strong>Gói dịch vụ:</strong> {{ $post->package->name }}</p>
            <p><strong>Mô tả:</strong> {{ $post->description }}</p>
            <p><strong>Giá:</strong> {{ number_format($post->price) }} VND</p>
            <p><strong>Số km đã đi:</strong> {{ $post->mileage }} km</p>

            <h5>Hình ảnh:</h5>
            <div class="d-flex">
                @foreach($post->photos as $photo)
                    <img src="{{ asset($photo->image_url) }}" alt="Image" style="max-width: 150px; margin-right: 10px;">
                @endforeach
            </div>
        </div>
    </div>

    <!-- Form phê duyệt -->
    <form action="{{ route('admin.posts.approve', $post->id) }}" method="POST">
        @csrf
        <h4>Tiêu chí phê duyệt</h4>

        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="criteria_image" id="criteria_image" value="1">
                <label class="form-check-label" for="criteria_image">
                    Ảnh có phù hợp với nội dung bài đăng
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="criteria_price" id="criteria_price" value="1">
                <label class="form-check-label" for="criteria_price">
                    Giá có hợp lý
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="criteria_description" id="criteria_description" value="1">
                <label class="form-check-label" for="criteria_description">
                    Mô tả rõ ràng, đúng sự thật
                </label>
            </div>
        </div>

        <!-- Nút phê duyệt -->
        <button type="submit" class="btn btn-success">Phê duyệt</button>
    </form>

    <!-- Form từ chối -->
    <form id="reject-form" action="{{ route('admin.posts.reject', $post->id) }}" method="POST">
        @csrf
        <input type="hidden" name="criteria_image" id="reject_criteria_image" value="0">
        <input type="hidden" name="criteria_price" id="reject_criteria_price" value="0">
        <input type="hidden" name="criteria_description" id="reject_criteria_description" value="0">
        <!-- Nút từ chối -->
        <button type="button" class="btn btn-danger" onclick="submitRejectForm()">Từ chối</button>
    </form>
</div>

<script>
function submitRejectForm() {
    // Lấy giá trị của các checkbox trong form
    document.getElementById('reject_criteria_image').value = document.getElementById('criteria_image').checked ? '1' : '0';
    document.getElementById('reject_criteria_price').value = document.getElementById('criteria_price').checked ? '1' : '0';
    document.getElementById('reject_criteria_description').value = document.getElementById('criteria_description').checked ? '1' : '0';

    // Submit form từ chối
    document.getElementById('reject-form').submit();
}
</script>
@endsection
