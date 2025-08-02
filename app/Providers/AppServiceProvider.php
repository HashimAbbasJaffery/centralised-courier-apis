<?php

namespace App\Providers;

use App\Classes\CourierServices\LeopardCourier;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind("leopard", function() {
            return new LeopardCourier(env("LEOPARD_API_KEY"), env("LEOPARD_API_PASSWORD"), env("LEOPARD_ENDPOINT"));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
