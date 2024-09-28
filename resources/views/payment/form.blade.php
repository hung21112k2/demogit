@extends('layouts.app')

@section('title', 'Nạp tiền')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Nạp tiền vào tài khoản</h1>

    <form action="{{ route('payment.process') }}" method="POST">
    @csrf
    <label for="amount">Chọn số tiền:</label>
    <select name="amount" id="amount">
        <option value="100000">100,000 VND</option>
        <option value="200000">200,000 VND</option>
        <option value="500000">500,000 VND</option>
    </select>
    <button type="submit">Thanh toán qua VNPay</button>
</form>

    </form>
</div>
@endsection
