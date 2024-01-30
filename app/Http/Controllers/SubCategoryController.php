<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        // $subcategories = SubCategory::orderBy('id', 'desc')->get();
        // $categories = Category::select('id', 'catname')->get();
        // return inertia('Subcategory/Index', [
        //     'categories' => $categories,
        //     'subcategories' => $subcategories
        // ]);

        $subcategories = SubCategory::where('category_id', $category->id)
            ->select('id', 'category_id', 'subcatname')
            ->get();

        $categoryData = Category::where('id', $category->id)
            ->select('id', 'catname')
            ->first();

        return inertia('Subcategory/Index', [
            'category' => $categoryData,
            'subcategories' => $subcategories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Category $category)
    {
        $request->validate([
            'subcatname' => 'string|required|unique:sub_categories',
        ]);
        // SubCategory::create($request->all());
        $category->subCategories()->create([
            'subcatname' => $request->subcatname
        ]);

        return back()->with('success', 'A new subcategory has been added to '.$category->catname.'!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'subcatname' => ['required', 'string', Rule::unique(SubCategory::class)->ignore($subCategory->id)],
        ], [
            'subcatname.required' => 'The subcategory name field is required.',
            'subcatname.unique' => 'The subcategory name already exist.',
        ]);
        
        $subCategory->update($request->all());
        
        return back()->with('success', 'Subcategory has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();

        return back()->with('success', 'A subcategory has been removed from list!');
    }
}
