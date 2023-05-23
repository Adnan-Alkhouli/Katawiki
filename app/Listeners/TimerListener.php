<?php

namespace App\Listeners;

use App\Events\TimerFinishedEvent;
use App\services\Product\UpdateProductService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TimerListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TimerFinishedEvent $event): void
    {
        UpdateProductService::end($event->product_id);
    }
}
