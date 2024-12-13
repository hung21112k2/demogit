@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
<style>
    /* Container chiếm toàn bộ chiều rộng */
    .container-fluid {
        width: 100%;
        padding: 0 50px;
    }

    /* Container của các bài đăng */
    .post-container {
        background-color: white;
        border: none;
        margin-bottom: 10px;
        display: flex;
        padding: 15px;
        transition: box-shadow 0.3s;
    }

    .post-container:hover {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Hình ảnh bài đăng */
    .post-image {
        width: 40%;
        height: auto;
        object-fit: cover;
        border-radius: 5px;
    }

    .post-content {
        width: 60%;
        padding-left: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        font-family: Arial, sans-serif; /* Match the font family */
    }

    /* Title of the post */
    .post-title {
        font-size: 24px; /* Larger font size */
        font-weight: bold;
        color: #222; /* Dark color similar to the image */
        margin-bottom: 8px;
    }

    /* Price of the post */
    .post-price {
        font-size: 22px; /* Slightly larger font */
        color: #d11f2e; /* Match red color for price */
        font-weight: bold;
        margin-bottom: 10px;
    }

    /* Additional info such as mileage and year */
    .post-info {
        font-size: 16px; /* Adjust size for info text */
        color: #555; /* Gray color similar to the image */
        margin-bottom: 10px;
    }

    /* Description of the post */
    .post-description {
        font-size: 16px; /* Increase font size */
        color: #444; /* Darker gray for better contrast */
        margin-bottom: 15px;
        line-height: 1.6; /* Better line spacing */
    }

    /* Buttons and interactions */
    .post-actions {
        display: flex;
        justify-content: flex-start;
    }

    .post-button {
        background-color: white;
        color: #d11f2e; /* Match button color */
        padding: 10px 20px;
        border: 2px solid #d11f2e;
        border-radius: 5px;
        font-size: 16px; /* Larger font size for button */
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .post-button:hover {
        background-color: #d11f2e; /* Button color on hover */
        color: white;
    }

    /* Container hover effect */
    .post-container:hover {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15); /* Softer shadow effect */
    }

    /* Nút xem thêm */
    .see-more-button a {
        background-color: #2f2f2f; /* Dark gray background */
        color: white; /* White text */
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        border: none; /* Remove border */
        display: inline-flex;
        align-items: center; /* Align the arrow icon with the text */
        font-size: 16px;
        font-weight: bold;
    }

    .see-more-button a::before {
        content: '>';
        margin-right: 8px; /* Space between the arrow and text */
        font-size: 18px;
        color: white; /* White arrow icon */
    }

    .see-more-button a:hover {
        background-color: #d11f2e; /* Red background on hover */
        color: white; /* Keep white text on hover */
    }

    /* Dòng xe nổi bật */
    .featured-cars {
        background-color: white;
        padding: 20px;
        margin-left: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 2px solid #000000;
        border-radius: 10px;
    }

    .featured-cars h5 {
        font-size: 1.5em;
        color: #000000;
        margin-bottom: 20px;
        font-weight: bold;
        text-align: center;
    }

    .featured-car-item {
        font-size: 1.2em;
        color: #000000;
        margin-bottom: 15px;
        text-decoration: none;
        display: block;
        text-align: center;
        padding: 10px 0;
        transition: background-color 0.3s, color 0.3s;
    }

    .featured-car-item:hover {
        background-color: #f44336;
        color: white;
        border-radius: 5px;
    }

    .featured-cars-list {
        list-style-type: none;
        padding-left: 0;
    }

    /* Banner styling */
    .vertical-banner {
        margin-top: 20px;
        text-align: center;
    }

    .vertical-banner img {
        max-width: 100%;
        border-radius: 10px;
    }
</style>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-12 mb-4">
                        <div class="post-container">
                            <img src="{{ $post->image_url }}" class="post-image" alt="Car Image">
                            <div class="post-content">
                                <div>
                                    <!-- Hiển thị tên xe (hãng xe + model) -->
                                    <h5 class="post-title">{{ $post->car->make }} {{ $post->car->model }}</h5>
                                    
                                    <p class="post-info">Mileage: {{ $post->mileage }} km | Year: {{ $post->year }}</p>
                                    <p class="post-description">{{ Str::limit($post->description, 100) }}</p>
                                    <p class="post-price">{{ number_format($post->price, 2) }} VND</p>
                                </div>
                                <div class="post-actions">
                                    <a href="{{ route('posts.show', $post->id) }}" class="post-button">> Xem thêm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Nút xem thêm -->
            <div class="see-more-button">
                <a href="{{ route('posts.index') }}">Xem tất cả</a>
            </div>
        </div>

        <!-- Dòng xe nổi bật và banner -->
        <div class="col-md-3">
            <div class="featured-cars">
                <h5>Dòng xe nổi bật</h5>
                <ul class="featured-cars-list">
                    @foreach($topCars as $car)
                        <li>
                            <a href="{{ route('posts.byCar', ['make' => $car->make, 'model' => $car->model]) }}" class="featured-car-item">
                                {{ $car->make }} {{ $car->model }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Vertical Banner -->
            <div class="vertical-banner">
                <img src="{{ asset('images/bannerdoc.png') }}" alt="Promotional Banner">
            </div>
        </div>
    </div>
</div>

@endsection
