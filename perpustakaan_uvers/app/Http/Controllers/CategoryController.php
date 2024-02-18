<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
 
    public function get_category_list()
    {
        $categories = Category::all();

        return new JsonResponse([
            'data' => [ 
                'category_lists' => ($categories) ? $categories : [] 
            ],
            'error' => ''
        ]);
    }

}
