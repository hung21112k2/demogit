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
        // Đảm bảo rằng $this->reasons là một mảng
        if (!is_array($this->reasons)) {
            $this->reasons = [$this->reasons];
        }
        $reasonsFormatted = implode("\n", $this->reasons);
    
        return (new MailMessage)
                    ->subject('Bài đăng của bạn đã bị từ chối')
                    ->line('Bài đăng của bạn cho xe ' . ($this->post->car ? $this->post->car->make . ' ' . $this->post->car->model : 'Chưa xác định') . ' đã bị từ chối.')
                    ->line('Lý do từ chối:')
                    ->with($reasonsFormatted);
    }
    
}