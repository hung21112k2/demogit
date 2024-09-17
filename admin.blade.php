<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    @vite('resources/css/admin.css')
    
</head>

<header>
        <div class="top-bar">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo">
        </div>
        

</header>

<body>
    <div class="admin-header">
        <h1>Admin Dashboard</h1>
    </div>

    <div class="admin-sidebar">
        <ul>
            <li><a href="#">Trang chủ</a></li>
            <li><a href="#">Quản lý người dùng</a></li>
            <li><a href="#">Quản lý sản phẩm</a></li>
            <li><a href="{{ url('/products') }}">Xe cũ</a></li>
            <li><a href="#">Giá xe</a></li>
            <li><a href="#">Tin tức</a></li>
            <li><a href="#">Cài đặt</a></li>
            <li><a href="{{ url('/login') }}">Đăng xuất</a></li>
        </ul>
    </div>

    <div class="admin-content">
        <h2>Welcome to the Admin Dashboard</h2>
        <div class="admin-card">
            <h3>Thống kê người dùng</h3>
            <p>Hiển thị số liệu về người dùng.</p>
        </div>

        <div class="admin-card">
            <h3>Quản lý sản phẩm</h3>
            <p>Hiển thị các chức năng quản lý sản phẩm.</p>
        </div>

        <div class="admin-card">
            <h3>Quản lý giao dịch</h3>
            <p>Hiển thị các giao dịch của bạn.</p>
        </div>

        <div class="admin-card">
            <h3>Quản lý các gói dịch vụ</h3>
            <p>Hiển thị các gọi dịch vụ của bạn.</p>
        </div>

        <div class="admin-card">
            <h3>Quản lý thông tin</h3>
            <p>Hiển thị các thông tin mà bạn chia sẻ.</p>
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
                <li><a href="#">Đăng nhập</a></li>
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


