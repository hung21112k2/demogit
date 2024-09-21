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

.car-scroll-container {
            display: flex;
            overflow-x: auto; /* Cho phép cuộn ngang */
            gap: 15px; /* Khoảng cách giữa các xe */
            padding: 20px;
            white-space: nowrap; /* Không ngắt dòng */
        }

        .car-item {
            display: inline-block;
            width: 250px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
            text-align: center;
        }

        .car-item img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .car-item h3 {
            font-size: 1.2em;
            margin: 10px 0;
        }

        .car-item p {
            font-size: 1em;
            color: #555;
        }

        .car-item button {
            background-color: #228dff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .car-item button:hover {
            background-color: #0056b3;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button-container a {
            text-decoration: none;
        }

        .view-all-button {
            background-color: #228dff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }

        .view-all-button:hover {
            background-color: #0056b3;
        }

        .view-more-button {
    display: inline-block;
    background-color: #228dff;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
    font-weight: bold;
}

.view-more-button:hover {
    background-color: #0056b3;
}


    </style>
<body>

    <header>
    <div class="top-bar">
    <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo">
        </a>

        <div class="auth-buttons">
        <div class="search-bar">
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Tìm kiếm xe...">
        <button type="submit">Tìm kiếm</button>
    </form>
</div>
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


        <nav class="main-menu">
        <ul>
    <li><a href="{{ route('cars.index') }}">Xe cũ</a></li>
    <li><a href="{{ route('news.index') }}">Tin tức</a></li>
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
        </header>

        <main>
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
            <div class="car-scroll-container">
                @foreach ($cars as $car)
                    <div class="car-item">
                        <img src="{{ asset($car->image) }}" alt="{{ $car->make }} {{ $car->model }}">
                        <h3>{{ $car->make }} {{ $car->model }}</h3>
                        <p>Giá: {{ number_format($car->price, 0, ',', '.') }} VND</p>
                        <a href="{{ route('posts.byCar', ['car_id' => $car->id]) }}" class="view-more-button">Xem thêm</a>
                    </div>
                @endforeach
            </div>
        </section>

    

    <div class="button-container">
        <!-- Sử dụng route nếu có -->
        <a href="{{ route('cars.index') }}">
        <button class="view-all-button">XEM TẤT CẢ</button>
    </a>
    </div>
    </main>
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
            <p>&copy; 2024 Bán Xe Ô Tô Cũ. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
