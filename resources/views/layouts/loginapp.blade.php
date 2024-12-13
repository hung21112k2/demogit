<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bán Xe Ô Tô Cũ')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<style>
/* Global styles */
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #FFFFFF;
}

a {
    text-decoration: none;
    color: inherit;
}

body {
    display: flex;
    flex-direction: column;
}

main {
    flex: 1;
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

/* Main Menu Styles */
.main-menu ul li a {
    font-size: 16px;
    font-weight: 400;
    color: #333;
    transition: color 0.3s ease, border-color 0.3s ease;
    font-family: 'Roboto', Arial, sans-serif;
    letter-spacing: 0.5px;
    padding: 10px 20px;
    border: 2px solid transparent;
    border-radius: 5px;
    display: inline-block;
    text-decoration: none; /* Ensure no underline */
}

.main-menu ul li a:hover,
.main-menu ul li a.active {
    color: #f44336;
    border-color: #f44336;
    font-weight: 700;
    text-decoration: none;
}

.main-menu ul {
    display: flex;
    gap: 20px;
    margin: 0;
    padding: 0;
    list-style-type: none;
    margin-left: 50px;
}

/* Auth buttons */
.auth-buttons {
    display: flex;
    gap: 10px;
    align-items: center;
    margin-left: auto;
}

.auth-button,
.post-button,
.auth-button.dropdown-toggle {
    border: 2px solid #f44336;
    background-color: white;
    color: #f44336;
    padding: 10px 25px;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s ease, color 0.3s ease;
    white-space: nowrap;
    min-width: 170px;
    text-align: center;
    box-sizing: border-box;
    text-decoration: none; /* Remove underline */
}

.auth-button:hover,
.post-button:hover,
.auth-button.dropdown-toggle:hover {
    background-color: #f44336;
    color: white;
}

/* Dropdown Account */
.dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #333;
    font-size: 16px;
    font-weight: 500;
    transition: background-color 0.3s ease, color 0.3s ease;
    justify-content: center;
    text-decoration: none; /* Remove underline */
}

.dropdown-toggle img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 15px;
    border-radius: 10px;
    z-index: 10;
    min-width: 220px;
}

.dropdown:hover .dropdown-menu {
    display: block;
}

.dropdown-menu a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 0;
    color: #333;
    font-size: 14px;
    transition: background-color 0.3s ease;
    text-decoration: none; /* Remove underline */
}

.dropdown-menu a img {
    width: 24px;
    height: 24px;
}

.dropdown-menu a:hover {
    background-color: #f44336;
    color: white;
}

/* Custom Badge */
.dropdown-menu a .badge {
    background-color: #f44336;
    color: white;
    font-size: 12px;
    padding: 3px 6px;
    border-radius: 12px;
}

.dropdown-menu p {
    font-size: 14px;
    color: #555;
    margin: 10px 0;
    font-family: 'Roboto', Arial, sans-serif;
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
    background-color: #C0C0C0;
    color: black;
}

.footer-section h3 {
    font-size: 18px;
    margin-bottom: 10px;
    font-weight: bold;
    color: black;
}

.footer-section p, .footer-section ul {
    font-size: 14px;
    color: black;
    line-height: 1.6;
}

.footer-section ul li a {
    color: black;
    text-decoration: none; /* Ensure no underline */
}

.footer-section ul li a:hover {
    text-decoration: underline;
    color: #FFFFFF;
}

.footer-bottom {
    text-align: center;
    padding: 10px;
    background-color: #C0C0C0;
    color: black;
    font-size: 14px;
}

.social-icons a img {
    width: 30px;
    height: 30px;
}

.social-icons a:hover img {
    filter: brightness(0.8);
}
</style>


<body>

<header>
    <div class="top-bar">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/z5876504630797_26fcdac87a564cc11 (1).jpg') }}" alt="Logo" class="logo">
        </a>

        <!-- Menu -->
        <nav class="main-menu">
            <ul>
                <li><a href="{{ route('cars.index') }}">Các mẫu xe </a></li>
                <li><a href="{{ route('news.index') }}">Tin tức</a></li>
                <li><a href="{{ route('posts.index') }}">Bài đăng bán xe</a></li>
            </ul>
        </nav>

        <!-- Auth buttons -->
        <div class="auth-buttons">
            @guest
                <a href="{{ route('login') }}" class="auth-button">
                    Đăng nhập
                </a>
                <a href="{{ route('register') }}" class="auth-button">
                    Đăng ký
                </a>
            @endguest
            @auth
            <div class="dropdown">
                <a href="#" class="auth-button dropdown-toggle">
                    <img src="{{ asset('images/icons8-account-100.jpg') }}" alt="User Avatar">
                    {{ auth()->user()->username }}
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('contact.index') }}">
                        <img src="{{ asset('images/account-profile (1).jpg') }}" alt="Icon"> Tổng quan
                        <span class="badge">Mới</span>
                    </a>
                    <a href="{{ route('posts.byUser', ['user_id' => auth()->user()->id]) }}">
                        <img src="{{ asset('images/—Pngtree—article content writing paper storytelling_5225632.png') }}" alt="Icon"> Bài đăng của người dùng
                    </a>
                    <a href="{{ route('packages.index') }}">
                        <img src="{{ asset('images/service-package.png') }}" alt="Icon"> Gói dịch vụ
                    </a>
                    <a href="{{ route('payment.form') }}">
                        <img src="{{ asset('images/online-payment.png') }}" alt="Icon"> Nạp tiền
                    </a>
                    <a href="{{ route('transactions.index') }}">
                        <img src="{{ asset('images/transaction-history.jpg') }}" alt="Icon"> Lịch sử giao dịch
                    </a>
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
                <li><a href="{{ route('cars.index') }}">Các mẫu xe</a></li>
                <li><a href="{{ route('news.index') }}">Tin tức</a></li>
                <li><a href="{{ route('posts.index') }}">Bài đăng</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Theo Dõi Chúng Tôi</h3>
            <div class="social-icons">
                <a href="https://www.facebook.com/profile.php?id=61566735116683" target="_blank">
                    <img src="{{ asset('images/ff.jpg') }}" alt="Facebook">
                </a>
                <a href="https://www.instagram.com/pm_qg_hg/" target="_blank">
                    <img src="{{ asset('images/ii.jpg') }}" alt="Instagram">
                </a>
                <a href="#">
                    <img src="{{ asset('images/icons8-zalo-100.jpg') }}" alt="Zalo">
                </a>
                <a href="#">
                    <img src="{{ asset('images/youtube.jpg') }}" alt="YouTube">
                </a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2024 Bán Xe Ô Tô Cũ. All rights reserved.</p>
    </div>
</footer>

</body>
</html>