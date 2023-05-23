<?php

namespace App\services\Date_Time;

use Exception;

class ProductTimerService
{
    public static function timer($product)
    {
        if($product['isBought']==1)
            return 0;
        $days = $product->days;
        $hours = $product->hours;
        $minutes = $product->minutes;

        $created = $product['created_at'];

        $now = ProductTimerService::get_now_time();

        $end_time = $created->addDays($days)->addHours($hours)->addMinutes($minutes);

        $diff_in_seconds = $now->diffInSeconds($end_time);

        if(ProductTimerService::check_if_end($now,$end_time))
        {
            $product->isBought = 1;
            $product->save();
            $product->live->hidden = 1;
            $product->live->save();
            return 0;
        }

        return $diff_in_seconds;

    }

    public static function get_now_time()
    {
        return now();
    }

    private static function check_if_end($now,$end_time)
    {
        return $now >= $end_time;
    }



}
