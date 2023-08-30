<?php

namespace App\Providers;

use App\Helpers\GoogleAuthenticator;
use App\Interfaces\IGoogleOAuthenticator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $toBind = [
            IGoogleOAuthenticator::class => GoogleAuthenticator::class
        ];

        foreach ($toBind as $interface =>$implementation){
            $this->app->bind($interface,$implementation);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
