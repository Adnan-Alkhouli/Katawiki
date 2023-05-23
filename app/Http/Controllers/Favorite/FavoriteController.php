<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\Controller;
use App\services\Favorite\DeleteFavoriteProductService;
use App\services\Favorite\GetFAvoriteProductsService;
use App\services\Favorite\StoreFavoriteProductService;
use Exception;

class FavoriteController extends Controller
{
    public function index()
    {
        try
        {
            $products = GetFAvoriteProductsService::index();
        }
        catch(Exception $e)
        {
            return response(['status' => 'failed','message' => $e->getMessage()]);
        }

        return response(['status' => 'success','data' => $products]);
    }

    public function store($product_id)
    {
        try
        {
            StoreFavoriteProductService::create($product_id);
        }
        catch(Exception $e)
        {
            return response(['status' => 'failed','message' => $e->getMessage()]);
        }

        return response(['status' => 'success']);
    }

    public function destroy($product_id)
    {
        try
        {
            DeleteFavoriteProductService::delete($product_id);
        }
        catch(Exception $e)
        {
            return response(['status' => 'failed','message' => $e->getMessage()]);
        }

        return response(['status' => 'success']);
    }
}
