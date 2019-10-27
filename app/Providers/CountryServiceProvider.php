<?php
namespace App\Providers;

use App\Services\CountryService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class CountryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\Interfaces\CountryServiceInterface', function() {
            return new CountryService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
