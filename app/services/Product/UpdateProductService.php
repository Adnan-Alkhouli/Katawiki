<?php

namespace App\services\Product;

use App\Models\Product;
use App\services\User\GetUserService;
use App\services\Wallet\PaymentService;
use Exception;

class UpdateProductService
{

    public static function end($product_id)
    {
        $product = Product::find($product_id);

        if(!isset($product))
            throw new Exception('Product not found');

        if($product->isBought==0)
        {
            $user = GetUserService::max($product_id);
            PaymentService::update($user);
            $product->isBought = 1;
            $product->save();
            $product->live->hidden = 1;
            $product->live->save();
        }
    }


}
