<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Package;
use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Photo;
use App\Notifications\PostApproved;
use App\Notifications\PostRejected;



class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'myPosts']);
    }

    public function create()
    {
        $user = auth()->user();  // Lấy thông tin người dùng đang đăng nhập
        
        // Lấy tất cả các gói từ bảng packages
        $packages = Package::all();
    
        // Lấy thông tin lượt đăng bài còn lại của các gói mà người dùng đã mua
        $userPackages = DB::table('package_user')
            ->where('user_id', $user->id)
            ->pluck('remaining_posts', 'package_id')
            ->toArray();
    
        // Gắn số lượt đăng bài còn lại vào từng gói
        foreach ($packages as $package) {
            // Nếu không có lượt đăng bài, đặt remaining_posts là 0
            $package->remaining_posts = $userPackages[$package->id] ?? 0;
        }
        
        // Lấy danh sách các hãng xe duy nhất từ bảng cars
        $makes = Car::distinct()->pluck('make');
        
        // Lấy danh sách tất cả các xe
        $cars = Car::all();
        
        return view('posts.create', compact('user', 'packages', 'cars', 'makes'));
    }
    
    
    

    public function store(Request $request)
    {
        // Xử lý trước giá trị của 'price' và 'mileage' để loại bỏ các ký tự không phải số
        $request->merge([
            'price' => str_replace('.', '', $request->price),
            'mileage' => str_replace('.', '', $request->mileage),
        ]);
    
        // Validate dữ liệu từ form
        $validated = $request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'package_id' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'images.*' => 'file|mimetypes:image/*|max:2048', // Cho phép bất kỳ loại MIME nào của hình ảnh
            'mileage' => 'required|integer',
            'year' => 'required|integer',
            'other_make' => 'nullable|string',
            'other_model' => 'nullable|string',
        ]);
    
        $user = auth()->user();
        $package = Package::find($request->package_id);
    
        // Kiểm tra số bài đăng còn lại trong bảng package_user
        $packageUser = DB::table('package_user')
            ->where('user_id', $user->id)
            ->where('package_id', $package->id)
            ->first();
    
        // Kiểm tra nếu người dùng còn bài đăng trong gói đã chọn
        if ($packageUser && $packageUser->remaining_posts <= 0) {
            return redirect()->route('packages.purchase')->with('error', 'Bạn đã hết bài đăng cho gói này. Vui lòng mua thêm gói.');
        }
    
        // Trừ 1 bài đăng trong bảng package_user
        DB::table('package_user')
            ->where('user_id', $user->id)
            ->where('package_id', $package->id)
            ->update([
                'remaining_posts' => DB::raw('remaining_posts - 1'),
                'updated_at' => now(),
            ]);
    
        // Xử lý hãng xe khác
        if ($validated['make'] === 'other' && !empty($validated['other_make'])) {
            $validated['make'] = $validated['other_make'];
        }
    
        // Xử lý model xe khác
        if ($validated['model'] === 'other' && !empty($validated['other_model'])) {
            $validated['model'] = $validated['other_model'];
        }
    
        // Tạo bài đăng với trạng thái 'pending' (chờ admin phê duyệt)
        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addDays($package->duration);
    
        // Tạo bài đăng trong bảng posts với trạng thái 'pending'
        $post = Post::create([
            'user_id' => $user->id,
            'car_id' => null, // Để tạm null cho đến khi admin duyệt
            'package_id' => $package->id,
            'price' => $validated['price'],
            'description' => $validated['description'],
            'mileage' => $validated['mileage'],
            'year' => $validated['year'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => 'pending', // Trạng thái chờ phê duyệt
        ]);
    
        // Lưu thông tin xe tạm thời vào bảng pending_cars
        DB::table('pending_cars')->insert([
            'post_id' => $post->id,
            'make' => $validated['make'],
            'model' => $validated['model'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Lưu từng ảnh vào bảng photos
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imageName = time() . '_' . $index . '.' . $image->extension();
                $image->move(public_path('images'), $imageName);
    
                // Lưu ảnh vào bảng photos
                Photo::create([
                    'post_id' => $post->id,
                    'image_url' => 'images/' . $imageName,
                ]);
    
                // Đặt ảnh đầu tiên làm ảnh chính trong bảng posts
                if ($index === 0) {
                    $post->image_url = 'images/' . $imageName;
                    $post->save();
                }
            }
        }
    
        // Thông báo rằng bài đăng đang chờ phê duyệt từ admin
        return redirect()->route('posts.create')->with('success', 'Bài đăng của bạn đã được gửi và đang chờ admin phê duyệt.');
    }
    

public function index(Request $request)
{
    // Lấy danh sách các hãng xe
    $makes = Car::select('make')->distinct()->pluck('make');
    
    // Kiểm tra nếu người dùng đã đăng nhập và là admin
    if (auth()->check() && auth()->user()->role === 'admin') {
        // Lấy tất cả các bài đăng active (không phân trang cho admin)
        $posts = Post::with('car')
            ->where('end_date', '>=', Carbon::now())
            ->where('status', 'active')
            ->get(); // Không phân trang
        
        // Đánh dấu bài đăng sắp hết hạn (còn 5 ngày hoặc ít hơn)
        foreach ($posts as $post) {
            $daysLeft = Carbon::now()->diffInDays(Carbon::parse($post->end_date), false);
            
            // Đặt cờ isExpiringSoon nếu còn 5 ngày hoặc ít hơn và còn hạn
            $post->isExpiringSoon = $daysLeft > 0 && $daysLeft <= 5;
        
            // Debug: Hiển thị số ngày còn lại để kiểm tra (có thể bỏ đi sau khi kiểm tra)
            logger("Post ID: {$post->id}, Days Left: {$daysLeft}, Is Expiring Soon: {$post->isExpiringSoon}");
        }
        
        
        
        // Lấy các bài đăng chờ phê duyệt
        $pendingPosts = Post::with('car', 'user', 'package')
            ->where('status', 'pending')
            ->get();

        // Lấy các bài đăng bị từ chối
        $rejectedPosts = Post::with('car', 'user', 'package')
            ->where('status', 'rejected')
            ->get();
        
        // Trả về view admin.posts.index nếu là admin
        return view('admin.posts.index', compact('posts', 'pendingPosts', 'rejectedPosts', 'makes'));
    } else {
        // Tạo query cơ bản cho các bài đăng
        $query = Post::with('car')
            ->where('end_date', '>=', Carbon::now())
            ->where('status', 'active');

        // Filter by car make
        if ($request->has('make') && $request->make) {
            $query->whereHas('car', function ($q) use ($request) {
                $q->where('make', $request->make);
            });
        }

        // Filter by year
        if ($request->has('year') && $request->year) {
            $query->whereHas('car', function ($q) use ($request) {
                $q->where('year', $request->year);
            });
        }

        // Filter by price range
        if ($request->has('price_min') || $request->has('price_max')) {
            $minPrice = $request->price_min ?? 0;
            $maxPrice = $request->price_max ?? 2000000000;
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        // Thực thi query và phân trang cho người dùng thông thường
        $posts = $query->paginate(6); // 6 bài đăng mỗi trang

        // Trả về view posts.index cho người dùng thông thường và khách
        return view('posts.index', compact('posts', 'makes'));
    }
}


    
    

public function approvePost(Request $request, $post_id)
{
    $post = Post::findOrFail($post_id);

    // Kiểm tra tiêu chí phê duyệt
    $validated = $request->validate([
        'criteria_image' => 'required',
        'criteria_price' => 'required',
        'criteria_description' => 'required',
    ]);

    // Tạo xe mới trong bảng cars
    $pendingCar = DB::table('pending_cars')->where('post_id', $post->id)->first();
    $car = Car::create([
        'make' => $pendingCar->make,
        'model' => $pendingCar->model,
        'image_url' => $post->image_url, // hoặc giá trị phù hợp khác
    ]);

    // Cập nhật 'car_id' của bài đăng
    $post->car_id = $car->id;
    $post->status = 'active';
    $post->save();

    // Gửi email thông báo phê duyệt
    $post->user->notify(new PostApproved($post));

    return redirect()->route('admin.posts.index')->with('success', 'Bài đăng đã được phê duyệt.');
}


    
    
    public function showForApproval($post_id)
{
    // Lấy bài đăng theo ID
    $post = Post::with('car', 'user', 'package', 'photos')->findOrFail($post_id);

    // Trả về view để phê duyệt bài đăng
    return view('admin.posts.approve', compact('post'));
}


public function rejectPost(Request $request, $post_id)
{
    $post = Post::findOrFail($post_id);

    // Lưu trữ các lý do từ chối
    $reasons = [];

    // Kiểm tra các tiêu chí nào không được chọn
    if ($request->input('criteria_image') == '0') {
        $reasons[] = 'Ảnh không phù hợp với nội dung bài đăng';
    }
    if ($request->input('criteria_price') == '0') {
        $reasons[] = 'Giá không hợp lý';
    }
    if ($request->input('criteria_description') == '0') {
        $reasons[] = 'Mô tả không rõ ràng hoặc không đúng sự thật';
    }

    // Nối các lý do thành chuỗi
    $reasonsString = implode(', ', $reasons);

    // Cập nhật trạng thái bài đăng
    $post->status = 'rejected';
    $post->save();

    // Hoàn lại 1 lượt đăng bài trong gói dịch vụ của người dùng
    $packageUser = \DB::table('package_user')
        ->where('user_id', $post->user_id)
        ->where('package_id', $post->package_id)
        ->first();

    if ($packageUser && $packageUser->remaining_posts !== null) {
        // Tăng thêm 1 lượt đăng bài
        \DB::table('package_user')
            ->where('user_id', $post->user_id)
            ->where('package_id', $post->package_id)
            ->update(['remaining_posts' => $packageUser->remaining_posts + 1]);
    }

    // Gửi email thông báo từ chối với các lý do
    $post->user->notify(new PostRejected($post, $reasonsString));

    return redirect()->route('admin.posts.index')->with('error', 'Bài đăng đã bị từ chối và lượt đăng đã được hoàn lại.');
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
        $post = Post::with('car', 'user','photos')->findOrFail($id);
        $user = auth()->user();
        $paid = false;
    
        // Kiểm tra nếu người dùng đã thanh toán để xem thông tin liên hệ của bài đăng
        if ($user) {
            $paid = session()->has("paid_for_post_{$post->id}");
        }
    
        return view('posts.show', compact('post', 'paid'));
    }

    public function payToViewContact($post_id)
{
    $post = Post::findOrFail($post_id);
    $user = auth()->user();

    // Kiểm tra nếu người dùng có đủ số dư
    if ($user->balance >= 5000) {
        // Trừ tiền và lưu session rằng người dùng đã thanh toán
        $user->balance -= 5000;
        $user->save();

        session()->put("paid_for_post_{$post_id}", true);

        return redirect()->route('posts.show', $post_id)->with('success', 'Bạn đã thanh toán thành công!');
    }

    // Nếu không đủ số dư, chuyển hướng với thông báo lỗi
    return redirect()->route('posts.show', $post_id)->with('error', 'Số dư không đủ để thanh toán.');
}
  

    public function showByUser($user_id)
{
    // Lấy các bài đăng dựa trên user_id
    $posts = Post::where('user_id', $user_id)
                 ->where('end_date', '>=', Carbon::now())
                 ->where('status', 'active')
                 ->get();

    return view('posts.byUser', compact('posts'));
}

public function homeindex() {
    // Lấy các bài post có trạng thái active và sắp xếp mới nhất, giới hạn 6 bài
    $posts = Post::where('status', 'active')->latest()->take(6)->get();

            // Lấy 6 dòng xe được đăng nhiều nhất
            $topCars = DB::table('posts')
            ->join('cars', 'posts.car_id', '=', 'cars.id')
            ->select('cars.make', 'cars.model', DB::raw('count(posts.id) as total_posts'))
            ->groupBy('cars.make', 'cars.model')
            ->orderByDesc('total_posts')
            ->limit(6)
            ->get();
            
            return view('home', compact('posts', 'topCars'));

}

private function maskPhoneNumber($phone)
{
    return substr($phone, 0, 6) . ' ***';
}

public function showPostsByCar($make, $model)
{
    // Lấy các bài đăng theo make và model
    $posts = Post::whereHas('car', function ($query) use ($make, $model) {
        $query->where('make', $make)
              ->where('model', $model);
    })->where('status', 'active')->paginate(10);

    // Lấy tất cả các hãng xe (makes) để truyền vào view
    $makes = Car::select('make')->distinct()->pluck('make');

    return view('posts.index', compact('posts', 'make', 'model', 'makes'));
}

public function edit($id)
{
    $post = Post::findOrFail($id);
    $packages = Package::all(); // Assuming you want to list all available packages
    return view('admin.posts.edit', compact('post', 'packages'));
}

public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);

    // Xóa dấu chấm khỏi giá và số km để server xử lý chính xác
    $priceWithoutDots = str_replace('.', '', $request->input('price'));
    $mileageWithoutDots = str_replace('.', '', $request->input('mileage'));

    // Cập nhật yêu cầu xác nhận dữ liệu
    $request->merge(['price' => $priceWithoutDots, 'mileage' => $mileageWithoutDots]);

    $request->validate([
        'price' => 'required|numeric',
        'description' => 'required|string',
        'mileage' => 'required|integer',
        'year' => 'required|integer|min:1886|max:' . date('Y'),
        'status' => 'required|in:pending,active,rejected,expired', // Đảm bảo giá trị status hợp lệ
    ]);
    
    // Cập nhật giá trị vào cơ sở dữ liệu
    $post->price = $priceWithoutDots;
    $post->description = $request->input('description');
    $post->mileage = $mileageWithoutDots;
    $post->year = $request->input('year');
    $post->status = $request->input('status'); // Cập nhật trạng thái
    
    $post->save();
    

    return redirect()->route('admin.posts.index')->with('success', 'Bài đăng đã được cập nhật thành công.');
}

public function destroy($id)
{
    $post = Post::findOrFail($id);
    $post->delete();

    return redirect()->route('admin.posts.index')->with('success', 'Bài đăng đã được xóa.');
}



}

