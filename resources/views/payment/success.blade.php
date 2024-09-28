@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Nạp tiền thành công</h1>
        <p class="text-center">Cảm ơn bạn! Số tiền đã được nạp vào tài khoản của bạn.</p>
        <a href="{{ url('/') }}" class="btn btn-primary d-block mx-auto" style="width: 200px;">Quay lại trang chủ</a>
    </div>
@endsection
