<?php

namespace App\Providers;

use App\Youtube\AsyncYoutube;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AsyncYoutubeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('App\Youtube\AsyncYoutube', function() {
            return new AsyncYoutube(config('youtube.key'));
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
