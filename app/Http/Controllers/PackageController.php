<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

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
}
