<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Models\Contact;

class CreateContactAfterUserRegister
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        // Lấy thông tin người dùng sau khi đăng ký
        $user = $event->user;

        // Tạo một bản ghi mới trong bảng contacts
        Contact::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => '', // Nếu có cột số điện thoại trong form đăng ký, bạn có thể lấy từ $user
            'subject' => 'User Registration', // Hoặc bạn có thể tùy chỉnh theo yêu cầu
            'message' => 'This user registered via the signup form.', // Hoặc tuỳ chỉnh
        ]);
    }
}
