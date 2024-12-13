@extends('layouts.app')

@section('title', 'Lịch sử giao dịch')

@section('content')
<style>
    /* CSS tùy chỉnh */
    .container {
        margin-top: 50px;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #dc3545;
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
    }

    .table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table th {
        background-color: #dc3545;
        color: white;
        text-align: center;
        font-weight: bold;
        text-transform: uppercase;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #ffffff;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .text-center {
        color: #333;
        margin-top: 30px;
    }

    .btn {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }

    .btn:hover {
        background-color: #bd2130;
        border-color: #bd2130;
    }

</style>

<div class="container mt-5">
    <h1 class="text-center mb-4">Lịch sử giao dịch</h1>

    @if($transactions->isEmpty())
        <p class="text-center">Bạn chưa có giao dịch nào.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Mã giao dịch</th>
                    <th>Số tiền</th>
                    <th>Phương thức thanh toán</th>
                    <th>Thời gian giao dịch</th>
                </tr>
            </thead>
            <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->transaction_id }}</td>
                <td>{{ number_format($transaction->amount, 0, ',', '.') }} VND</td>
                <td>{{ $transaction->payment_method }}</td>
                <td>{{ $transaction->transaction_date->format('d/m/Y H:i:s') }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
