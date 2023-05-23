<?php

namespace App\Http\Controllers\Category;

use App\services\Category\GetCategoryService;
use App\Http\Controllers\Controller;
use Exception;

class CategoryController extends Controller
{
    public function index()
    {
        try
        {
           $categories = GetCategoryService::index();
        }
        catch(Exception $e)
        {
            return response(['status' => 'failed','message' => $e->getMessage()]);
        }

        return response(['status' => 'success','data' => $categories]);
    }
}
