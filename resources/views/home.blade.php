<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bán Xe Ô Tô Cũ</title>
    @vite('resources/css/app.css')
</head>
<style>
        .auth-button {
            border: 2px solid #ff66b2; /* Màu hồng cho khung */
            background-color: white;
            color: #ff66b2;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
            white-space: nowrap; /* Đảm bảo chữ không bị ngắt dòng */
        }

        .auth-button:hover {
            background-color: #ff66b2;
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
    </style>
<body>

    <header>
    <div class="top-bar">
    <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo">
        </a>
    <div class="search-bar">
        <input type="text" placeholder="Tìm kiếm xe...">
        <button type="submit">Tìm kiếm</button>
    </div>
    <div class="auth-buttons">
        @guest
            <a href="{{ route('login') }}" class="auth-button">Đăng nhập</a>
            <a href="{{ route('register') }}" class="auth-button">Đăng ký</a>
        @endguest
        @auth
            <a href="#" class="auth-button">Tài khoản</a>
            <a href="{{ route('logout') }}" class="auth-button"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Đăng xuất
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endauth
    </div>
</div>


        <nav class="main-menu">
            <ul>
                <!-- Sửa đường dẫn để phù hợp với các route cụ thể -->
                <li><a href="#">Xe cũ</a></li>
                <li><a href="#">Giá xe</a></li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="{{ route('posts.index') }}">Bài đăng</a></li>

            </ul>

<!-- Nút Đăng Tin -->
@auth
    <!-- Nếu đã đăng nhập, chuyển đến trang tạo bài đăng -->
    <a href="{{ route('posts.create') }}" class="post-button">Đăng tin</a>
@endauth

@guest
    <!-- Nếu chưa đăng nhập, chuyển đến trang đăng nhập -->
    <a href="{{ route('login') }}" class="post-button">Đăng tin</a>
@endguest

        </nav>

        <section class="banner">
            <div class="banner-img">
                <img src="{{ asset('images/d111.jpg') }}" alt="Banner 1">
            </div>
            <div class="banner-img">
                <img src="{{ asset('images/d222.jpg') }}" alt="Banner 2">
            </div>
        </section>

        <script>
            let currentSlide = 0;
            const slides = document.querySelectorAll('.banner-img');
            const totalSlides = slides.length;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.classList.toggle('active', i === index);
                });
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                showSlide(currentSlide);
            }

            setInterval(nextSlide, 3000);
        </script>

        <h1>THƯƠNG HIỆU</h1>
        <section class="image-scroll">
            @for ($i = 1; $i <= 10; $i++)
                <div class="scroll-item">
                    <img src="{{ asset('images/b' . $i . '.jpg') }}" alt="Image {{ $i }}">
                </div>
            @endfor
        </section>

        <h1>XE ĐÃ QUA SỬ DỤNG</h1>
        <section class="car-scroll">
            @php
                $carNames = [
                    'Porsche Panamera',
                    'Honda Civic',
                    'Mercedes E200',
                    'VinFast Lux A2.0',
                    'VinFast Lux SA2.0',
                    'Hyundai SantaFe',
                    'Toyota Fortuner',
                    'Mazda CX-5',
                    'Ford Ranger',
                    'Chevrolet Camaro'
                ];
            @endphp

            @for ($i = 1; $i <= 10; $i++)
                <div class="car-item">
                    <img src="{{ asset('images/c' . $i . '.jpg') }}" alt="{{ $carNames[$i - 1] }}">
                    <h3>{{ $carNames[$i - 1] }}</h3>
                    <p>Giá: {{ number_format(rand(500000000, 800000000)) }} VND</p>
                    <button class="view-more-button">Xem thêm</button>
                </div>
            @endfor
        </section>
    </header>

    <div class="button-container">
        <!-- Sử dụng route nếu có -->
        <a href="{{ url('/products') }}">
            <button class="view-all-button">XEM TẤT CẢ</button>
        </a>
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
                    <li><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li><a href="#">Xe cũ</a></li>
                    <li><a href="#}">Giá xe</a></li>
                    <li><a href="#">Tin tức</a></li>
                    <li><a href="{{ route('login') }}" class="footer-section">Đăng nhập</a></li>
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
