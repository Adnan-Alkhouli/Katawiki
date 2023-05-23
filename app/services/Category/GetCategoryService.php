<?php

namespace App\services\Category;

use App\Models\Category;
use Exception;

class GetCategoryService
{

    public static function index($id = null)
    {
        $categories = Category::paginate(5);

        if(!isset($categories))
            throw new Exception('There are no categories');

        return $categories;
    }

    public static function find($id = null)
    {
        $category = Category::find($id);

        if(!isset($category))
            throw new Exception('There is no category has this id');

        return $category;
    }
}
