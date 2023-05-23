<?php

namespace App\services\Favorite;

use App\services\User\GetUserService;
use Exception;

class GetFAvoriteProductsService
{

    public static function index($id = null)
    {
        $user = GetUserService::find();

        $products = $user->favorite_products()->with('photos')->paginate(5);

        if(!isset($products[0]))
            throw new Exception('The are no products');

        return $products;
    }

}
