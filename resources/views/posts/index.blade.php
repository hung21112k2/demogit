@extends('layouts.app')

@section('title', 'Danh sách bài đăng')

@section('content')
<style>
.container {
    margin: 40px auto;
    max-width: 1200px; /* Tăng chiều rộng để phù hợp với 5 sản phẩm mỗi hàng */
    padding: 0;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 2.5em;
    color: #333;
}

.car-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between; /* Tạo khoảng cách đều giữa các sản phẩm */
}

.car-item {
    width: 18%; /* Chiếm 18% chiều rộng mỗi sản phẩm để có thể chứa 5 sản phẩm trên 1 hàng */
    margin-bottom: 20px;
    text-align: center;
}

.car-item img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
}

.car-info {
    margin-top: 10px;
}

.car-info h3 {
    font-size: 1.2em;
    color: #333;
    margin-bottom: 8px;
}

.car-info p {
    color: #555;
}

button.view-more-button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
}

button.view-more-button:hover {
    background-color: #0056b3;
}
    </style>
<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách xe đang bán</h1>

    <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
    <div class="row">
        <!-- Lọc theo hãng xe -->
        <div class="col-md-4">
            <select name="make" class="form-control">
                <option value="">Chọn hãng xe</option>
                @foreach($makes as $make)
                    <option value="{{ $make }}" {{ request('make') == $make ? 'selected' : '' }}>
                        {{ $make }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Lọc theo giá -->
        <div class="col-md-2">
            <input type="number" name="price_min" class="form-control" placeholder="Giá thấp nhất" value="{{ request('price_min') }}">
        </div>
        <div class="col-md-2">
            <input type="number" name="price_max" class="form-control" placeholder="Giá cao nhất" value="{{ request('price_max') }}">
        </div>

        <!-- Lọc theo năm sản xuất -->
        <div class="col-md-2">
            <input type="number" name="year" class="form-control" placeholder="Năm sản xuất" value="{{ request('year') }}">
        </div>

        <!-- Nút lọc -->
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Lọc bài đăng</button>
        </div>
    </div>
</form>

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
                            <p class="card-text"><strong>Giá:</strong> {{ number_format($post->price) }} $</p>
                            <p class="card-text"><strong>Số km đã đi:</strong> {{ $post->mileage }} km</p>
                        </div>
                        <div class="card-footer">
    <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="btn btn-primary w-100">Xem chi tiết</a>
</div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
