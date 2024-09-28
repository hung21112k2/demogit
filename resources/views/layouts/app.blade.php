<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bán Xe Ô Tô Cũ')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<style>
/* Global styles */
html, body {
    height: 100%; /* Đảm bảo toàn bộ trang chiếm 100% chiều cao */
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #FFFFFF;
}

a {
    text-decoration: none;
    color: inherit;
}

/* Sử dụng flexbox để căn footer sát đáy */
body {
    display: flex;
    flex-direction: column;
}

main {
    flex: 1; /* Giúp phần chính của trang chiếm không gian giữa */
}

/* Header */
.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    background-color: white;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.logo {
    max-height: 50px;
    width: auto;
}

.main-menu {
    display: flex;
    gap: 30px;
    align-items: center;
    flex-grow: 1;
    justify-content: center; /* Căn giữa menu */
}

.main-menu ul {
    display: flex;
    gap: 20px;
    margin: 0;
    padding: 0;
    list-style-type: none;
}

.main-menu ul li a {
    font-size: 18px;
    font-weight: 500;
    color: #333;
    transition: color 0.3s ease;
}

.main-menu ul li a:hover {
    color: #228dff;
}

/* Auth buttons */
.auth-buttons {
    display: flex;
    gap: 10px;
    align-items: center;
    margin-left: auto;
}

.auth-button, .post-button {
    border: 2px solid #228dff;
    background-color: white;
    color: #228dff;
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.auth-button:hover, .post-button:hover {
    background-color: #228dff;
    color: white;
}

/* Dropdown */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 10px 0;
    border-radius: 5px;
    z-index: 10;
    min-width: 200px;
}

.dropdown:hover .dropdown-menu {
    display: block;
}

.dropdown-menu a {
    display: block;
    padding: 10px 20px;
    color: #333;
    transition: background-color 0.3s ease;
}

.dropdown-menu a:hover {
    background-color: #f9f9f9;
}

/* Search Bar */
.search-bar {
    position: relative;
    display: flex;
    align-items: center;
    width: 400px;
    margin: 20px auto; /* Đưa thanh tìm kiếm vào giữa body */
}

.search-bar input[type="text"] {
    flex-grow: 1;
    padding: 10px 15px;
    border: 2px solid #ddd;
    border-radius: 30px 0 0 30px;
    font-size: 16px;
    outline: none;
}

.search-bar button {
    padding: 10px 20px;
    border: none;
    background-color: #28a745;
    color: white;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 0 30px 30px 0;
    transition: background-color 0.3s ease;
}

.search-bar button:hover {
    background-color: #218838;
}

.button-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 1%;
    background-color: #FFFFFF;
}
/* Footer */

footer {
    background-color: #C0C0C0;
    color: #fff;
    padding: 20px 0;
    font-size: 14px;
}

.footer-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 20px;
    background-color: #C0C0C0; /* Nền trắng */
    color: black; /* Chữ đen */
}

.footer-section h3 {
    font-size: 18px;
    margin-bottom: 10px;
    font-weight: bold;
    color: black; /* Tiêu đề chữ đen */
}

.footer-section p, .footer-section ul {
    font-size: 14px;
    color: black; /* Đoạn văn và danh sách chữ đen */
    line-height: 1.6;
}

.footer-section ul li a {
    color: black; /* Màu liên kết là đen */
}

.footer-section ul li a:hover {
    text-decoration: underline;
    color: #FFFFFF; /* Màu khi hover là xanh */
}

.footer-bottom {
    text-align: center;
    padding: 10px;
    background-color: #C0C0C0; /* Nền trắng */
    color: black; /* Chữ đen */
    font-size: 14px;
}

.social-icons a img {
    width: 30px;
    height: 30px;
}

.social-icons a:hover img {
    filter: brightness(0.8); /* Hiệu ứng hover cho icon */
}

</style>

<body>

<header>
    <div class="top-bar">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo">
        </a>

        <!-- Menu -->
        <nav class="main-menu">
            <ul>
                <li><a href="{{ route('cars.index') }}">Xe cũ</a></li>
                <li><a href="{{ route('news.index') }}">Tin tức</a></li>
                <li><a href="{{ route('posts.index') }}">Bài đăng</a></li>
            </ul>
        </nav>

        <!-- Auth buttons -->
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
                        <a href="{{ route('posts.byUser', ['user_id' => auth()->user()->id]) }}" class="btn btn-info">Xem bài đăng của người dùng</a>
                        <a href="{{ route('packages.index') }}">Gói dịch vụ</a>
                        <a href="{{ route('payment.form') }}">Nạp tiền</a>
                        <a href="{{ route('transactions.index') }}">Lịch sử giao dịch</a>
                        <p><strong>Số dư tài khoản:</strong> {{ number_format(auth()->user()->balance, 2) }} VND</p>

                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Đăng xuất
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @endauth
            <a href="{{ route('posts.create') }}" class="post-button">Đăng tin</a>
        </div>
    </div>
</header>

<main>
    <!-- Search bar moved to body -->
    <div class="search-bar">
        <form action="{{ route('search') }}" method="GET" style="width: 100%;">
            <input type="text" name="query" placeholder="Loại xe">
            <button type="submit">Tìm kiếm</button>
        </form>
    </div>

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
