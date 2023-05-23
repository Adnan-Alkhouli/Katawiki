<?php

namespace App\services\User;

use App\Models\User;
use App\services\Product\GetProductService;
use Exception;

class GetUserService
{

    public static function find($id = null)
    {
        if(isset($id))
            return User::find($id);

        return auth()->user();
    }

    public static function max($product_id)
    {

        $product = GetProductService::find($product_id);

        if(!isset($product))
            throw new Exception('Product not found');

        $user = $product->buyers()->first();

        if(!isset($user))
            throw new Exception('There is no buyers for this product');
        
        return $user;

    }

    public static function index($product_id)
    {
        $product = GetProductService::find($product_id);

        if(!isset($product))
            throw new Exception('Product not found');

        $users = $product->buyers()->paginate(5);

        if(!isset($users))
            throw new Exception('There are no buyers');

        return $users;
    }
}
