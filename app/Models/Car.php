<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'make',
        'model',
    ];

    // Thiết lập quan hệ với bảng posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
