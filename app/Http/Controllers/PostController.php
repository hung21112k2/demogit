<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Model bảng posts

// PostController phải kế thừa từ Controller của Laravel
class PostController extends Controller
{
    public function __construct()
    {
        // Chỉ cho phép người dùng đã đăng nhập truy cập các phương thức này
        $this->middleware('auth')->only(['create', 'store']);
    }

    public function create()
    {
        // Lấy tất cả các gói từ bảng packages
        $packages = \App\Models\Package::all();
    
        // Lấy tất cả các xe từ bảng cars
        $cars = \App\Models\Car::all();
    
        // Truyền dữ liệu gói và xe tới view
        return view('posts.create', compact('packages', 'cars'));
    }
    


    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validated = $request->validate([
            'car_id' => 'required|integer',
            'package_id' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mileage' => 'required|integer',
            'year' => 'required|integer',
        ]);
    
        // Xử lý việc lưu hình ảnh
        if ($request->hasFile('image')) {
            // Đặt tên file duy nhất bằng timestamp
            $imageName = time() . '.' . $request->image->extension();
            // Lưu file vào thư mục public/images
            $request->image->move(public_path('images'), $imageName);
            // Gán đường dẫn ảnh cho trường image_url
            $validated['image_url'] = 'images/' . $imageName;
        }
    
        // Lưu bài đăng vào bảng posts
        Post::create($validated);
    
        return redirect()->route('posts.create')->with('success', 'Bài đăng đã được tạo thành công!');
    }

    public function index()
{
    // Lấy tất cả dữ liệu từ bảng posts
    $posts = Post::all();
    
    // Truyền dữ liệu cho view
    return view('posts.index', compact('posts'));
}

    
    
}
