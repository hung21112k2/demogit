@extends('layouts.app')

@section('title', 'Bài Đăng theo Xe')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách Bài Đăng về Xe</h1>

    @if($posts->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            Chưa có bài đăng nào cho xe này.
        </div>
    @else
        <div class="row">
            <!-- Hiển thị danh sách bài đăng -->
            @foreach($posts as $post)
                <div class="col-lg-12 mb-4">
                    <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ asset($post->image_url) }}" class="card-img" alt="Hình ảnh xe">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->car->make }} - {{ $post->car->model }} - {{ $post->year }}</h5>
                                    <p class="card-text text-muted">Số tự động • Máy xăng • {{ $post->mileage }} km</p>
                                    <h6 class="text-danger">{{ number_format($post->price) }} $</h6>
                                    <div class="d-flex justify-content-between">
                                        <div class="text-muted">
                                            <i class="fa fa-map-marker-alt"></i> Hà Nội
                                            <div class="card-footer">
    <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="btn btn-primary w-100">Xem chi tiết</a>
</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
