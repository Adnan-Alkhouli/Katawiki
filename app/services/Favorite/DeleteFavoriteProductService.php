<?php

namespace App\services\Favorite;

use App\services\Product\GetProductService;
use App\services\User\GetUserService;
use Exception;

class DeleteFavoriteProductService
{

    public static function delete($id = null)
    {
        $user = GetUserService::find();

        $product = GetProductService::find($id);

        $exist = CheckIfExistingFavoriteProductService::check($user,$product);

        if(!$exist)
            throw new Exception('this product does not in your favorites');

        $user->favorite_products()->detach($product);
    }

}
