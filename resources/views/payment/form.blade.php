@extends('layouts.loginapp')

@section('title', 'Nạp tiền')

@section('content')
<style>
    /* Custom CSS cho giao diện đẹp với màu xanh và trắng */
    .container {
        margin-top: 50px;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
    }

    h1 {
        color: #007bff; /* Màu xanh chủ đạo */
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
    }

    label {
        font-weight: bold;
        color: #007bff;
        display: block;
        margin-bottom: 10px;
    }

    select {
        width: 100%;
        padding: 10px;
        border: 2px solid #007bff;
        border-radius: 5px;
        font-size: 16px;
        margin-bottom: 20px;
        color: #495057;
    }

    select:focus {
        border-color: #0056b3;
        box-shadow: none;
    }

    button {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        display: block;
        width: 100%;
        font-weight: bold;
    }

    button:hover {
        background-color: #0056b3;
    }

    .vnpay-logo {
        display: block;
        margin: 20px auto;
        max-width: 200px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        h1 {
            font-size: 1.8rem;
        }

        button {
            font-size: 14px;
        }
    }
</style>

<div class="container">
    <h1 class="text-center mb-4">Nạp tiền vào tài khoản</h1>

    <!-- Logo VNPay -->
    <img src="images/1581089357407-1580819448160-vnpay.png" alt="VNPay Logo" class="vnpay-logo">

    <form action="{{ route('payment.process') }}" method="POST">
        @csrf
        <label for="amount">Chọn số tiền:</label>
        <select name="amount" id="amount" required>
            <option value="100000">100,000 VND</option>
            <option value="200000">200,000 VND</option>
            <option value="500000">500,000 VND</option>
        </select>

        <button type="submit">Thanh toán qua VNPay</button>
    </form>
</div>
@endsection
