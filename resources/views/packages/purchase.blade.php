@extends('layouts.app')

@section('title', 'Mua gói')

@section('content')
<style>
    /* CSS tùy chỉnh */
    .container {
        margin-top: 50px;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #dc3545;
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

    .form-group label {
        font-weight: bold;
        color: #dc3545;
    }

    .form-control {
        border: 1px solid #dc3545;
        border-radius: 4px;
    }

    .form-control:focus {
        border-color: #dc3545;
        box-shadow: none;
    }

    .btn-primary {
        background-color: #dc3545;
        border-color: #dc3545;
        font-weight: bold;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 4px;
        width: 100%;
        text-align: center;
    }

    .btn-primary:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        h1 {
            font-size: 1.8rem;
        }

        .btn-primary {
            font-size: 14px;
            padding: 8px 15px;
        }
    }
</style>

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
