<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bán Xe Ô Tô Cũ</title>
    @vite('resources/css/infor.css')
</head>
<body>

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
                <li><a href="{{ url('/products') }}">Xe cũ</a></li>
                <li><a href="#">Giá xe</a></li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="{{ url('/login') }}">Đăng nhập</a></li>
            </ul>
            <button class="post-button">Đăng tin</button>
        </nav>
    </header>


@section('content')
<div class="product-details-container">
    <div class="product-image">
        <img src="{{ asset('images/car1.jpg') }}" alt="Porsche Panamera">
    </div>
    <div class="product-info">
        <h1>Porsche Panamera</h1>
        <p class="price">Giá: 3,200,000,000 VND</p>
        <p class="status">Tình trạng: Đã qua sử dụng</p>
        <p class="description">
            Porsche Panamera là một chiếc sedan hạng sang với hiệu suất vượt trội và nội thất tiện nghi. Xe đã qua sử dụng nhưng được bảo dưỡng kỹ lưỡng, không có va chạm, máy móc hoạt động hoàn hảo.
        </p>

        <h2>Thông số kỹ thuật</h2>
        <ul class="specs">
            <li>Động cơ: V6 3.0L Turbo</li>
            <li>Công suất: 330 mã lực</li>
            <li>Mô-men xoắn: 450 Nm</li>
            <li>Hộp số: Tự động 8 cấp</li>
            <li>Màu sắc: Trắng</li>
            <li>Số km đã đi: 40,000 km</li>
            <li>Năm sản xuất: 2020</li>
        </ul>

        <button class="contact-button">Liên hệ mua xe</button>
    </div>
</div>
@endsection



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
