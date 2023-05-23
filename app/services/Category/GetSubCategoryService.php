<?php

namespace App\services\Category;

use App\Models\Category;
use App\Models\SubCategory;
use Exception;

class GetSubCategoryService
{

    public static function index($id = null)
    {
        $categories = GetCategoryService::find($id)->sub_category()->paginate(5);


        if(!isset($categories))
            throw new Exception('There are no categories');

        return $categories;
    }

    public static function find($id = null)
    {
        $sub_category = SubCategory::find($id);

        if(!isset($sub_category))
            throw new Exception('There is no category has this id');

        return $sub_category;
    }
}
