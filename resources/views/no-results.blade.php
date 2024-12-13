@extends('layouts.app')

@section('title', 'Không tìm thấy kết quả')

@section('content')
<div class="container text-center mt-5">
    <h1>Không tìm thấy kết quả</h1>
    <p>Chúng tôi không thể tìm thấy kết quả cho từ khóa của bạn. Vui lòng thử lại với từ khóa khác.</p>
    
    <a href="{{ url('/') }}" class="btn btn-primary">Quay lại trang chủ</a>
</div>
@endsection
