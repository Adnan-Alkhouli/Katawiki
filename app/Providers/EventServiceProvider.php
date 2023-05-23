<?php

namespace App\Providers;

use App\Events\ProductBid\ProductBidEvent;
use App\Events\TimerFinishedEvent;
use App\Listeners\ProductBidListener;
use App\Listeners\TimerListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ProductBidEvent::class => [
            ProductBidListener::class
        ],
        TimerFinishedEvent::class => [
            TimerListener::class
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */

}
