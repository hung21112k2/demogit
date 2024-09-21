@extends('layouts.app')

@section('title', 'Thống kê người dùng')

@section('content')
<div class="container">
    <h1 class="text-center">Thống kê người dùng</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên người dùng</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Vai trò</th>
                <th>Số dư tài khoản</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>{{ number_format($user->balance, 2) }} VND</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
