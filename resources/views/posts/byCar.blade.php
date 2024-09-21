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
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số km đã đi</th>
                    <th scope="col">Năm sản xuất</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col"></th> <!-- Thêm cột Hành động -->
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->description }}</td>
                        <td>{{ number_format($post->price) }} VND</td>
                        <td>{{ $post->mileage }} km</td>
                        <td>{{ $post->year }}</td>
                        <td><img src="{{ asset($post->image_url) }}" alt="Hình ảnh" style="max-width: 100px;" class="img-thumbnail"></td>
                        <td>
                            <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="btn btn-primary w-100">Xem chi tiết</a> <!-- Thêm nút Xem chi tiết -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
