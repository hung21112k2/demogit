@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Thanh toán thất bại</h1>
        <p class="text-center">Xin lỗi, quá trình thanh toán đã không thành công. Vui lòng thử lại.</p>
        <a href="{{ url('/') }}" class="btn btn-primary d-block mx-auto" style="width: 200px;">Quay lại trang chủ</a>
    </div>
@endsection
