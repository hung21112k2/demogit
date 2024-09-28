<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; // Thêm dòng này để sử dụng Auth
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public function index()
    {
        // Lấy tất cả các gói dịch vụ từ bảng packages
        $packages = Package::all();

        // Trả về view quản lý gói dịch vụ
        return view('admin.packages.index', compact('packages'));
    }

     // Hiển thị form tạo gói dịch vụ
     public function create()
     {
         return view('admin.packages.create');
     }
 
     // Lưu gói dịch vụ mới vào database
     public function store(Request $request)
     {
         $request->validate([
             'name' => 'required',
             'price' => 'required|numeric',
             'duration' => 'required|integer',
             'post_limit' => 'required|integer',
         ]);
 
         Package::create($request->all());
         return redirect()->route('admin.packages')->with('success', 'Gói dịch vụ đã được tạo.');
     }
 
     // Hiển thị form chỉnh sửa gói dịch vụ
     public function edit(Package $package)
     {
         return view('admin.packages.edit', compact('package'));
     }
 
     // Cập nhật gói dịch vụ
     public function update(Request $request, Package $package)
     {
         $request->validate([
             'name' => 'required',
             'price' => 'required|numeric',
             'duration' => 'required|integer',
             'post_limit' => 'required|integer',
         ]);
 
         $package->update($request->all());
         return redirect()->route('admin.packages')->with('success', 'Gói dịch vụ đã được cập nhật.');
     }
 
     // Xóa gói dịch vụ
     public function destroy(Package $package)
     {
         $package->delete();
         return redirect()->route('admin.packages')->with('success', 'Gói dịch vụ đã được xóa.');
     }

     public function userindex()
     {
         // Lấy tất cả các gói dịch vụ
         $packages = Package::all();
 
         // Trả về view và truyền dữ liệu các gói dịch vụ
         return view('packages.index', compact('packages'));
     }

     public function purchase(Request $request)
     {
         // Lấy thông tin gói và người dùng
         $package = Package::find($request->package_id);
         $user = auth()->user();
     
         // Kiểm tra số dư của người dùng
         if ($user->balance < $package->price) {
             return redirect()->route('packages.purchase')->with('error', 'Số dư của bạn không đủ để mua gói này.');
         }
     
         // Trừ tiền từ balance
         $user->balance -= $package->price;
     
         // Kiểm tra nếu user đã có gói này trước đó
         $userPackage = DB::table('package_user')
             ->where('user_id', $user->id)
             ->where('package_id', $package->id)
             ->first();
     
         if ($userPackage) {
             // Nếu đã có gói, cộng thêm số bài đăng và gia hạn
             DB::table('package_user')
                 ->where('user_id', $user->id)
                 ->where('package_id', $package->id)
                 ->update([
                     'remaining_posts' => DB::raw('remaining_posts + ' . $package->post_limit),
                     'expires_at' => Carbon::now()->addDays($package->duration),
                     'updated_at' => Carbon::now(),
                 ]);
         } else {
             // Nếu chưa có gói, thêm gói mới
             DB::table('package_user')->insert([
                 'user_id' => $user->id,
                 'package_id' => $package->id,
                 'remaining_posts' => $package->post_limit,
                 'expires_at' => Carbon::now()->addDays($package->duration),
                 'created_at' => Carbon::now(),
                 'updated_at' => Carbon::now(),
             ]);
         }
     
         // Lưu lại số dư đã bị trừ
         $user->save();
     
         return redirect()->route('posts.create')->with('success', 'Bạn đã mua gói thành công!');
     }
     

     public function showPurchasePage()
{
    // Lấy danh sách tất cả các gói
    $packages = Package::all();

    // Trả về view purchase.blade.php với danh sách các gói
    return view('packages.purchase', compact('packages'));
}
 

}
