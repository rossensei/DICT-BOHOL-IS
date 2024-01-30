<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryApiController extends Controller
{
    public function getSubCategories(Category $category) 
    {
        $data = SubCategory::where('category_id', $category->id)
            ->select('id', 'category_id', 'subcatname')
            ->get();

        return response()->json($data);
    }
}
