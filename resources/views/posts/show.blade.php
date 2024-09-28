@extends('layouts.app')

@section('title', 'Chi tiết bài đăng')

@section('content')
<div class="container mt-5">
    <h1>{{ $post->car->make }} {{ $post->car->model }} - {{ $post->year }}</h1>
    
    <!-- Hiển thị tất cả ảnh -->
    <div class="row">
        @foreach ($post->photos as $photo)
            <div class="col-md-4 mb-3">
                <img src="{{ asset($photo->image_url) }}" alt="Car image" class="img-fluid" style="max-height: 200px; object-fit: cover;">
            </div>
        @endforeach
    </div>
    
    <div class="mt-4">
        <!-- Hiển thị thông báo lỗi hoặc thành công -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <p><strong>Mô tả:</strong> {{ $post->description }}</p>
        <p><strong>Giá:</strong> {{ number_format($post->price) }} VND</p>
        <p><strong>Số km đã đi:</strong> {{ $post->mileage }} km</p>
        <p><strong>Năm sản xuất:</strong> {{ $post->year }}</p>
        <p><strong>Trạng thái:</strong> {{ $post->status }}</p>

        <!-- Thông tin liên hệ -->
        <div class="mt-4">
            <h4>Thông tin liên hệ</h4>
            @if(session()->has("paid_for_post_{$post->id}"))
                <p><strong>Email:</strong> {{ $post->user->email }}</p>
                <p><strong>Số điện thoại:</strong> {{ $post->user->phone }}</p>
            @else
                <p><strong>Email:</strong> <span style="filter: blur(5px);"> {{ $post->user->email }} </span></p>
                <p><strong>Số điện thoại:</strong> <span style="filter: blur(5px);"> {{ $post->user->phone }} </span></p>

                <!-- Nút thanh toán -->
                @auth
                    <form action="{{ route('payToViewContact', $post->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Thanh toán 5,000 VND để xem thông tin</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập để thanh toán 5,000 VND và xem thông tin</a>
                @endauth
            @endif
        </div>
    </div>
</div>
@endsection
