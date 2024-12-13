<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Đảm bảo file Helpers.php tồn tại
        if (file_exists(app_path('Helpers.php'))) {
            require_once app_path('Helpers.php');
        }
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }
}
