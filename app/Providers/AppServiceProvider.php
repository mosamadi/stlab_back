<?php

namespace App\Providers;

use App\Helpers\GoogleAuthenticator;
use App\Interfaces\IGoogleOAuthenticator;
use App\Interfaces\Repositories\IUserNotificationRepository;
use App\Interfaces\Repositories\IUserRepository;
use App\Repositories\UserNotificationRepository;
use App\Repositories\UserRepository;
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
            IGoogleOAuthenticator::class => GoogleAuthenticator::class,
            IUserNotificationRepository::class => UserNotificationRepository::class,
            IUserRepository::class => UserRepository::class,

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
