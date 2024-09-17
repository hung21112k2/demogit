<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    @vite('resources/css/login.css')

</head>

<header>
        <div class="top-bar">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo">
            <div class="search-bar">
                <input type="text" placeholder="Tìm kiếm xe...">
                <button type="submit">Tìm kiếm</button>
            </div>
        </div>


        <nav class="main-menu">
            <ul>
                <li><a href="#">Xe cũ</a></li>
                <li><a href="#">Giá xe</a></li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="#">Đăng nhập</a></li>
            </ul>
            <button class="post-button">Đăng tin</button>
        </nav>
</header>

<body>
    <div class="login-container">
        <div class="login-form">
            <h2>Đăng nhập</h2>
            <form action="{{ url('/admin') }}" method="HEAD">  
                <!-- method ở đây dùng POST là lỗi -->
                @csrf
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mật khẩu" required>
                <button type="submit">Đăng nhập</button>
            </form>
            <div class="signup-link">
                <p>Chưa có tài khoản? <a href="{{ url('/home') }}">Đăng ký ngay</a></p>
            </div>
        </div>
    </div>


    <footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>Về Chúng Tôi</h3>
            <p>Bán Xe Ô Tô Cũ là nơi đáng tin cậy để tìm mua và bán xe ô tô cũ. Chúng tôi luôn cam kết mang đến cho khách hàng những chiếc xe chất lượng tốt nhất với giá cả hợp lý.</p>
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
                <li><a href="#">Trang chủ</a></li>
                <li><a href="#">Xe cũ</a></li>
                <li><a href="#">Giá xe</a></li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="{{ url('/login') }}">Đăng nhập</a></li>
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
        <p>&copy; 2024 Bán Xe Ô Tô Cũ. All rights reserved. | Designed by Huy Anh</p>
    </div>
    </footer>


</body>
</html>


