<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\Post;

class CarController extends Controller
{
    // Hàm lấy danh sách xe cũ
    public function index()
{
    $cars = Car::all();

    if (auth()->user()->role == 'admin') {
        return view('admin.cars.index', compact('cars'));
    } else {
        return view('cars.index', compact('cars'));
    }
}



    public function search(Request $request)
    {
        // Lấy từ khóa tìm kiếm
        $query = $request->input('query');

        // Tìm kiếm xe theo make hoặc model
        $cars = Car::where('make', 'like', "%$query%")
                    ->orWhere('model', 'like', "%$query%")
                    ->get();

        // Nếu có xe, lấy danh sách bài đăng theo car_id
        if ($cars->isNotEmpty()) {
            $carIds = $cars->pluck('id'); // Lấy danh sách car_id
            $posts = Post::whereIn('car_id', $carIds)->get(); // Lấy bài đăng liên quan

            // Trả về view bài đăng với danh sách bài đăng
            return view('posts.by_car', compact('posts'));
        }

        // Nếu không tìm thấy xe, trả về thông báo
        return redirect()->back()->with('error', 'Không tìm thấy xe phù hợp');
    }

    public function create()
    {
        return view('admin.cars.create');
    }

        public function store(Request $request)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        Car::create([
            'make' => $validated['make'],
            'model' => $validated['model'],
            'image' => 'images/' . $imageName,
        ]);

        return redirect()->route('cars.index')->with('success', 'Xe mới đã được thêm thành công.');
    }

    // Hiển thị form chỉnh sửa xe
    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    // Cập nhật thông tin xe
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Xử lý upload ảnh nếu có
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $car->image = 'images/' . $imageName;
        }

        $car->update([
            'make' => $validated['make'],
            'model' => $validated['model'],
        ]);

        return redirect()->route('cars.index')->with('success', 'Thông tin xe đã được cập nhật.');
    }

    // Xóa xe
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Xe đã được xóa.');
    }
}



