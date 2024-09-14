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
        'status',
        'start_date',
        'end_date',
        'price',
        'description',
        'image_url',
        'mileage',
        'year',
    ];

    // Thiết lập quan hệ với bảng cars
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
    
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    
}
