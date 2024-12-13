@extends('layouts.app')
 
@section('title', 'Kết quả tìm kiếm cho "' . $query . '"')
 
@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Kết quả tìm kiếm cho "{{ $query }}"</h1>
 
    @if($posts->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            Không có bài đăng nào phù hợp với tìm kiếm của bạn.
        </div>
    @else
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Model</th>
                    <th scope="col">Make</th>
                    <th scope="col">Hình ảnh</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->model }}</td>
                        <td>{{ $post->make }}</td>
                        <td><img src="{{ asset($post->car
