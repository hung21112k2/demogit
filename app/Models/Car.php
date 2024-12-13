<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'make',
        'model',
        'image_url',  // Đã thay đổi thành image_url
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

