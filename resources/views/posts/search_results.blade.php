@extends('layouts.app')

@section('title', 'Kết quả tìm kiếm cho "' . $query . '"')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Kết quả tìm kiếm cho "{{ $query }}"</h1>

    @if($posts->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            Không có bài đăng nào phù hợp với tìm kiếm của bạn.
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
