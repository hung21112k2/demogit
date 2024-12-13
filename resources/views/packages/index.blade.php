@extends('layouts.app')

@section('title', 'Gói Dịch Vụ')

@section('content')
<style>
    /* CSS tùy chỉnh */
    .container {
        margin-top: 50px;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 30px;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
        width: 300px;
        padding: 20px;
        text-align: center;
        position: relative;
    }

    .card h3 {
        color: #dc3545;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .card p.price {
        font-size: 24px;
        color: #333;
        margin-bottom: 10px;
    }

    .card p.duration {
        font-size: 16px;
        color: #555;
        margin-bottom: 20px;
    }

    .card ul {
        list-style-type: none;
        padding: 0;
        margin-bottom: 20px;
    }

    .card ul li {
        font-size: 16px;
        color: #333;
        margin-bottom: 10px;
    }

    .btn-buy {
        background-color: #dc3545;
        color: #fff;
        padding: 10px 20px;
        text-transform: uppercase;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-buy:hover {
        background-color: #bd2130;
    }

    .best-seller {
        position: absolute;
        top: -10px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #ff9900;
        color: #fff;
        padding: 5px 10px;
        font-weight: bold;
        border-radius: 5px;
        font-size: 14px;
    }
</style>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @foreach($packages as $package)
        <div class="card">
            @if($package->is_best_seller)
                <div class="best-seller">Bán chạy nhất</div>
            @endif
            <h3>{{ $package->name }}</h3>
            <p class="price">{{ number_format($package->price, 0, ',', '.') }} VND/tháng</p>
            <p class="duration">Thời gian: {{ $package->duration }} ngày</p>
            <ul>
                <li>Giới hạn bài đăng: {{ $package->post_limit }} bài đăng</li>
                <!-- Thêm các tiện ích hoặc thông tin gói để người dùng dễ hiểu -->
            </ul>
            <form action="{{ route('packages.buy') }}" method="POST">
    @csrf
    <input type="hidden" name="package_id" value="{{ $package->id }}">
    <button type="submit" class="btn-buy">Mua ngay</button>
</form>
        </div>
    @endforeach
</div>
@endsection
