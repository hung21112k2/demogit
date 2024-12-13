@extends('layouts.app')

@section('title', 'Danh sách bài đăng')

@section('content')

<style>
    .active-filter {
        color: #f44336;
        font-weight: bold;
        text-decoration: underline;
    }

    form .col-md-12 div a {
        margin-right: 10px;
        color: #333;
        font-size: 14px;
    }

    form .col-md-12 div a:hover {
        color: #f44336;
        text-decoration: underline;
    }

    form .col-md-12 div a.text-primary {
        color: #007bff;
    }

    form .col-md-12 div a.text-primary:hover {
        color: #0056b3;
    }

    /* CSS cho thanh kéo */
    .slider-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .price-range-values {
        font-weight: bold;
        color: #333;
    }

    /* Cập nhật các nút theo tông màu đỏ trắng */
    .btn-primary {
        background-color: #f44336 !important;
        border-color: #f44336 !important;
        color: white !important;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #d32f2f !important;
        border-color: #d32f2f !important;
        color: white !important;
    }

    .btn-secondary {
        background-color: white !important;
        border-color: #f44336 !important;
        color: #f44336 !important;
    }

    .pagination .page-link {
    color: #f44336; /* Màu chữ mặc định */
    border: 1px solid #f44336; /* Màu viền */
    background-color: white; /* Nền trắng */
    transition: background-color 0.3s ease, color 0.3s ease;
}

.pagination .page-item.active .page-link {
    background-color: #f44336; /* Nền đỏ cho trang hiện tại */
    color: white; /* Chữ trắng */
    border-color: #f44336; /* Viền đỏ */
}

.pagination .page-link:hover {
    background-color: #f44336; /* Nền đỏ khi hover */
    color: white; /* Chữ trắng khi hover */
    border-color: #f44336; /* Viền đỏ khi hover */
}

.pagination .page-item.disabled .page-link {
    background-color: #f9f9f9; /* Nền xám nhạt cho các nút bị disabled */
    color: #ccc; /* Màu chữ xám cho các nút bị disabled */
    border-color: #ddd; /* Viền nhạt cho các nút bị disabled */
}

</style>

<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách xe đang bán</h1>

    <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
        <div class="card p-3">
            <div class="row">
                <!-- Lọc theo hãng xe -->
                <div class="col-md-12 mb-2">
                    <strong>Hãng xe:</strong>
                    <div>
                        <a href="?make=" class="{{ request('make') == '' ? 'active-filter' : '' }}">Tất cả</a>
                        @foreach($makes as $make)
                            <a href="?make={{ $make }}" class="{{ request('make') == $make ? 'active-filter' : '' }}">{{ $make }}</a>
                        @endforeach

                    </div>
                </div>

                <!-- Lọc theo năm sản xuất -->
                <div class="col-md-12 mb-2">
                    <strong>Năm SX:</strong>
                    <div>
                        <a href="?year=" class="{{ request('year') == '' ? 'active-filter' : '' }}">Tất cả</a>
                        @foreach(range(date('Y'), 2000) as $year)
                            <a href="?year={{ $year }}" class="{{ request('year') == $year ? 'active-filter' : '' }}">{{ $year }}</a>
                        @endforeach

                    </div>
                </div>

                <!-- Khoảng giá -->
                <div class="col-md-12 mb-4">
                    <strong>Khoảng giá:</strong>
                    <div class="slider-container">
                        <input type="range" name="price_min" id="price_min" min="0" max="2000000000" step="10000000" value="{{ request('price_min', 0) }}" oninput="updatePriceValues()">
                        <input type="range" name="price_max" id="price_max" min="0" max="2000000000" step="10000000" value="{{ request('price_max', 2000000000) }}" oninput="updatePriceValues()">
                    </div>
                    <div class="price-range-values mt-2">
                        <span id="min-price">0</span> VNĐ - <span id="max-price">2.000.000.000</span> VNĐ
                    </div>
                </div>

                <!-- Nút lọc -->
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary w-100">Lọc bài đăng</button>
                </div>
            </div>
        </div>
    </form>

    @if($posts->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            Chưa có bài đăng nào.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($posts as $post)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset($post->image_url) }}" class="card-img-top img-fluid" alt="{{ $post->car->make }} {{ $post->car->model }}" style="max-height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->car->make }} {{ $post->car->model }} - {{ $post->year }}</h5>
                            <p class="card-text"><strong>Giá:</strong> {{ number_format($post->price, 0, ',', '.') }} VNĐ</p>
                            <p class="card-text"><strong>Số km đã đi:</strong> {{ number_format($post->mileage, 0, ',', '.') }} km</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="btn btn-primary w-100">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Hiển thị phân trang -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $posts->links('vendor.pagination.custom-pagination') }}
        </div>
    @endif
</div>

<script>
    function updatePriceValues() {
        const priceMin = document.getElementById('price_min').value;
        const priceMax = document.getElementById('price_max').value;

        document.getElementById('min-price').innerText = new Intl.NumberFormat('vi-VN').format(priceMin) + ' VNĐ';
        document.getElementById('max-price').innerText = new Intl.NumberFormat('vi-VN').format(priceMax) + ' VNĐ';
    }

    // Cập nhật giá trị ngay khi tải trang nếu có sẵn giá trị từ request
    window.onload = function() {
        updatePriceValues();
    }
</script>

@endsection
