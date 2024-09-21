<?php

namespace App\Http\Controllers;

use App\Models\User; // Import model User
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Phương thức hiển thị danh sách người dùng
    public function showUsers()
    {
        // Lấy tất cả người dùng từ bảng users
        $users = User::all();

        // Trả về view và truyền danh sách người dùng vào view
        return view('admin.users', compact('users'));
    }
}
