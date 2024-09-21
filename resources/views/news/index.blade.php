@extends('layouts.app')

@section('title', 'Tin tức')


@section('content')
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin Tức Ô Tô Mới Nhất</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <!-- Phần tiêu đề -->
        <header class="text-center">
            <h1 class="display-4">Tin Tức Ô Tô Mới Nhất</h1>
            <p class="lead">Nguồn cập nhật thông tin ô tô hàng đầu.</p>
        </header>

        <!-- Phần bài viết -->
        <div class="row">
            <div class="col-lg-8">
                <article>
                    <h2 class="mb-3">Những Mẫu Xe Hàng Đầu Năm 2024 Được Tiết Lộ</h2>
                    <ul>
                        <li><strong>BMW ra mắt mẫu xe M4 mới:</strong> Chiếc xe hiệu suất hàng đầu năm 2024</li>
                        <li><strong>Siêu xe Thụy Điển siêu tốc:</strong> Kỳ quan kỹ thuật lăn bánh trên đường</li>
                        <li><strong>Cách mạng lái xe tự động:</strong> Những chiếc xe giúp bạn điều hướng dễ dàng</li>
                    </ul>

                    <p>Những chiếc xe đang trở nên thông minh hơn, nhanh hơn và đẹp mắt hơn. Trong buổi ra mắt gần đây, BMW đã giới thiệu mẫu xe M4 2024 đầy mạnh mẽ, trong khi Thụy Điển tiết lộ một cỗ máy đường phố nhanh và tinh tế. Cho dù là tốc độ, phong cách hay tự động hóa, những chiếc xe mới này chắc chắn sẽ thống trị thị trường trong năm tới.</p>

                    <p>Một trong những điểm nhấn chính là khả năng xử lý tiên tiến của M4 và các tính năng hiện đại mang lại trải nghiệm tuyệt vời cho người dùng. Trong khi đó, xe Thụy Điển tập trung vào việc cung cấp cả tốc độ và thân thiện với môi trường, tạo ra sự cân bằng giữa sự sang trọng và bền vững.</p>

                    <!-- Hình ảnh -->
                    <figure class="figure my-4">
                    <img src="{{ asset('images/c1.jpg') }}" class="figure-img img-fluid rounded" alt="Hình ảnh xe 1">

                        <figcaption class="figure-caption">Cận cảnh hai chiếc xe đối thủ trên đường đua, chạy song song.</figcaption>
                    </figure>

                    <p>Trong cuộc cạnh tranh kỹ thuật đầy kịch tính, những chiếc xe này tượng trưng cho tương lai của sự phát triển ô tô. Cả hai hãng xe đều đang đẩy mạnh để mang lại trải nghiệm vượt trội cho người tiêu dùng. Đường phố năm 2024 chắc chắn sẽ tràn ngập những chiếc xe tiên tiến này.</p>

                    <figure class="figure my-4">
                        <img src="{{ asset('images/c5.jpg') }}" class="figure-img img-fluid rounded"alt="Hình ảnh xe 2">
                        <figcaption class="figure-caption">Cạnh tranh gay gắt giữa các xe trên đường đua, so kè từng chút.</figcaption>
                    </figure>
                </article>
            </div>

            <!-- Phần Sidebar -->
            <aside class="col-lg-4">
                <div class="p-4 bg-light rounded">
                    <h3 class="mb-3">Đánh Giá Mới Nhất</h3>
                    <ul class="list-unstyled">
                        <li><strong>BMW M4 2024:</strong> Sang trọng, nhanh và đột phá.</li>
                        <li><strong>Xe Thụy Điển thân thiện môi trường:</strong> Kiệt tác bền vững.</li>
                        <li><strong>Xe tự lái:</strong> Tương lai của giao thông đã đến.</li>
                    </ul>
                </div>

                <div class="p-4 mt-4 bg-light rounded">
                    <h3 class="mb-3">Sự Kiện Xe Hơi Sắp Tới</h3>
                    <p>Tham gia buổi ra mắt xe lớn tiếp theo tại Paris vào tháng 9 năm 2024!</p>
                    <p>Theo dõi thêm thông tin về Triển Lãm Ô Tô Tokyo, với sự góp mặt của các thương hiệu hàng đầu.</p>
                </div>
            </aside>
        </div>
    </div>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


@endsection