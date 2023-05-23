<?php

namespace App\services\Wallet;

use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentService
{
    public static function update($user)
    {
        $wallet = $user->wallet;
        $wallet->balance-=$user->pivot->price;
        $wallet->save();
    }
}
