<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post; // Sử dụng model phù hợp với bảng posts
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    // Hàm hiển thị danh sách xe
    public function index()
    {
        // Lấy tất cả các xe từ cơ sở dữ liệu
        $cars = Car::all();
    
        // Kiểm tra role của người dùng để điều hướng đúng trang
        if (auth()->check() && auth()->user()->role == 'admin') {
            // Nếu là admin, hiển thị trang quản trị
            return view('admin.cars.index', compact('cars'));
        } else {
            // Nếu không phải admin (hoặc là user thông thường), hiển thị trang người dùng
            return view('cars.index', compact('cars'));
        }
    }

    // Hiển thị form thêm xe mới
    public function create()
    {
        // Chỉ admin mới được thêm xe
        if (auth()->check() && auth()->user()->role == 'admin') {
            return view('admin.cars.create');
        }
        return redirect()->route('cars.index')->with('error', 'Bạn không có quyền thêm xe.');
    }

    // Lưu xe mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'image_url' => 'required|mimetypes:image/*|max:2048', // Chấp nhận tất cả các định dạng ảnh
        ]);
    
        // Xử lý upload ảnh
        if ($request->hasFile('image_url')) {
            $imageName = time() . '.' . $request->image_url->extension();
            $request->image_url->move(public_path('images'), $imageName);
            $validated['image_url'] = 'images/' . $imageName;
        }
    
        // Tạo xe mới
        Car::create([
            'make' => $validated['make'],
            'model' => $validated['model'],
            'image_url' => $validated['image_url'],
        ]);
    
        return redirect()->route('admin.cars.index')->with('success', 'Xe mới đã được thêm thành công.');
    }
    
    public function edit($id)
    {
        $car = Car::find($id); // Tìm kiếm chiếc xe dựa trên id
        if ($car) {
            return view('admin.cars.edit', compact('car')); // Trả về trang chỉnh sửa
        } else {
            return redirect()->route('cars.index')->with('error', 'Car not found.');
        }
    }
    

    // Cập nhật thông tin xe
    public function update(Request $request, Car $car)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Xử lý upload ảnh mới nếu có
        if ($request->hasFile('image_url')) {
            $imageName = time() . '.' . $request->image_url->extension();
            $request->image_url->move(public_path('images'), $imageName);
            $car->image_url = 'images/' . $imageName;
        }

        // Cập nhật các thông tin khác
        $car->update([
            'make' => $validated['make'],
            'model' => $validated['model'],
            'image_url' => $car->image_url,  // Giữ nguyên ảnh cũ nếu không có ảnh mới
        ]);

        return redirect()->route('admin.cars.index')->with('success', 'Thông tin xe đã được cập nhật.');
    }

    // Xóa xe
    public function destroy(Car $car)
    {
        // Chỉ admin mới được xóa xe
        if (auth()->check() && auth()->user()->role == 'admin') {
            $car->delete();
            return redirect()->route('admin.cars.index')->with('success', 'Xe đã được xóa.');
        }
        return redirect()->route('cars.index')->with('error', 'Bạn không có quyền xóa xe.');
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
    
        // Thực hiện truy vấn để lấy dữ liệu từ posts và liên kết với bảng cars
        $posts = DB::table('posts')
                    ->join('cars', 'posts.car_id', '=', 'cars.id')
                    ->where('posts.description', 'like', '%' . $query . '%')
                    ->orWhere('cars.model', 'like', '%' . $query . '%')
                    ->select('posts.*', 'cars.model', 'cars.make', 'cars.image_url as car_image_url') // Lấy các cột cần thiết
                    ->get();
    
        // Truyền biến $query vào view
        return view('posts.search_results', compact('posts', 'query'));
    }
}
