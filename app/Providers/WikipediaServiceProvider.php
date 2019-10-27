<?php
namespace App\Providers;

use App\Services\WikipediaService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class WikipediaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\Interfaces\WikipediaServiceInterface', function() {
            return new WikipediaService();
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
