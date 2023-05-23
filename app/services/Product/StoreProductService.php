<?php

namespace App\services\Product;

use App\Models\Product;
use App\services\Category\GetSubCategoryService;
use App\Services\Image\ImageService;
use App\services\Live\LiveService;
use App\services\User\GetUserService;
use Exception;

class StoreProductService
{

    public static function create($images,$data,$sub_category_id)
    {
        $user = GetUserService::find();

        $category = GetSubCategoryService::find($sub_category_id);
        $product = $user->products()->create([
            'sub_category_id' => $category->id,
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'days' => $data['days'],
            'hours' => $data['hours'],
            'minutes' => $data['minutes']
        ]);

        $product->live()->create(['like' => 0,'view' => 0]);

        if(isset($images))
        {
            $paths = ImageService::upload_image($images,'product',false);
            foreach($paths as $path)
                $product->photos()->create(['image' => $path]);
        }


    }

}
