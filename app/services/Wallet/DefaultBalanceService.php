<?php

namespace app\services\Wallet;

use Illuminate\Database\Eloquent\Relations\HasOne;

class DefaultBalanceService
{
    public static function set(HasOne $wallet)
    {
        return $wallet->create(['balance' => 10000]);
    }
}
