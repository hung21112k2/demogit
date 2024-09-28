<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_id',
        'amount',
        'payment_method',
        'transaction_date',
    ];

    // Chuyển đổi transaction_date thành datetime
    protected $casts = [
        'transaction_date' => 'datetime',
    ];
}
