<?php

namespace App\services\Favorite;

use App\Models\User;
use App\services\Product\GetProductService;
use App\services\User\GetUserService;
use Exception;

class CheckIfExistingFavoriteProductService
{

    public static function check($user,$product)
    {
        if(!isset($product))
            throw new Exception('Product not found');

        return isset($user->favorite_products()->where('product_id',$product->id)->get()[0]);
    }

}
