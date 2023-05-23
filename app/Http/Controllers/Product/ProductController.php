<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\services\Live\LiveService;
use App\services\Product\GetProductService;
use App\services\Product\StoreProductService;
use App\services\Product\UpdateProductService;
use App\services\User\GetUserService;
use Exception;

class ProductController extends Controller
{
    public function home_likes()
    {
        try
        {
            $products = GetProductService::home_likes();
        }
        catch(Exception $e)
        {
            return response(['status' => 'failed','message' => $e->getMessage()]);
        }

        return response(['status' => 'success','data' => $products]);
    }

    public function home_views()
    {
        try
        {
            $products = GetProductService::home_views();
        }
        catch(Exception $e)
        {
            return response(['status' => 'failed','message' => $e->getMessage()]);
        }

        return response(['status' => 'success','data' => $products]);
    }

    public function index($sub_category_id)
    {
        try
        {
           $products = GetProductService::index($sub_category_id);
        }
        catch(Exception $e)
        {
            return response(['status' => 'failed','message' => $e->getMessage()]);
        }

        return response(['status' => 'success','data' => $products]);
    }

    public function show_product($product_id)
    {
        try
        {
            $product = GetProductService::find($product_id);
        }
        catch(Exception $e)
        {
            return response(['status' => 'failed','message' => $e->getMessage()]);
        }

        LiveService::viewed($product);

        return response(['status' => 'success','data' => $product]);
    }

    public function like_product($product_id)
    {
        try
        {
            $product = GetProductService::find($product_id);
        }
        catch(Exception $e)
        {
            return response(['status' => 'failed','message' => $e->getMessage()]);
        }

        LiveService::liked($product);

        return response(['status' => 'success']);
    }

    public function view_product($product_id)
    {
        try
        {
            $product = GetProductService::find($product_id);
        }
        catch(Exception $e)
        {
            return response(['status' => 'failed','message' => $e->getMessage()]);
        }

        LiveService::viewed($product);

        return response(['status' => 'success']);
    }

    public function create(StoreProductRequest $request,$sub_category_id)
    {

        $data = $request->validated();

        try
        {
            StoreProductService::create($request->file('images'),$data,$sub_category_id);
        }
        catch(Exception $e)
        {
            return response(['status' => 'failed','message' => $e->getMessage()]);
        }

        return response(['status' => 'success']);
    }

    public function search($name)
    {
        try
        {
            $product = GetProductService::search($name);
        }
        catch(Exception $e)
        {
            return response(['status' => 'failed','message' => $e->getMessage()]);
        }

        return response(['status' => 'success' , 'data' => $product]);
    }

    public function buyers($product_id)
    {
        try
        {
            $users = GetUserService::index($product_id);
        }
        catch(Exception $e)
        {
            return response(['status' => 'failed','message' => $e->getMessage()]);
        }

        return response(['status' => 'success','data' => $users]);
    }

}
