<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bán Xe Ô Tô Cũ')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        .auth-button {
            border: 2px solid #228dff; /* Màu hồng cho khung */
            background-color: white;
            color: #228dff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
            white-space: nowrap; /* Đảm bảo chữ không bị ngắt dòng */
        }

        .auth-button:hover {
            background-color: #228dff;
            color: white;
        }

        .auth-buttons {
            display: inline-flex; /* Đảm bảo các nút nằm trên một dòng */
            gap: 10px; /* Khoảng cách giữa các nút */
            justify-content: flex-end;
            align-items: center;
        }

        .top-bar {
            display: flex;
            justify-content: space-between; /* Giãn cách logo và các nút đăng nhập/đăng ký */
            align-items: center;
            padding: 10px;
        }

        .logo {
            max-height: 50px; /* Điều chỉnh chiều cao của logo */
            width: auto; /* Giữ tỉ lệ của logo */
        }

        /* Phong cách cho nút dropdown */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-menu {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    right: 0; /* Đặt menu ở cạnh phải */
    top: 100%; /* Đặt menu ngay dưới nút */
    padding: 10px 0;
    border-radius: 5px;
}

.dropdown-menu a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    font-weight: bold;
    transition: background-color 0.3s;
}

.dropdown-menu a:hover {
    background-color: #ddd;
}

/* Hiển thị menu khi trỏ chuột vào dropdown */
.dropdown:hover .dropdown-menu {
    display: block;
}

/* Thay đổi màu nút khi menu thả xuống */
.dropdown:hover .dropdown-toggle {
    background-color: #228dff;
    color: white;
}
    </style>
</head>
<body>

    <header>
    <div class="top-bar">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo">
        </a>
            
        <div class="auth-buttons">
    @guest
        <a href="{{ route('login') }}" class="auth-button">Đăng nhập</a>
        <a href="{{ route('register') }}" class="auth-button">Đăng ký</a>
    @endguest
    @auth
    <div class="dropdown">
        <a href="#" class="auth-button dropdown-toggle">Tài khoản</a>
        <div class="dropdown-menu">
            <a href="{{ route('contact.index') }}">Tổng quan</a>
            <a href="#">Quản lý tin đăng</a>
            <a href="#">Gói hội viên</a>
            <a href="#">Quản lý tin tài trợ</a>
            <a href="#">Thay đổi thông tin cá nhân</a>
            <a href="#">Thay đổi mật khẩu</a>
            <a href="#">Nạp tiền</a>
            <a href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Đăng xuất
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
    @endauth
</div>
    </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>Về Chúng Tôi</h3>
                <p>Bán Xe Ô Tô Cũ là nơi đáng tin cậy để tìm mua và bán xe ô tô cũ. Chúng tôi cam kết mang đến cho khách hàng những chiếc xe chất lượng tốt nhất với giá cả hợp lý.</p>
            </div>
            <div class="footer-section">
                <h3>Liên Hệ</h3>
                <ul>
                    <li>Địa chỉ: 123 Đường Cầu Giấy, Hà Nội, Việt Nam</li>
                    <li>Điện thoại: 0123 456 789</li>
                    <li>Email: carsused@gmail.com</li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Liên Kết Nhanh</h3>
                <ul>
                    <li><a href="{{ url('/') }}">Trang chủ</a></li>
                    
    <li><a href="{{ route('cars.index') }}">Xe cũ</a></li>
    <li><a href="{{ route('news.index') }}">Tin tức</a></li>
    <li><a href="{{ route('posts.index') }}">Bài đăng</a></li>

                </ul>
            </div>
            <div class="footer-section">
                <h3>Theo Dõi Chúng Tôi</h3>
                <div class="social-icons">
                    <a href="#"><img src="{{ asset('images/ff.jpg') }}" alt="Facebook"></a>
                    <a href="#"><img src="{{ asset('images/ii.jpg') }}" alt="Twitter"></a>
                    <a href="#"><img src="{{ asset('images/pp.jpg') }}" alt="Instagram"></a>
                    <a href="#"><img src="{{ asset('images/youtube-icon.png') }}" alt="YouTube"></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2024 Bán Xe Ô Tô Cũ. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
