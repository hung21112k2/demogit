@extends('layouts.loginapp')

@section('title', 'Chi tiết bài đăng')

@section('content')
<style>
    /* Custom CSS */
/* Main image container */
.main-image-container {
    position: relative;
    width: 100%;
    height: 500px; /* Increased height for larger display */
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.main-image {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensure the image covers the container */
}

/* Thumbnails section */
.thumbnail-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 15px;
}

.thumbnail {
    cursor: pointer;
    height: 100px;
    width: 150px;
    object-fit: cover;
    border-radius: 5px;
    transition: border 0.3s ease;
    border: 2px solid transparent;
    margin-right: 10px;
}

.thumbnail.active {
    border: 2px solid #dc3545; /* Red border for active thumbnail */
}

.thumbnail:hover {
    border: 2px solid #dc3545; /* Red border on hover */
}

/* Arrow buttons for navigation */
.arrow-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    z-index: 1;
    border-radius: 50%;
}

.arrow-btn.left {
    left: 10px;
}

.arrow-btn.right {
    right: 10px;
}

.arrow-btn:hover {
    background-color: rgba(0, 0, 0, 0.7);
}


.info-container {
    margin-top: 20px;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif; /* Ensure similar font */
    line-height: 1.6;
}

.info-container h1 {
    font-size: 24px;
    color: #333;
    font-weight: bold;
    margin-bottom: 10px; /* Add space below the title */
}

.info-container p {
    font-size: 1rem;
    color: #555;
    margin-bottom: 10px;
}

.info-container p strong {
    font-weight: bold;
    color: #222; /* Darker color for strong emphasis */
}

/* Styling for the contact section */
.contact-info h4 {
    font-size: 18px;
    margin-bottom: 10px;
    color: #dc3545; /* Red color to emphasize contact info heading */
}

.contact-info p {
    font-size: 16px;
    margin-bottom: 5px;
}

.contact-info a {
    color: #ffffff;
    text-decoration: none;
    font-weight: bold;
}

.contact-info a:hover {

    text-decoration: none; 
}

/* Add style for important notes */
.info-container .notice {
    font-size: 14px;
    color: #777;
    margin-top: 15px;
    font-style: italic;
}

/* Payment button style */
/* Styling for the primary button */
.btn-primary {
    background-color: #dc3545; /* Original background color */
    border-color: #dc3545;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    color: white; /* Ensure button text is white */
    text-decoration: none; /* Remove underline */
    display: inline-block;
}

/* Ensure <a> text inside the button is white */
.btn-primary a {
    color: white; /* Ensure the <a> tag text is white */
    text-decoration: none; /* Remove underline */
}

/* Remove underline and change color on hover */
.btn-primary a:hover {
    color: white; /* Keep the text white on hover */
    text-decoration: none; /* Ensure no underline on hover */
}

/* Hover style for the button */
.btn-primary:hover {
    background-color: #87CEFA; /* Light sky blue hover effect */
    border-color: #87CEFA; /* Light sky blue border to match */
    color: white; /* Keep the text white */
}

/* Remove underline on active or focus */
.btn-primary:active, .btn-primary:focus {
    text-decoration: none; /* Ensure no underline when clicked or focused */
    outline: none; /* Remove focus outline if necessary */
}


</style>

<div class="container mt-5">
    <div class="row">
        <!-- Phần ảnh chính -->
        <div class="main-image-container">
            <button class="arrow-btn left">&#8249;</button> <!-- Left arrow button -->

            @if($post->photos->first())
                <img src="{{ asset($post->photos->first()->image_url) }}" alt="Car image" id="main-image" class="main-image">
            @else
                <img src="{{ asset('images/default-car.png') }}" alt="No image available" id="main-image" class="main-image">
            @endif

            <button class="arrow-btn right">&#8250;</button> <!-- Right arrow button -->
        </div>

        <!-- Phần ảnh nhỏ -->
        <div class="thumbnail-container">
            @if($post->photos->count() > 0)
                @foreach ($post->photos as $photo)
                    <img src="{{ asset($photo->image_url) }}" alt="Thumbnail image" class="thumbnail" data-url="{{ asset($photo->image_url) }}">
                @endforeach
            @else
                <p>No images available</p>
            @endif
        </div>
    </div>
</div>


    </div>

    <div class="info-container mt-4">
    <h1>{{ $post->car->make }} {{ $post->car->model }} - {{ $post->year }}</h1>

    <!-- Thông tin mô tả -->
    <p><strong>Mô tả:</strong> {{ $post->description }}</p>
    <p><strong>Giá:</strong> {{ number_format($post->price) }} VND</p>
    <p><strong>Số km đã đi:</strong> {{ $post->mileage }} km</p>
    <p><strong>Năm sản xuất:</strong> {{ $post->year }}</p>
    <p><strong>Trạng thái:</strong> {{ $post->status }}</p>

    <!-- Thông tin liên hệ -->
    <div class="contact-info">
        <h4>Thông tin liên hệ</h4>
        @if(session()->has("paid_for_post_{$post->id}"))
            <p><strong>Email:</strong> {{ $post->user->email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $post->user->phone }}</p>
        @else
            <p><strong>Email:</strong> {{ maskEmail($post->user->email) }}</p>
            <p><strong>Số điện thoại:</strong> {{ maskPhoneNumber($post->user->phone) }}</p>

            <!-- Nút thanh toán -->
            @auth
                <form action="{{ route('payToViewContact', $post->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Thanh toán 5,000 VND để xem thông tin</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập để thanh toán 5,000 VND và xem thông tin</a>
            @endauth
        @endif
    </div>

    <!-- Important notice section -->
    <p class="notice">
        * Lưu ý: Mọi thông tin liên quan tới tin rao này là do người đăng tải và chịu trách nhiệm hoàn toàn. Nếu quý vị phát hiện có sai sót hãy thông báo với chúng tôi.
    </p>
</div>


<script>
    // Đổi ảnh chính khi click vào ảnh nhỏ
    document.querySelectorAll('.thumbnail').forEach(thumbnail => {
        thumbnail.addEventListener('click', function () {
            const mainImage = document.getElementById('main-image');
            mainImage.src = this.getAttribute('data-url');
            
            // Thêm class active cho thumbnail đang được chọn
            document.querySelectorAll('.thumbnail').forEach(tn => tn.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>

@endsection 