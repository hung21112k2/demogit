<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Package;
use App\Models\Car;
use Carbon\Carbon;



class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
    }

    // Phương thức tạo bài đăng mới
    public function create()
    {
        $packages = Package::all();
        $cars = Car::all();
        return view('posts.create', compact('packages', 'cars'));
    }

    // Lưu bài đăng mới vào cơ sở dữ liệu
    public function store(Request $request)
{
    // Kiểm tra và validate dữ liệu
    $validated = $request->validate([
        'car_id' => 'required|integer',
        'package_id' => 'required|integer',
        'price' => 'required|numeric',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'mileage' => 'required|integer',
        'year' => 'required|integer',
    ]);

    // Lấy thông tin gói đăng
    $package = Package::find($request->package_id);
    $startDate = Carbon::now();
    $endDate = $startDate->copy()->addDays($package->duration);

    // Kiểm tra và lưu ảnh vào thư mục public/images
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension(); // Tạo tên ảnh dựa trên thời gian để tránh trùng
        $request->image->move(public_path('images'), $imageName); // Di chuyển ảnh vào thư mục 'public/images'
        $validated['image_url'] = 'images/' . $imageName; // Tạo đường dẫn ảnh
    } else {
        // Nếu không có ảnh, cần đặt giá trị mặc định (để tránh lỗi)
        $validated['image_url'] = null; // Hoặc bạn có thể đặt một ảnh mặc định
    }

    // Tạo bài đăng mới
    Post::create([
        'user_id' => auth()->id(),
        'car_id' => $validated['car_id'],
        'package_id' => $validated['package_id'],
        'price' => $validated['price'],
        'description' => $validated['description'],
        'image_url' => $validated['image_url'], // Lưu đường dẫn ảnh vào cột image_url
        'mileage' => $validated['mileage'],
        'year' => $validated['year'],
        'start_date' => $startDate,
        'end_date' => $endDate,
        'status' => 'active',
    ]);

    return redirect()->route('posts.create')->with('success', 'Bài đăng đã được tạo thành công!');
}

    // Phương thức hiển thị danh sách bài đăng
   public function index(Request $request)
{
    // Lấy danh sách các hãng xe
    $makes = Car::select('make')->distinct()->pluck('make');
    
    // Bắt đầu query bài đăng
    $query = Post::with('car')
                 ->where('end_date', '>=', Carbon::now())
                 ->where('status', 'active');

    // Lọc theo hãng xe nếu có
    if ($request->filled('make')) {
        $query->whereHas('car', function($q) use ($request) {
            $q->where('make', $request->make);
        });
    }

    // Lọc theo giá
    if ($request->filled('price_min')) {
        $query->where('price', '>=', $request->price_min);
    }
    if ($request->filled('price_max')) {
        $query->where('price', '<=', $request->price_max);
    }

    // Lọc theo năm sản xuất
    if ($request->filled('year')) {
        $query->where('year', $request->year);
    }

    // Lấy danh sách các bài đăng
    $posts = $query->get();

    // Kiểm tra vai trò người dùng
    if (auth()->user()->role === 'admin') {
        // Nếu là admin, trả về view admin.posts.index
        return view('admin.posts.index', compact('posts', 'makes'));
    } else {
        // Nếu là user bình thường, trả về view posts.index
        return view('posts.index', compact('posts', 'makes'));
    }
}



    // Phương thức hiển thị bài đăng theo xe
    public function showByCar($car_id)
    {
        $posts = Post::where('car_id', $car_id)
                     ->where('end_date', '>=', Carbon::now())
                     ->where('status', 'active')
                     ->get();

        return view('posts.byCar', compact('posts'));
    }

    // Phương thức tạo thanh toán và trừ tiền từ số dư người dùng
    public function createPayment(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|integer',
            'package_id' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mileage' => 'required|integer',
            'year' => 'required|integer',
        ]);

        $package = Package::findOrFail($request->package_id);
        $user = auth()->user();

        // Kiểm tra số dư
        if ($user->balance < $package->price) {
            return redirect()->back()->withErrors('Số dư của bạn không đủ để thanh toán gói này.');
        }

        // Trừ tiền trong tài khoản
        $user->balance -= $package->price;
        $user->save();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validated['image_url'] = 'images/' . $imageName;
        }

        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addDays($package->duration);

        Post::create([
            'user_id' => $user->id,
            'car_id' => $validated['car_id'],
            'package_id' => $validated['package_id'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image_url' => $validated['image_url'],
            'mileage' => $validated['mileage'],
            'year' => $validated['year'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => 'active',
        ]);

        return redirect()->route('posts.index')->with('success', 'Bài đăng đã được tạo thành công và số tiền đã bị trừ từ tài khoản của bạn.');
    }

    // Hiển thị chi tiết bài đăng
    public function show($id)
    {
        $post = Post::with('car')->findOrFail($id);
        return view('posts.show', compact('post'));
    }
}

