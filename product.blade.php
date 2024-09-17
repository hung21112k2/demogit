<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
    @vite('resources/css/product.css')
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
                <li><a href="#">Xe cũ</a></li>
                <li><a href="#">Giá xe</a></li>
                <li><a href="#">Tin tức</a></li> 
                <li><a href="{{ url('/login') }}">Đăng nhập</a></li>
            </ul>
            <button class="post-button">Đăng tin</button>
        </nav>



       
    </header>

    <h1>XE ĐÃ QUA SỬ DỤNG</h1>
<div class="content-container">
    <section class="car-list">
        @php
            $carNames = [
                'Porsche Panamera', 'Honda Civic', 'Mercedes E200',
                'VinFast Lux A2.0', 'VinFast Lux SA2.0', 'Hyundai SantaFe',
                'Toyota Fortuner', 'Mazda CX-5', 'Ford Ranger', 'Chevrolet Camaro'
            ];
        @endphp

        @for ($i = 1; $i <= 10; $i++)
        <div class="car-item">
            <img src="{{ asset('images/c' . $i . '.jpg') }}" alt="{{ $carNames[$i - 1] }}">
            <div class="car-info">
                <h3>{{ $carNames[$i - 1] }}</h3>
                <p>Giá: {{ number_format(rand(500000000, 800000000)) }} VND</p>
                <button class="view-more-button">Xem chi tiết</button>
                <!-- <a href="{{ url('/infor/' . $i) }}" class="view-more-button">Xem chi tiết</a> -->
            </div>
        </div>
        @endfor
    </section>

    <!-- Bộ lọc -->
    <aside class="filter-panel">
        <h2>FILTER BY STYLE:</h2>
        <form>
            <label><input type="checkbox" name="type" value="sedan"> Sedan</label><br>
            <label><input type="checkbox" name="type" value="hatchback"> Hatchback</label><br>
            <label><input type="checkbox" name="type" value="suv"> SUV</label><br>
            <label><input type="checkbox" name="type" value="pickup"> Pickup</label><br>
            <label><input type="checkbox" name="type" value="crossover"> Crossover</label><br>
            <label><input type="checkbox" name="type" value="mpv"> MPV</label><br>
            <label><input type="checkbox" name="type" value="van"> Van</label><br>
            <label><input type="checkbox" name="type" value="coupe"> Coupe</label><br>
            <label><input type="checkbox" name="type" value="convertible"> Convertible</label><br>
            <label><input type="checkbox" name="type" value="wagon"> Wagon</label><br>
            <label><input type="checkbox" name="type" value="roadster"> Roadster</label><br>
            <label><input type="checkbox" name="type" value="roadster"> Hybrid</label><br>
            <hr>

            <h2>FILTER BY SEATS:</h2>
            <label><input type="checkbox" name="type" value="2seats"> 2 Seats </label><br>
            <label><input type="checkbox" name="type" value="4seats"> 4 Seats </label><br>
            <label><input type="checkbox" name="type" value="7seats"> 7 Seats </label><br>
            <label><input type="checkbox" name="type" value="9seats"> 9 Seats </label><br>
            <label><input type="checkbox" name="type" value="16seats"> 16 Seats </label><br>
            <label><input type="checkbox" name="type" value="24seats"> 24 Seats </label><br>
            <label><input type="checkbox" name="type" value="45seats"> 45 Seats </label><br>
            <hr>


            <h2>FILTER BY PRICE RANGE:</h2>
            <label><input type="checkbox" name="type" value="300"> LOWER PRICE: 300 MILLION </label><br>
            <label><input type="checkbox" name="type" value="600"> LOWER PRICE: 600 MILLION </label><br>
            <label><input type="checkbox" name="type" value="800"> LOWER PRICE: 800 MILLION </label><br>
            <label><input type="checkbox" name="type" value="1billion"> LOWER PRICE: 1 BILLION </label><br>
            <label><input type="checkbox" name="type" value="3billion"> LOWER PRICE: 3 BILLION </label><br>
            <hr>

            <button type="submit">Lọc</button>

        </form>
    </aside>
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



