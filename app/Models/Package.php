<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'duration', 'post_limit'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('expires_at')->withTimestamps();
    }
    
}


