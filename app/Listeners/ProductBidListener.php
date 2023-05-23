<?php

namespace App\Listeners;

use App\Events\ProductBid\ProductBidEvent;
use App\Events\ProductBid\ProductPriceEvent;
use App\services\Action\MakeActionService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProductBidListener
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
    public function handle(ProductBidEvent $event): void
    {
        try
        {
            MakeActionService::create($event->id,$event->user_id,$event->price);
        }
        catch(Exception $e)
        {
            // event(new ProductPriceEvent($event->id,$newPrice,'failed',$e->getMessage()));
            return;
        }

        // event(new ProductPriceEvent($event->id,$newPrice,'success','the product price is updated successfully'));
        event(new ProductPriceEvent($event->id,$event->price));
    }
}
