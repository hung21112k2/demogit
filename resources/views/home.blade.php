@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
<style>
    /* Container của các bài đăng */
    .post-container {
        background-color: white;
        border: none; /* Xóa bỏ khung viền */
        margin-bottom: 10px; /* Giảm khoảng cách giữa các bài đăng */
        display: flex;
        padding: 15px;
        transition: box-shadow 0.3s;
    }

    .post-container:hover {
        box-shadow: none; /* Xóa bỏ hiệu ứng khi hover */
    }

    /* Hình ảnh bài đăng */
    .post-image {
        width: 40%;
        height: auto;
        object-fit: cover;
    }

    /* Nội dung bài đăng */
    .post-content {
        width: 60%;
        padding-left: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .post-title {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .post-price {
        font-size: 16px;
        color: #f44336;
        font-weight: bold;
    }

    .post-info {
        font-size: 14px;
        color: #777;
        margin-bottom: 10px;
    }

    .post-description {
        font-size: 13px;
        color: #555;
        margin-bottom: 15px;
    }

    .post-actions {
        display: flex;
        justify-content: flex-end;
    }

    .post-button {
        background-color: #4CAF50;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
    }

    .post-button:hover {
        background-color: #45a049;
    }

    /* Nút xem thêm */
    .see-more-button {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .see-more-button a {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
    }

    .see-more-button a:hover {
        background-color: #0056b3;
    }

</style>

<div class="container mt-5">
    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-12 mb-4">
                <div class="post-container">
                    <img src="{{ $post->image_url }}" class="post-image" alt="Car Image">
                    <div class="post-content">
                        <div>
                            <h5 class="post-title">Car ID: {{ $post->car_id }}</h5>
                            <p class="post-price">{{ number_format($post->price, 2) }} VND</p>
                            <p class="post-info">Mileage: {{ $post->mileage }} km | Year: {{ $post->year }}</p>
                            <p class="post-description">{{ Str::limit($post->description, 100) }}</p>
                        </div>
                        <div class="post-actions">
                            <a href="{{ route('posts.show', $post->id) }}" class="post-button">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Nút xem thêm -->
    <div class="see-more-button">
        <a href="{{ route('posts.index') }}">Xem thêm</a>
    </div>
</div>

@endsection
