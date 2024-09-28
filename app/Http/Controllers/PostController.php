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

    // Phương thức tạo bài đăng mới
    public function create()
    {
        $user = auth()->user();  // Lấy thông tin người dùng đang đăng nhập
        $packages = DB::table('packages')
        ->join('package_user', 'packages.id', '=', 'package_user.package_id')
        ->where('package_user.user_id', $user->id)
        ->select('packages.*', 'package_user.remaining_posts')
        ->get();
        $cars = Car::all();
        return view('posts.create', compact('user','packages', 'cars'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu từ form
        $validated = $request->validate([
            'car_id' => 'required|integer',
            'package_id' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validate for multiple images
            'mileage' => 'required|integer',
            'year' => 'required|integer',
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
    
        // Tạo bài đăng với trạng thái 'pending' (chờ admin phê duyệt)
        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addDays($package->duration);
    
        // Tạo bài đăng trong bảng posts với trạng thái 'pending'
        $post = Post::create([
            'user_id' => $user->id,
            'car_id' => $validated['car_id'],
            'package_id' => $package->id,
            'price' => $validated['price'],
            'description' => $validated['description'],
            'mileage' => $validated['mileage'],
            'year' => $validated['year'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => 'pending',  // Trạng thái chờ phê duyệt
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
        
        // Lấy tất cả các bài đăng có trạng thái active
        $posts = Post::with('car')
                     ->where('end_date', '>=', Carbon::now())
                     ->where('status', 'active')
                     ->get();
        
        // Lấy các bài đăng chờ phê duyệt
        $pendingPosts = Post::with('car', 'user', 'package')
                            ->where('status', 'pending')
                            ->get();
        
        // Trả về view admin.posts.index nếu là admin
        if (auth()->user()->role === 'admin') {
            return view('admin.posts.index', compact('posts', 'pendingPosts', 'makes'));
        } else {
            // Nếu không phải admin, chỉ trả về view posts.index
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
    
        // Cập nhật trạng thái bài đăng
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

    // Gửi email thông báo từ chối với các lý do
    $post->user->notify(new PostRejected($post, $reasonsString));

    return redirect()->route('admin.posts.index')->with('error', 'Bài đăng đã bị từ chối.');
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
    $posts = Post::latest()->take(6)->get();// Lấy các bài post đang active
    return view('home', compact('posts'));
}


}

