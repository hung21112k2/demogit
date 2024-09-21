<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Bootstrap CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (for icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        
        .admin-sidebar {
            height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
            position: fixed;
            width: 220px;
        }

        .admin-sidebar ul {
            list-style-type: none;
            padding-left: 0;
        }

        .admin-sidebar ul li {
            padding: 10px 20px;
        }

        .admin-sidebar ul li a {
            color: #ffffff;
            text-decoration: none;
            display: block;
            font-weight: bold;
        }

        .admin-sidebar ul li a:hover {
            background-color: #495057;
            color: #ffffff;
        }

        .admin-sidebar ul li a.active {
            background-color: #007bff;
            color: #ffffff;
        }

        .content {
            margin-left: 240px;
            padding: 20px;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="admin-sidebar">
        <ul>
            <li><a href="{{ route('admin.dashboard') }}" class="active"><i class="fas fa-home"></i> Trang chủ</a></li>
            <li><a href="{{ route('admin.users') }}"><i class="fas fa-users"></i> Quản lý người dùng</a></li>
            <li><a href="{{ route('admin.cars') }}"><i class="fas fa-box"></i> Quản lý sản phẩm</a></li>
            <li><a href="{{ route('admin.posts') }}"><i class="fas fa-car"></i>Quản lý bài đăng</a></li>
            <li><a href="{{ url('/login') }}"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
        </ul>
    </div>

    <header>
        <h1>Admin Dashboard</h1>
    </header>

    <div class="content">
        @yield('content')
    </div>

    <footer>
        <p>&copy; 2024 Admin Dashboard. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
