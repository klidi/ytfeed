<?php
namespace App\Providers;

use Illuminate\Support\Facades\App;
use App\Services\YoutubeVideoService;
use Illuminate\Support\ServiceProvider;

class VideoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\Interfaces\VideoServiceInterface', function() {
            return new YoutubeVideoService();
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
