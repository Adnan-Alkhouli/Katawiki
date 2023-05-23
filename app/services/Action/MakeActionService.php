<?php

namespace App\services\Action;

use App\services\Product\GetProductService;
use App\services\User\GetUserService;
use App\services\Wallet\CheckIfCanBuyService;
use App\services\Wallet\PaymentService;
use Exception;

class MakeActionService
{

    public static function create($product_id = null,$user_id = null,$price = null)
    {
        $user = GetUserService::find($user_id);

        $product = GetProductService::find($product_id);

        if(!isset($product) || $product->isBought==1)
            throw new Exception('Product not found');

        if(!MakeActionService::can_buy($user,$price,$product))
            throw new Exception('You have to pay more than last user');
    }

    private static function can_buy($user,$price,$product)
    {
        $actions = $user->actions();

        $users = $product->buyers();

        $maxPrice = $users?->first()?->pivot->price;
        if((!isset($maxPrice) || $maxPrice<$price) && CheckIfCanBuyService::check($user,$price) && $price>= $product->price)
        {
            if($actions->get()->count()==0)
                $actions->attach($product->id,['price' => $price]);
            else
                $actions->updateExistingPivot($product->id,['price' => $price]);

            return true;
        }
        return false;
    }
}

