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
            background-color: #ffffff; /* Nền trắng */
        }
        
        .admin-sidebar {
            height: 100vh;
            background-color: #000000; /* Sidebar màu đen */
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
            color: #ffffff; /* Màu trắng cho text trong sidebar */
            text-decoration: none;
            display: block;
            font-weight: bold;
        }

        .admin-sidebar ul li a:hover {
            background-color: #f44336; /* Màu đỏ khi hover */
            color: #ffffff;
        }

        .admin-sidebar ul li a.active {
            background-color: #000000; /* Màu đỏ cho mục đang active */
            color: #ffffff;
        }

        .content {
            margin-left: 220px; /* Khớp với kích thước sidebar */
            padding: 20px;
            background-color: #ffffff; /* Nền trắng cho nội dung */
        }

        header {
        background-color: #ffffff; /* Nền trắng */
        color: #f44336; /* Màu đỏ */
        display: flex;
        align-items: center;
        justify-content: center; /* Căn giữa nội dung */
        padding: 20px;
    }

    header .logo {
        width: 200px; /* Đảm bảo logo không quá lớn */
        margin-left: 150px;
    }

    header h1 {
        font-size: 2.2rem;
        margin: 0;
    }

        footer {
            background-color: #000000; /* Màu đen cho footer */
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

        /* Nút Đăng xuất */
        .admin-sidebar ul li a.logout {
            background-color: transparent;
            color: #ffffff;
            font-weight: bold;
        }

        .admin-sidebar ul li a.logout:hover {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-sidebar">
        <ul>
            <li><a href="{{ route('admin.dashboard') }}" class="active"><i class="fas fa-home"></i> Trang chủ</a></li>
            <li><a href="{{ route('admin.users') }}"><i class="fas fa-users"></i> Tài khoản người dùng</a></li>
            <li><a href="{{ route('admin.cars.index') }}"><i class="fas fa-box"></i>  Các mẫu xe </a></li>
            <li><a href="{{ route('admin.posts.index') }}"><i class="fas fa-car"></i>Quản lý bài đăng</a></li>
            <li><a href="{{ route('admin.packages') }}"><i class="fas fa-box"></i>>Quản lý các gói dịch vụ</a></li>
            <li><a href="#" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a></li>
        </ul>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Header -->
    <header>
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/z5876504630797_26fcdac87a564cc11 (1).jpg') }}" alt="Logo" class="logo"> <!-- Logo nằm trong header -->
            <h1>Admin Dashboard</h1>
        </div>
    </header>

    <!-- Nội dung trang -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Admin Dashboard. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
