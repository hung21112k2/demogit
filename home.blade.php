<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bán Xe Ô Tô Cũ</title>
    @vite('resources/css/app.css')
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

  
        <section class="banner">
            <div class="banner-img">
                <img src="{{ asset('images/d111.jpg') }}" alt="Banner 1">
            </div>
            <div class="banner-img">
                <img src="{{ asset('images/d222.jpg') }}" alt="Banner 2">
            </div>
            <!-- <div class="banner-img">
                <img src="{{ asset('images/c3.jpg') }}" alt="Banner 3">
            </div> -->
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
