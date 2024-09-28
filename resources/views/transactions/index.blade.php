@extends('layouts.app')

@section('title', 'Lịch sử giao dịch')

@section('content')
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
