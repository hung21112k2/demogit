<?php

use App\Models\Car;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CarController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;

// Trang chủ
Route::get('/', [PostController::class, 'homeindex'])->name('home');

// Đăng nhập user
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Đăng nhập admin
Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');

// Đăng ký
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Đăng xuất
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/admin/logout', [AuthController::class, 'adminlogout'])->name('admin.logout');



// Quên mật khẩu
// Hiển thị form quên mật khẩu
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');

// Xử lý yêu cầu quên mật khẩu và gửi email
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');


// Đặt lại mật khẩu
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');



Route::middleware(['auth'])->group(function () {
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::put('/account/update', [ContactController::class, 'update'])->name('user.update');

});

Route::get('/cars', [CarController::class, 'index'])->name('cars.index');

Route::get('/posts/car/{car_id}', [PostController::class, 'showByCar'])->name('posts.byCar');

Route::get('/search', [App\Http\Controllers\CarController::class, 'search'])->name('search');

Route::get('/email/verify-notice', function () {
    return view('auth.verify-notice');
})->name('verification.notice');

// Route xử lý xác thực email
Route::get('email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');

// Route hiển thị trang thông báo đăng ký thành công
Route::get('/email/verify-success', function () {
    return view('auth.verify-success');
})->name('verification.success');

Route::get('/admin', function () {
    // Kiểm tra nếu người dùng đăng nhập và là admin
    if (Auth::check() && Auth::user()->role === 'admin') {
        return view('admin.dashboard');
    }
    
    // Nếu không phải admin, chuyển hướng về trang chủ
    return redirect('/')->with('error', 'Bạn không có quyền truy cập trang admin.');
})->name('admin.dashboard');

Route::post('/payment/create', [PostController::class, 'createPayment'])->name('payment.create');

// Route để hiển thị form thay đổi mật khẩu
Route::get('/account/change-password', [ContactController::class, 'showChangePasswordForm'])->name('user.password.form');

// Route để xử lý logic thay đổi mật khẩu
Route::post('/account/change-password', [ContactController::class, 'changePassword'])->name('user.password.update');

Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');

Route::get('/admin/cars', [CarController::class, 'index'])->name('admin.cars');

// Route cho quản lý xe
Route::resource('cars', CarController::class)->middleware('auth');

Route::get('/admin/posts', [PostController::class, 'index'])->name('admin.posts');

Route::get('/admin/packages', [PackageController::class, 'index'])->name('admin.packages');
Route::get('/admin/packages/create', [PackageController::class, 'create'])->name('admin.packages.create');
Route::post('/admin/packages', [PackageController::class, 'store'])->name('admin.packages.store');
Route::get('/admin/packages/{package}/edit', [PackageController::class, 'edit'])->name('admin.packages.edit');
Route::put('/admin/packages/{package}', [PackageController::class, 'update'])->name('admin.packages.update');
Route::delete('/admin/packages/{package}', [PackageController::class, 'destroy'])->name('admin.packages.destroy');



Route::get('/posts/user/{user_id}', [PostController::class, 'showByUser'])->name('posts.byUser');

Route::get('/packages', [PackageController::class, 'userindex'])->name('packages.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/payment', [PaymentController::class, 'showForm'])->name('payment.form');
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');

Route::get('/payment/return', [PaymentController::class, 'paymentReturn'])->name('payment.return');

Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

Route::get('/payment/failed', function () {
    return view('payment.failed');
})->name('payment.failed');

});

Route::post('/posts/{post}/pay', [PostController::class, 'payToViewContact'])->name('payToViewContact');

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

Route::post('/packages/purchase', [PackageController::class, 'purchase'])->name('packages.purchase');
Route::get('/packages/purchase', [PackageController::class, 'showPurchasePage'])->name('packages.purchase');


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts.index');
    
    Route::get('/posts/{post}/approve', [PostController::class, 'showForApproval'])->name('admin.posts.showForApproval');
    Route::post('/admin/posts/{post}/approve', [PostController::class, 'approvePost'])->name('admin.posts.approve');
Route::post('/admin/posts/{post}/reject', [PostController::class, 'rejectPost'])->name('admin.posts.reject');

});







































