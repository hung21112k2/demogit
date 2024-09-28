<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

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

    // Tạo người dùng mới nhưng chưa xác thực email
    $user = User::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'email_verified_at' => null,
    ]);

    // Gửi email xác thực
    $this->sendVerificationEmail($user);

    // Chuyển hướng đến trang thông báo đã gửi email xác nhận
    return redirect()->route('verification.notice');
}

    // Gửi email xác thực
    protected function sendVerificationEmail($user)
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify', 
            Carbon::now()->addMinutes(60), // Liên kết có hiệu lực trong 60 phút
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );
    
        // Gửi email với biến $user và $url
        Mail::send('auth.emails.verify', ['url' => $verificationUrl, 'user' => $user], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Xác nhận tài khoản của bạn');
        });
    }
    

    // Hàm xử lý sau khi nhấp vào liên kết xác thực
    public function verifyEmail(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);
    
        // Kiểm tra hash của email
        if (!hash_equals($hash, sha1($user->email))) {
            return redirect()->route('login')->withErrors('Liên kết xác thực không hợp lệ.');
        }
    
        // Cập nhật email_verified_at
        $user->email_verified_at = now();
        $user->save();
    
        // Chuyển hướng đến trang thông báo đăng ký thành công
        return redirect()->route('verification.success');
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
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = auth()->user();
    
            // Kiểm tra nếu người dùng là admin và đang cố gắng đăng nhập qua form user
            if ($user->role === 'admin') {
                Auth::logout(); // Đăng xuất tài khoản admin
                return redirect()->route('admin.login')->withErrors(['email' => 'Tài khoản này là admin. Vui lòng đăng nhập qua trang đăng nhập Admin.']);
            }
    
            // Nếu không phải admin, tiếp tục đăng nhập user
            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        }
    
        // Trường hợp đăng nhập thất bại
        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng.']);
    }
    

public function showAdminLoginForm()
{
    return view('auth.admin_login');
}

public function adminLogin(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    // Thực hiện đăng nhập cho admin
    if (Auth::attempt(array_merge($credentials, ['role' => 'admin']), $request->remember)) {
        return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công! Chào mừng Admin.');
    }

    // Nếu không phải admin hoặc thông tin đăng nhập sai
    return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng hoặc không phải tài khoản admin.']);
}

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }

    public function adminlogout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('home'); // Điều hướng người dùng về trang chủ hoặc trang đăng nhập sau khi đăng xuất
}


    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $token = Str::random(60);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

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

        $reset = DB::table('password_resets')
                    ->where('email', $request->email)
                    ->where('token', $request->token)
                    ->first();

        if (!$reset) {
            return back()->withErrors(['email' => 'Token không hợp lệ.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Mật khẩu của bạn đã được cập nhật.');
    }
}
