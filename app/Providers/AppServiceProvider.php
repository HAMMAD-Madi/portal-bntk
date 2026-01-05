<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Services\AuthTokenService;
use App\Services\BolcomService;
use Illuminate\Support\Facades\App;
use App\Services\PDFService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        App::bind('BolcomService', BolcomService::class);
        $this->app->bind(AuthTokenService::class, function ($app) {
            return new AuthTokenService('https://login.bol.com/token');
        });

        $this->app->singleton('pdf', function ($app) {
            return new PDFService();
        });
        App::bind('ShippingService',\App\Services\Postnl\ShippingService::class);


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        //
    }
}
