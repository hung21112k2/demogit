@extends('layouts.app')

@section('title', 'Chi tiết bài đăng')

@section('content')
<div class="container mt-5">
    <h1>{{ $post->car->make }} {{ $post->car->model }} - {{ $post->year }}</h1>
    
    <img src="{{ asset($post->image_url) }}" alt="{{ $post->car->make }} {{ $post->car->model }}" class="img-fluid" style="max-height: 400px; object-fit: cover;">
    
    <div class="mt-4">
        <p><strong>Mô tả:</strong> {{ $post->description }}</p>
        <p><strong>Giá:</strong> {{ number_format($post->price) }} $</p>
        <p><strong>Số km đã đi:</strong> {{ $post->mileage }} km</p>
        <p><strong>Năm sản xuất:</strong> {{ $post->year }}</p>
        <p><strong>Trạng thái:</strong> {{ $post->status }}</p>
    </div>
</div>
@endsection
