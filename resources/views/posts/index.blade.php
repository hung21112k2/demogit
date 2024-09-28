@extends('layouts.app')

@section('title', 'Danh sách bài đăng')

@section('content')
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
            {{ $posts->links() }} <!-- Hiển thị pagination links -->
        </div>
    @endif
</div>
@endsection
