@extends('layouts.app')

@section('title', 'Gói Dịch Vụ')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Danh Sách Gói Dịch Vụ</h1>

    @if($packages->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            Hiện không có gói dịch vụ nào.
        </div>
    @else
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Tên Gói</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Thời gian (ngày)</th>
                    <th scope="col">Giới hạn bài đăng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                    <tr>
                        <td>{{ $package->name }}</td>
                        <td>{{ number_format($package->price, 2) }} VND</td>
                        <td>{{ $package->duration }} ngày</td>
                        <td>{{ $package->post_limit }} bài đăng</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
