<?php

namespace App\Providers;

use App\Listeners\NotificationSentListener;
use App\Models\Donation;
use App\Models\Follower;
use App\Models\MerchSale;
use App\Models\User;
use App\Models\UserSusbcriber;
use App\Observers\DonationObserver;
use App\Observers\FollowerObserver;
use App\Observers\MerchSaleObserver;
use App\Observers\UserSubscriberObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NotificationSent::class => [
            NotificationSentListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
        User::observe(UserObserver::class);
        Donation::observe(DonationObserver::class);
        Follower::observe(FollowerObserver::class);
        UserSusbcriber::observe(UserSubscriberObserver::class);
        MerchSale::observe(MerchSaleObserver::class);
    }
}
