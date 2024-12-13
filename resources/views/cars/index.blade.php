@extends('layouts.loginapp')

@section('title', 'Các mẫu xe')

@section('content')
<style>
.container {
    margin-top: 50px;
    padding: 0 20px;
}

h1 {
    text-align: center;
    margin-bottom: 40px;
    font-size: 3em;
    color: #333;
    font-family: 'Poppins', sans-serif; /* Font chữ đẹp hơn */
}

/* CSS cho danh sách xe */
.car-listing {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.car-card {
    display: flex;
    border: 1px solid #e0e0e0;
    padding: 15px;
    background-color: white;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    align-items: center; /* Căn giữa hình ảnh và text theo chiều dọc */
}

.car-card img {
    width: 200px; /* Phóng to hình ảnh */
    height: auto;
    object-fit: cover;
    margin-right: 20px; /* Tạo khoảng cách giữa hình ảnh và nội dung */
}

.car-card-info {
    flex-grow: 1;
    text-align: left; /* Căn nội dung bên trái */
    display: flex;
    flex-direction: column;
    justify-content: center; /* Căn giữa theo chiều dọc */
}

.car-card-info h5 {
    font-size: 1.8em;
    margin-bottom: 10px;
    color: #f44336; /* Chữ màu đỏ */
    font-weight: bold;
    font-family: 'Poppins', sans-serif; /* Font chữ đẹp hơn */
}

/* Tăng cường màu sắc khi hover vào card */
.car-card:hover {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

.car-card a {
    text-decoration: none;
    color: inherit;
}

.car-card a:hover h5 {
    color: #d32f2f; /* Màu đậm hơn khi hover */
}
</style>

<div class="container mt-5">
    <h1 class="text-center mb-4">Các mẫu xe </h1>

    @if($cars->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            Chưa có xe cũ nào.
        </div>
    @else
        <div class="car-listing">
            @foreach($cars as $car)
                <div class="car-card">
                    <!-- Sử dụng image_url để hiển thị ảnh -->
                    <img src="{{ asset($car->image_url) }}" alt="{{ $car->make }} {{ $car->model }}">
                    <div class="car-card-info">
                        <a href="{{ route('posts.byCar', ['make' => $car->make, 'model' => $car->model]) }}">
                            <h5>{{ $car->make }} - {{ $car->model }}</h5>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
