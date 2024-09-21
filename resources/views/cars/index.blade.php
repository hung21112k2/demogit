@extends('layouts.app')

@section('title', 'Danh sách Xe Cũ')

@section('content')
<style>
.container {
    margin-top: 50px;
    padding: 0 20px;
}

h1 {
    text-align: center;
    margin-bottom: 40px;
    font-size: 2.5em;
    color: #333;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th, .table td {
    padding: 15px;
    text-align: left;
}

.table thead th {
    background-color: #333;
    color: white;
}

.table tbody tr:hover {
    background-color: #f5f5f5;
}

.table tbody tr a {
    color: #007bff;
    text-decoration: none;
}

.table tbody tr a:hover {
    text-decoration: underline;
}

.car-image {
    width: 100px;
    height: auto;
}
</style>

<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách Xe Cũ</h1>

    @if($cars->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            Chưa có xe cũ nào.
        </div>
    @else
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Hình ảnh</th> <!-- Thêm cột hình ảnh -->
                    <th scope="col">Hãng xe</th>
                    <th scope="col">Mẫu xe</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                    <tr>
                        <td>
                            @if($car->image)
                                <img src="{{ asset($car->image) }}" alt="{{ $car->make }}" class="car-image">
                            @else
                                <span>Chưa có hình ảnh</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('posts.byCar', ['car_id' => $car->id]) }}">
                                {{ $car->make }}
                            </a>
                        </td>
                        <td>{{ $car->model }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
