@extends('layouts.app')

@section('title', 'Mua gói')

@section('content')
<div class="container">
    <h1>Mua gói dịch vụ</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Hiển thị danh sách các gói dịch vụ để người dùng lựa chọn -->
    <form action="{{ route('packages.purchase') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="package_id">Chọn gói</label>
            <select name="package_id" class="form-control" required>
                <option value="">Chọn gói...</option>
                @foreach($packages as $package)
                    <option value="{{ $package->id }}">
                        {{ $package->name }} - {{ number_format($package->price, 0, ',', '.') }} VNĐ - 
                        Số bài đăng: {{ $package->post_limit }} - Thời gian tồn tại: {{ $package->duration }} ngày
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mua gói</button>
    </form>
</div>
@endsection
