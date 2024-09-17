<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car News - Combined Layout</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .news-thumbnail {
            height: 150px;
            object-fit: cover;
        }
        .ad-container {
            background-color: #e9ffe3;
            padding: 15px;
            margin-top: 15px;
            border-radius: 10px;
        }
        .ad-title {
            color: green;
        }
        .small-news img {
            height: 100px;
            object-fit: cover;
        }
        .small-news h6 {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .small-news p {
            font-size: 14px;
            color: gray;
        }

        /* Custom styles for card links */
       a {
            text-decoration: none;
            color: black;
        }
        a:hover {
            color: green;
        }

    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-md-3">
                <!-- News Item 1 -->
                <div class="mb-3">
                    <img src="car-news1.jpg" class="img-fluid news-thumbnail" alt="News Image 1">
                    <h6 class="mt-2">Loạt hãng xe mới đổ bộ Việt Nam tại BCA 2024</h6>
                </div>
                <!-- News Item 2 -->
                <div class="mb-3">
                    <img src="car-news2.jpg" class="img-fluid news-thumbnail" alt="News Image 2">
                    <h6 class="mt-2">Gumball 3000 mang 'bãi xe đắt nhất thế giới' đến VN</h6>
                </div>
                <!-- News Item 3 -->
                <div class="mb-3">
                    <img src="car-news3.jpg" class="img-fluid news-thumbnail" alt="News Image 3">
                    <h6 class="mt-2">Subaru Crosstrek 2024 đã cập cảng Việt Nam</h6>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-6">
                <!-- Main News Article -->
                <a href="o.html">
                    <div class="card mb-4">
                        <img src="main-car-news.jpg" class="card-img-top" alt="Main Car News Image">
                        <div class="card-body">
                            <h5 class="card-title">'Cuộc đua' xe xanh tiên phong tại BCA 2024</h5>
                            <p class="card-text">
                                Những mẫu xe được đề cử giải Xe năng lượng xanh tiên phong của Car Choice Awards trong khuôn khổ Better Choice Awards 2024 đáp ứng nhu cầu về một phương tiện giao thông thân thiện với môi trường, có giá thành hợp lý và thiết kế ưu việt.
                            </p>
                        </div>
                    </div>
                </a>
                <!-- Additional News Below Main Article -->
                <a href="vw-taos.html">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">VW Taos 2025 ra mắt: Thiết kế mới, nâng cấp ADAS</h5>
                            <p class="card-text">Phiên bản 2025 của Volkswagen Taos không phải là một bản thiết kế lại hoàn chỉnh, nhưng có những nâng cấp đáng chú ý trong hệ thống ADAS.</p>
                        </div>
                    </div>
                </a>

                <!-- Smaller News Section (from the latest image) -->
                <div class="small-news">
                    <!-- News Item 1 -->
                    <div class="d-flex mb-3">
                        <img src="small-news1.jpg" class="me-3" alt="Small News 1">
                        <div>
                            <h6>Nếu đang khó tìm xe sang phù hợp cho gia đình bạn, tham khảo danh sách đề cử tại BCA 2024 này</h6>
                            <p>September 12, 2024 · 2 min read</p>
                        </div>
                    </div>
                    <!-- News Item 2 -->
                    <div class="d-flex mb-3">
                        <img src="small-news2.jpg" class="me-3" alt="Small News 2">
                        <div>
                            <h6>Dán chơi chỉ hơn 100 triệu đồng dán decal Tesla Cybertruck</h6>
                            <p>September 12, 2024 · 3 min read</p>
                        </div>
                    </div>
                    <!-- News Item 3 -->
                    <div class="d-flex mb-3">
                        <img src="small-news3.jpg" class="me-3" alt="Small News 3">
                        <div>
                            <h6>Nghìn câu từ Ernst & Young chỉ ra lý do người tiêu dùng ở Việt Nam thích mua xe Trung Quốc</h6>
                            <p>September 12, 2024 · 4 min read</p>
                        </div>
                    </div>
                    <!-- News Item 4 -->
                    <div class="d-flex mb-3">
                        <img src="small-news4.jpg" class="me-3" alt="Small News 4">
                        <div>
                            <h6>Nissan Qashqai lập kỷ lục nhảy bungee từ độ cao ngang tháp Eiffel</h6>
                            <p>September 12, 2024 · 1 min read</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
