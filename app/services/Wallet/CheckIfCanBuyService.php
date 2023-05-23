<?php

namespace app\services\Wallet;

use Exception;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CheckIfCanBuyService
{
    public static function check($user,$price)
    {
        $balance = $user->wallet->balance;

        if($balance-$price<0)
            throw new Exception('you dont have enough money');
        return true;
    }
}
