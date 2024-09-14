@extends('layouts.app')

@section('title', 'Danh sách bài đăng')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách xe đang bán</h1>

    @if($posts->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            Chưa có bài đăng nào.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4"> <!-- Hiển thị các bài đăng theo card layout -->
            @foreach($posts as $post)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset($post->image_url) }}" class="card-img-top img-fluid" alt="{{ $post->car->make }} {{ $post->car->model }}" style="max-height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->car->make }} {{ $post->car->model }} - {{ $post->year }}</h5>
                            <p class="card-text">{{ Str::limit($post->description, 100) }}</p> <!-- Giới hạn mô tả -->
                            <p class="card-text"><strong>Giá:</strong> {{ number_format($post->price) }} VND</p>
                            <p class="card-text"><strong>Số km đã đi:</strong> {{ $post->mileage }} km</p>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-primary w-100">Xem chi tiết</a> <!-- Nút Xem chi tiết -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
