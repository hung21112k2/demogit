<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostApproved extends Notification
{
    use Queueable;

    protected $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Bài đăng của bạn đã được phê duyệt')
                    ->line('Bài đăng của bạn cho xe '. $this->post->car->make .' '. $this->post->car->model .' đã được phê duyệt thành công.')
                    ->line('Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!');
    }
}
