<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>

    
</head>

<header>
        <div class="top-bar">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo">
        </div>
        

</header>

<body>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}


.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background-color: #ffffff;
}

.logo {
    width: 20%;
    margin-left: 14%;
}


.admin-header {
    background-color: #ffffff;
    color: rgb(0, 0, 0);
    padding: 15px;
    text-align: center;
}

.admin-sidebar {
    width: 14%;
    height: 100vh;
    background-color: #228dff;
    position: fixed;
    top: 0;
    left: 0;
    padding-top: 60px;
}

.admin-sidebar ul {
    list-style-type: none;
    padding: 0;
}

.admin-sidebar ul li {
    padding: 10px;
    text-align: center;
}

.admin-sidebar ul li a {
    color: white;
    text-decoration: none;
    display: block;
}

.admin-sidebar ul li:hover {
    background-color: #228dff;
}

.admin-content {
    margin-left: 20%;
    padding: 20px;
}

.admin-card {
    background-color: white;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-right: 7%;
    
}


footer {
    background-color: #228dff;
    color: white;
    padding: 20px 0;
    font-size: 14px;
    margin-left: 10%;
}

.footer-container {
    display: flex;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.footer-section {
    flex: 1;
    padding: 0 20px;
}

.footer-section h3 {
    font-size: 18px;
    margin-bottom: 10px;
    color: #ffffff;
}

.footer-section p, .footer-section ul {
    margin: 0;
    padding: 0;
}

.footer-section ul {
    list-style-type: none;
}

.footer-section ul li {
    margin-bottom: 8px;
}

.footer-section ul li a {
    color: #ffffff;
    text-decoration: none;
}

.footer-section ul li a:hover {
    text-decoration: underline;
}

.social-icons a {
    display: inline-block;
    margin-right: 10px;
}

.social-icons a img {
    width: 24px;
    height: 24px;
}

.footer-bottom {
    text-align: center;
    background-color: #228dff;
    padding: 10px 0;
    margin-top: 20px;
    color: #ffffff;
}

.footer-bottom p {
    margin: 0;
}

.footer-bottom p a {
    color: #ffffff;
    text-decoration: none;
}

.footer-bottom p a:hover {
    text-decoration: underline;
}
        </style>
    <div class="admin-header">
        <h1>Admin Dashboard</h1>
    </div>

    <div class="admin-sidebar">
        <ul>
        <li><a href="{{ route('admin.users') }}">Thống kê người dùng</a></li>
        <li><a href="{{ route('admin.cars') }}">Quản lý sản phẩm</a></li>

        <li><a href="{{ route('admin.posts') }}">Quản lý bài đăng</a></li>

        <li><a href="{{ route('admin.packages') }}">Quản lý các gói dịch vụ</a></li>
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
            <h3>Quản lý bài đăng</h3>
            <p>Hiển thị các bài đăng của khách.</p>
        </div>

        <div class="admin-card">
            <h3>Quản lý các gói dịch vụ</h3>
            <p>Hiển thị các gọi dịch vụ của bạn.</p>
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