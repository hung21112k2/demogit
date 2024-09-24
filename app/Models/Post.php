<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'car_id', 
        'package_id', 
        'price', 
        'description', 
        'mileage', 
        'year', 
        'image_url',
        'start_date', 
        'end_date', 
        'status'
    ];


    // Liên kết đến model Car (bảng cars)
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    // Liên kết đến model User (bảng users)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Liên kết đến model Package (bảng packages)
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}

