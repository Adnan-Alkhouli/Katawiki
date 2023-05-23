<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\services\Category\GetSubCategoryService;
use Exception;

class SubCategoryController extends Controller
{
    public function index($id)
    {
        try
        {
           $sub_categories = GetSubCategoryService::index($id);
        }
        catch(Exception $e)
        {
            return response(['status' => 'failed','message' => $e->getMessage()]);
        }

        return response(['status' => 'success','data' => $sub_categories]);
    }
}
