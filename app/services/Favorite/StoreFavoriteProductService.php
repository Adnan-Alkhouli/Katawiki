<?php

namespace App\services\Favorite;

use App\services\Product\GetProductService;
use App\services\User\GetUserService;
use Exception;

class StoreFavoriteProductService
{

    public static function create($id = null)
    {
        $user = GetUserService::find();

        $product = GetProductService::find($id);

        if(!isset($product))
            throw new Exception('Product not found');

        $user->favorite_products()->syncWithoutDetaching($product);
    }

}
