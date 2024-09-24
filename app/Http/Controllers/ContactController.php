<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ContactController extends Controller
{
    // Hiển thị thông tin contact của người dùng đã đăng nhập
    public function index()
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();
        
        // Trả về view và truyền biến $user vào
        return view('contact.index', compact('user'));
    }

    // Phương thức để cập nhật thông tin của người dùng
    public function update(Request $request)
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Xác thực các trường nhập vào
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15',
            'password' => 'nullable|string|min:8|confirmed', // Mật khẩu có thể không đổi
        ]);

        // Cập nhật thông tin người dùng
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        // Nếu người dùng nhập mật khẩu mới, thì cập nhật mật khẩu
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Lưu thông tin
        $user->save();

        // Chuyển hướng trở lại trang tài khoản với thông báo thành công
        return redirect()->route('contact.index')->with('success', 'Thông tin tài khoản đã được cập nhật thành công.');
    }

    public function showChangePasswordForm()
    {
        return view('contact.change-password');
    }

    // Xử lý logic thay đổi mật khẩu
    public function changePassword(Request $request)
    {
        // Xác thực dữ liệu nhập vào
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Kiểm tra xem mật khẩu hiện tại có đúng không
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        // Chuyển hướng với thông báo thành công
        return redirect()->route('contact.index')->with('success', 'Mật khẩu đã được thay đổi thành công.');
    }
}



