<?php

namespace App\services\Product;

use App\Models\Product;
use App\services\Category\GetSubCategoryService;
use App\services\Live\LiveService;
use Exception;

class GetProductService
{

    public static function index($sub_category_id = null)
    {
        $category = GetSubCategoryService::find($sub_category_id);

        $products = $category->products()->with('photos')->paginate(10);

        if(!isset($products))
            throw new Exception('There are no categories');

        return $products;
    }

    public static function find($product_id)
    {
        $product = Product::find($product_id);

        if(!isset($product) || $product->isBought==1)
            throw new Exception('product not found');

        return $product;
    }

    public static function home_likes()
    {
        $products =  LiveService::home_likes();

        return $products;
    }

    public static function home_views()
    {
        $products =  LiveService::home_views();

        if(!isset($products))
            throw new Exception('There are no products');

        return $products;
    }

    public static function search($name)
    {
        $product = Product::where('name','like',$name.'%')->where('isBought',0)->paginate(5);

        if(!isset($product[0]))
            throw new Exception('There is no product has this name');

        return $product;
    }

}
