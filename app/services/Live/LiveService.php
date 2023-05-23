<?php

namespace App\services\Live;

use App\Events\LikeEvent;
use App\Events\ViewEvent;
use App\Models\Live;
use App\services\Date_Time\ProductTimerService;
use Exception;

class LiveService
{
    public static function home_likes()
    {
        $products = Live::take(10)->where('hidden',0)?->orderBy('like','desc')?->with('product.photos')->paginate(5);

        if(!isset($products))
        {
            throw new Exception('There are no products');
        }

        foreach($products as $product)
        {
            if(isset($product['product']))
            {
                $product['product']['timer'] = ProductTimerService::timer($product['product']);
            }
            else
                unset($product['product']);
        }

        return $products;
    }

    public static function home_views()
    {
        $products = Live::take(10)->where('hidden',0)?->orderBy('view','desc')?->with('product.photos')->paginate(5);

        if(!isset($products))
        {
            throw new Exception('There are no products');
        }

        foreach($products as $product)
        {
            if(isset($product['product']))
            {
                $product['product']['timer'] = ProductTimerService::timer($product['product']);
            }
            else
                unset($product['product']);
        }

        return $products;
    }

    public static function viewed($product)
    {
        $live = $product->live;
        $live->view++;
        $live->save();
    }

    public static function liked($product)
    {
        $live = $product->live;
        $live->like++;
        $live->save();
    }
}
