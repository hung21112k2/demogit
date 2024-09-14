<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công!');
    }

    public function showLoginForm()
{
    return view('auth.login');
}

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (auth()->attempt($request->only('email', 'password'))) {
        return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
    }

    return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng.']);
}

public function logout()
{
    auth()->logout();
    return redirect()->route('home');
}

public function showForgotPasswordForm()
{
    return view('auth.forgot-password');
}

public function sendResetLink(Request $request)
{
    // Xác thực email
    $request->validate(['email' => 'required|email']);

    // Tạo token đặt lại mật khẩu
    $token = Str::random(60);

    // Lưu token vào bảng password_resets
    DB::table('password_resets')->insert([
        'email' => $request->email,
        'token' => $token,
        'created_at' => now(),
    ]);

    // Gửi email với token đặt lại mật khẩu
    Mail::send('auth.emails.reset', ['token' => $token], function ($message) use ($request) {
        $message->to($request->email);
        $message->subject('Đặt lại mật khẩu');
    });

    return back()->with('success', 'Liên kết đặt lại mật khẩu đã được gửi.');
}

public function showResetPasswordForm($token)
{
    return view('auth.reset-password', ['token' => $token]);
}

public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:6|confirmed',
        'token' => 'required',
    ]);

    // Xác thực token
    $reset = DB::table('password_resets')
                ->where('email', $request->email)
                ->where('token', $request->token)
                ->first();

    if (!$reset) {
        return back()->withErrors(['email' => 'Token không hợp lệ.']);
    }

    // Cập nhật mật khẩu người dùng
    $user = User::where('email', $request->email)->first();
    $user->password = Hash::make($request->password);
    $user->save();

    // Xóa token sau khi sử dụng
    DB::table('password_resets')->where('email', $request->email)->delete();

    return redirect()->route('login')->with('success', 'Mật khẩu của bạn đã được cập nhật.');
}

}
