<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Listeners\CreateContactAfterUserRegister;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            CreateContactAfterUserRegister::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
