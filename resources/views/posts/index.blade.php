@extends('layouts.loginapp')

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

    /* Styling for the dual handle slider */
    .slider-container {
        position: relative;
        width: 100%;
        height: 8px;
        background: #ddd;
        border-radius: 5px;
    }

    .range-slider {
        width: 100%;
        position: relative;
        height: 8px;
    }

    .range-slider input[type="range"] {
        position: absolute;
        -webkit-appearance: none;
        width: 100%;
        height: 8px;
        background: transparent;
        pointer-events: none;
    }

    .range-slider input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 20px;
    height: 20px;
    background: #000; /* Đổi thành màu đen */
    border-radius: 50%;
    cursor: pointer;
    pointer-events: auto;
    position: relative;
}

.range-slider input[type="range"]::-moz-range-thumb {
    width: 20px;
    height: 20px;
    background: #000; /* Đổi thành màu đen */
    border-radius: 50%;
    cursor: pointer;
    position: relative;
}


    .range-slider input[type="range"]:focus {
        outline: none;
    }

    .range-slider .track {
    background: #000; /* Đổi thành màu đen */
    position: absolute;
    height: 8px;
    z-index: 1;
    border-radius: 5px;
}


    .price-range-values {
        font-weight: bold;
        color: #333;
        text-align: center;
        margin-top: 10px;
    }

    .btn-primary {
        background-color: #f44336 !important;
        border-color: #f44336 !important;
        color: white !important;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #d32f2f !important;
        border-color: #d32f2f !important;
        color: white !important;
    }




</style>

<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách xe đang được đăng bán</h1>

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

                    
                    <!-- Dual handle range slider -->
                    <div class="slider-container mt-4 range-slider">
                        <div class="track"></div>
                        <input type="range" name="price_min" id="price-range-min" min="0" max="2000000000" step="10000000" value="{{ request('price_min', 0) }}" oninput="updateSlider()">
<input type="range" name="price_max" id="price-range-max" min="0" max="2000000000" step="10000000" value="{{ request('price_max', 2000000000) }}" oninput="updateSlider()">

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
                    <img src="{{ asset($post->image_url) }}" class="card-img-top img-fluid" alt="{{ optional($post->car)->make ?? 'Chưa xác định' }} {{ optional($post->car)->model ?? '' }}" style="max-height: 200px; object-fit: cover;">
<div class="card-body">
    <h5 class="card-title">{{ optional($post->car)->make ?? 'Chưa xác định' }} {{ optional($post->car)->model ?? '' }} - {{ $post->year }}</h5>
    <p class="card-text"><strong>Giá:</strong> {{ number_format($post->price, 0, ',', '.') }} VNĐ</p>
    <p class="card-text"><strong>Số km đã đi:</strong> {{ number_format($post->mileage, 0, ',', '.') }} km</p>
</div>

                        <div class="card-footer">
                            <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="btn btn-primary w-100"> > Xem thêm</a>
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
function updateSlider() {
    const minSlider = document.getElementById('price-range-min');
    const maxSlider = document.getElementById('price-range-max');
    const minPrice = document.getElementById('min-price');
    const maxPrice = document.getElementById('max-price');

    if (parseInt(minSlider.value) > parseInt(maxSlider.value)) {
        minSlider.value = maxSlider.value;
    }

    minPrice.innerText = new Intl.NumberFormat('vi-VN').format(minSlider.value) + ' VNĐ';
    maxPrice.innerText = new Intl.NumberFormat('vi-VN').format(maxSlider.value) + ' VNĐ';

    // Update track background
    const rangeTrack = document.querySelector('.track');
    const min = parseInt(minSlider.min);
    const max = parseInt(maxSlider.max);
    const percentageMin = ((minSlider.value - min) / (max - min)) * 100;
    const percentageMax = ((maxSlider.value - min) / (max - min)) * 100;

    rangeTrack.style.left = percentageMin + '%';
    rangeTrack.style.right = (100 - percentageMax) + '%';
}

// Update slider values on page load
window.onload = function() {
    updateSlider();
}
</script>

@endsection
