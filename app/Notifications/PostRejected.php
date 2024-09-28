<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostRejected extends Notification
{
    use Queueable;

    protected $post;
    protected $reasons;

    public function __construct($post, $reasons)
    {
        $this->post = $post;
        $this->reasons = $reasons;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Bài đăng của bạn đã bị từ chối')
                    ->line('Bài đăng của bạn cho xe ' . $this->post->car->make . ' ' . $this->post->car->model . ' đã bị từ chối.')
                    ->line('Lý do từ chối: ' . $this->reasons);
                    
    }
}
